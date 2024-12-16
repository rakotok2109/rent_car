<?php

require_once('../config/init.php');

// Configuration pour retourner des réponses JSON

header('Content-Type: application/json; charset=utf-8');

try {
    unset($_SESSION['reservationErreur']);
    // Identifier la méthode HTTP utilisée
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            // Récupération des données de la requête


            if (isset($_POST['car'])) {
                $carData = json_decode($_POST['car'], true);
                if ($carData && json_last_error() === JSON_ERROR_NONE) {
                    // var_dump($carData);
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
                        if (!is_array($carData) || !isset($pickupDate) || !isset($dropoffDate)) {
                            throw new Exception('Invalid request data');
                        } else {
                            $request['pickup_date'] = $pickupDate;
                            $request['dropoff_date'] = $dropoffDate;
                            $car = new Car($carData['id'], $carData['brand'], $carData['model'], $carData['kilometrage'], $carData['description'], $carData['vitesse'], $carData['year'], $carData['image'], $carData['idOwner'], $carData['prix'], $carData['ville'], $carData['disponibilite']);
                            $result = ReservationController::addReservation($car, $request);
                            if ($result) {
                                echo json_encode(['success' => true]);
                            } else {
                         header('Location: /pages/show_car.php?id='.$carData['id']);
                                // echo json_encode(['success' => false]);
                            }
                        }
                    }
                } else {
                    echo 'Erreur JSON : ' . json_last_error_msg();
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
