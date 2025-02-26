<?php 

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if(!isset($_SESSION['user'])){
    header('Location: /pages/auth/login.php');
    exit();
}

if(!isset($_GET['reservation_id']) || !isset($_GET['payment_id'])){
    header('Location: /pages/show_order.php');
    exit();
}

$reservation_id = $_GET['reservation_id'];

$payment_id = $_GET['payment_id'];

$payment = PaymentController::getPaymentById($payment_id);
$reservation = ReservationController::getReservationById($reservation_id);
$car = CarController::getCarById($reservation->getCarId());

$user = unserialize($_SESSION['user']);



?>

<!DOCTYPE html>
<html lang="fr"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<main >
    <div class="row">
    <h1 class="title col-sm-12 col-md-12 col-lg-12 flex">Récapitulatif de votre commande</h1>
    <div class="order-summary col-sm-12 col-md-12 col-lg-12 flex">
        <table class="table">
            <thead>
                <tr>
                    <th>véhicule</th>
                    <th>Date retrait</th>
                    <th>Retour prévu</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $car->getModel(). " ". $car->getBrand();?></td>
                    <td><?php echo $reservation->getDateDepart()->format('d-m-Y');?></td>
                    <td><?php echo $reservation->getDateRetour()->format('d-m-Y');?></td>
                    <td><?php echo $payment->getCost(). "€";?></td>

                </tr>
            </tbody>
        </table>
        </table>
    </div>

    </div>
   

    <div class="checkout-form-container ">
            <p class="total-price">Total: <?php echo $payment->getCost();?> €</p>
            <form id="payment-form" class="checkout-form">
                <input id="payment_id" type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
                <input id="reservation_id" type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                <input id="car_id" type="hidden" name="car_id" value="<?php echo $car->getId() ; ?>">
                <div class="input-group">
                    <label for="first-name">Prénom</label>
                    <input id="first-name" name="first_name" type="text" value="<?php echo $user->getFirstName(); ?>" required>
                </div>
                <div class="input-group">
                    <label for="last-name">Nom</label>
                    <input id="last-name" name="last_name" type="text" value="<?php echo $user->getName() ?>" required>
                </div>
                <div class="input-group">
                    <label for="address">Adresse</label>
                    <input id="address" name="address" type="text" required>
                </div>
                <div id="card-element" class="card-element"></div>
                <button id="submit" class="checkout-button">Payer</button>
                <div id="payment-message" class="error-message"></div>
            </form>
        </div>

</main>


<script>
    document.addEventListener('DOMContentLoaded', async function () {
    const stripe = Stripe('pk_test_51OHcjUJu8ctDlNibfCdCx1GitmFUxeBsSMhKcJ8rcpv8FFHLzi4DrmvORWZ59znYmXpf4GiQht3UWJFDnZ35aygl00AvFK5UJX');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const paymentForm = document.getElementById('payment-form');
    paymentForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const firstName = document.getElementById('first-name').value;
        const lastName = document.getElementById('last-name').value;
        const address = document.getElementById('address').value;
        const paymentId = document.getElementById('payment_id').value;
        const reservationId = document.getElementById('reservation_id').value;
        const carId = document.getElementById('car_id').value;


        const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);

        if (error) {
            document.getElementById('payment-message').textContent = error.message;
            return;
        }

        let cart =JSON.parse(  [
            {
                carId: carId,
                quantite: 1,
                prix: <?php echo $payment->getCost();?>,
                commentaire: '',
                paymentId: paymentId,
                reservationId: reservationId
              

            }
        ]);
        let totalAmount = cart.reduce((sum, item) => sum + item.prix * item.quantite, 0);
        console.log('fetching')
        fetch('../routes/process_payment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                payment_method_id: paymentMethod.id,
                cart: JSON.stringify(cart),
                totalAmount: totalAmount,
                first_name: firstName,
                last_name: lastName,
                address: address
            })
        })
            .then(response => response.text())
            .then(data => {
                console.log('Réponse brute:', data);
                try {
                    const jsonData = JSON.parse(data);
                    if (jsonData.success) {
                        alert('Paiement réussi !');
                        localStorage.removeItem('cart');
                        window.location.href = 'checkout_success.php';
                    } else {
                        document.getElementById('payment-message').textContent = jsonData.error;
                    }
                } catch (e) {
                    console.log('Erreur de parsing JSON:', e);
                    document.getElementById('payment-message').textContent = 'Erreur inattendue. Veuillez réessayer.';
                }
            })
            .catch(error => {
                console.log('Erreur:', error);
            });

    });
});
</script>
    
</body>
</html>