<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if (isset( $_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    $orders = ReservationController::getReservationsByUser();
}
else{
    header('Location: /pages/auth/login.php');
    exit();
}

?> 
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Showcase</title>
    <link rel="icon" href="user/img/logo.png" sizes="50" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />

    <!-- Stylesheet -->
    <!-- <link href="user/css/style.css" rel="stylesheet" /> -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body>
<?php include '../pages/struct/navbar.php';?> 


<!-- START ORDER HISTORY -->
    <div class="container order-container historic-body">
        <div class="mt-5 d-flex flex-column justify-content-center align-items-center">
            <h1 class="display-5 text-uppercase text-center">Historique <span class="text-success">RÉSERVATIONS</span></h1>

            <!-- Card -->
            <?php foreach ($orders as $order) { 
                $car = CarController::getCarById($order->getCarId());
                $payment = PaymentController::getPaymentById($order->getPaymentId());
                $payment_receipt = $payment->getPaymentReceipt();
            ?>
            <div class=" p-3 mb-3 mt-5 shadow bg-body-tertiary rounded" style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <h4>VEHICULE00<?= $order->getCarId() ?></h4>
                        <img src="../images/Vehicules/<?php echo $car->getImage() ?>"  class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
                            <h5 class="card-title">Véhicule</h5>
                            <p class="card-text"><?php echo htmlspecialchars($car->getBrand())?> <?php echo htmlspecialchars($car->getModel())?></p>
                            <h5 class="card-title">Date de location</h5>
                            <p class="card-text"><?= date_format($order->getDateDepart(), 'd/m/Y') ?></p>
                            <h5 class="card-title">Date de retour</h5>
                            <p class="card-text"><?= date_format($order->getDateRetour(), 'd/m/Y')?></p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body text-end">
                            <div class="card-content mb-3">
                                <p class="card-title fw-bold" style="font-size: 35px;">FCFA <?= $payment->getCost() ?></p>
                                <p class="card-title">Statut</p>

                         
                                    <?php if ($payment->getIsPaid() == false): ?>
                                    <h4 class="card-text fw-bold text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hourglass-bottom mb-1" viewBox="0 0 16 16">
                                            <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                        </svg>
                                        Veuillez effectuer le PAIEMENT
                                    </h4>
                                    <?php else: ?>
                                    <h4 class="card-text fw-bold text-success">
                                        Le paiement a été effectué et confirmé avec succès
                                    </h4>
                                   
                                    <?php endif; ?>
                         
                            </div>

                            <?php if ($payment->getIsPaid() == false): ?>
                           <!--     <form action="../routes/reservation.php" method="post">
                                <?php //echo '<input type="hidden" name="car_id" value="' . htmlspecialchars($payment->getCa) . '">';?>

                                </form> -->
                            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#invoice">
                            
                         
                            Continuer le paiement
                            </button>

                           
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <p class="card-text"><small class="text-body-secondary">Dernière mise à jour il y a quelques minutes</small></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- END ORDER HISTORY -->
  
    <!-- FOOTER -->
     <?php include '../pages/struct/footer.php';?> 


     <script>
        
     </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<!--  -->