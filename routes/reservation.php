<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');

// Configuration pour retourner des réponses JSON

header('Content-Type: application/json; charset=utf-8');

try {
    unset($_SESSION['reservationErreur']);
    // Identifier la méthode HTTP utilisée
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            // Récupération des données de la requête


            if (isset($_POST['car_id'])) {
                $car = CarController::getCarById($_POST['car_id']);
               
          
                 
                    $pickupDate = $_POST['pickup-date'];
                    $dropoffDate = $_POST['dropoff-date'];
                    if (isset($_SESSION['reservationErreur'])) {
                        unset($_SESSION['reservationErreur']);
                    }
                    if (!isset($_SESSION['user'])) {
                        header('Location: /pages/auth/login.php');
                        // throw new Exception('Vous devez être connecté pour effectuer une réservation');
                    } else {
                        // Vérification des données
                        if (!$car || !isset($pickupDate) || !isset($dropoffDate)) {
                            throw new Exception('Invalid request data');
                        } else {
                            $request['pickup_date'] = $pickupDate;
                            $request['dropoff_date'] = $dropoffDate;
                            $result = ReservationController::addReservation($car, $request);
                            if ($result['status']) {
                                // echo json_encode(['success' => true]);
                                // header('Location: /pages/show_order.php');

                                header('Location: /pages/checkout?reservation_id='.$result['reservation_id'].'&payment_id='.$result['payment_id']);
                            } else {
                         header('Location: /pages/show_car.php?id='.$carData['id']);
                                // echo json_encode(['success' => false]);
                            }
                        }
                    }
                
            } else {
                echo 'Aucune donnée de voiture reçue.';
            }


            break;
    }
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
