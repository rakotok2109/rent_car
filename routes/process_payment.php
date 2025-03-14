<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once ('../config/init.php');
require_once ('../vendor/autoload.php');
use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable ('../');
$dotenv->load();

if (!isset($_ENV['STRIPE_API_KEY'])) {
    die(json_encode(['error' => 'Clé API Stripe non définie.']));
}

$stripe_Api_Key = $_ENV['STRIPE_API_KEY'];

\Stripe\Stripe::setApiKey($stripe_Api_Key);

header('Content-Type: application/json');

$cart = json_decode($_POST['cart'], true);
$totalAmount = $_POST['totalAmount'] * 100; // Stripe attend le montant en centimes
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$address = $_POST['address'];
$paymentId = $_POST['paymentId'];
$reservationId = $_POST['reservationId'];
$carId= $_POST['carId'];

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $totalAmount,
        'currency' => 'eur',
        'automatic_payment_methods' => [
            'enabled' => true,
            'allow_redirects' => 'never'
        ],
        'payment_method' => $_POST['payment_method_id'],
        'confirm' => true,
    ]);

    if ($paymentIntent->status === 'succeeded') {
         $user = unserialize($_SESSION['user']);

         $reservation_id = $cart[0]['reservationId'];

         $reservation = ReservationController::getReservationById($reservation_id);


         if ($reservation)
         {
          $result =  PaymentController::confirmPayment($reservation);
          if($result)
          {
            echo json_encode(['success' => true]);

          }
          else{
            echo json_encode(['error' => 'Erreur lors du paiement.']);
            exit;
          }
         }

        else{
            echo json_encode(['error' => 'Réservation introuvable.']);
            exit;
        }
      

             
               
        
             
                exit;
    } else {
        echo json_encode(['error' => 'Le paiement a échoué.']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>