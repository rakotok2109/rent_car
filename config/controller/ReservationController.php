<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');

class ReservationController 
{
    private static function isDateValid($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
     // Ajouter une commande/reservation liée à une voiture
     public static function addReservation(Car $car,  $request) 
     {
        try{
                 //Vérification des dates
        $pickup_date = $request['pickup_date'];
        $dropoff_date = $request['dropoff_date'];
        
        if (!self::isDateValid($pickup_date) || !self::isDateValid($dropoff_date)) {
            $_SESSION['reservationErreur'][] = 1;
            return false;
        }
        $pickup_date = new DateTime($pickup_date);
        $dropoff_date = new DateTime($dropoff_date);

        if ($dropoff_date <= $pickup_date) {
            $_SESSION['reservationErreur'][] = 0;
            return false;
        }


        // Récupération de l'ID de l'utilisateur authentifié et de l'ID de la voiture
        $user = unserialize($_SESSION['user']);
        $user_id = $user->getId();

        

        // Calcul du coût de la location en fonction des dates choisies
        $days_rental = $dropoff_date->diff($pickup_date)->days;
        $cost = $days_rental * $car->getPrix();

        // Création d'un paiement pour la commande
    $payment=    PaymentController::createPayment($user_id, $cost, false, null);

    // Vérification que les dates sont des objets DateTime
if (!($pickup_date instanceof DateTime) || !($dropoff_date instanceof DateTime)) {
    throw new InvalidArgumentException('Les dates doivent être des objets DateTime.');
}
        // Création de la reservation/commande liée à la voiture, au paiement et aux dates de location
        $reservation = new Reservation(null,$payment->getId(),$car->getId(),$pickup_date->format('Y-m-d H:i:s'),$dropoff_date->format('Y-m-d H:i:s'));

        $pdo = PDOUtils::getSharedInstance();
        $pdo->requestSQL(
            'INSERT INTO reservations( payment_id, car_id, date_depart, date_retour) VALUES(?,?,?,?)',
            [
                (int)$reservation->getPaymentId(),
                (int)$reservation->getCarId(),
                $reservation->getDateDepart()->format('Y-m-d H:i:s'), // Correction ici
                $reservation->getDateRetour()->format('Y-m-d H:i:s')  // Correction ici
            ]
        );
        
        $reservation_inserted =ReservationController::getReservationById($pdo->lastInsertId());
       
        $reservation->setId($reservation_inserted['id_order']);


        // Création d'une entrée dans CarReturn liée à la commande
      $result =  CarReturnController::addCarReturn($reservation->getId());
      if($result){
          return [
            'status' => true,
            'reservation_id' => $reservation->getId(),
            'payment_id' => $payment->getId()
          ];
        }
        return [
            'status' => false,
            'error' => 'Erreur lors de la création de la réservation.'
        ];


        }catch(Exception $e){
            throw new Exception($e->getMessage());
            $_SESSION['reservationErreur'][] = 3;
            return false;
        }
       
        

     }

     // Récuperer les réservations de l'utilisateur authentifié
     public static function getReservationsByUser($offset = null, $limit = null) {
        $user = unserialize($_SESSION['user']);
        $user_id = $user->getId();
        $pdo = PDOUtils::getSharedInstance();
        
        // Récupérer les paiements de l'utilisateur
        $payments = PaymentController::getPaymentByUserId($user_id);
        
        // Récupérer les IDs des paiements
        $payment_ids = [];
        foreach ($payments as $payment) {
            $payment_ids[] = $payment->getId();
        }
        
        // Récupérer les réservations ayant pour payment_id ces IDs de paiement
        if (empty($payment_ids)) {
            return []; // Retourner un tableau vide si aucun paiement n'est trouvé
        }
        $placeholders = implode(',', array_fill(0, count($payment_ids), '?'));
        $query = "SELECT * FROM reservations WHERE payment_id IN ($placeholders)";
        if (!is_null($offset) && !is_null($limit)) {
            $query .= " LIMIT " . $offset . ", " . $limit;
        }
        $results = $pdo->requestSQL($query, $payment_ids);
        $reservations = [];
        foreach ($results as $result) {
            $reservations[] = new Reservation($result['id_order'], $result['payment_id'], $result['car_id'], $result['date_depart'], $result['date_retour']);
        }
        
        return $reservations;
     }

     //Récupérer les réservations liées à un payement
     public static function getReservationByPaymentId($payment_id)
     {
    
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM reservations WHERE payment_id =?',[$payment_id])[0];
        $reservation = new Reservation($result['id_order'], $result['payment_id'], $result['car_id'], $result['date_depart'], $result['date_retour']);
        return $reservation;

     }
    

      
     //Récupérer une réservation par son id
     public static function getReservationById($id) {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM reservations WHERE id_order =?',[$id])[0];
        $reservation = new Reservation($result['id_order'], $result['payment_id'], $result['car_id'], $result['date_depart'], $result['date_retour']);

        return $reservation;
     }
     //Récupérer toutes les réservations
     public static function getAllReservations($offset = null, $limit = null) {
        $pdo = PDOUtils::getSharedInstance();
        $query = 'SELECT * FROM reservations';
        if (!is_null($offset) && !is_null($limit)) {
            $query .= ' LIMIT ' . $offset . ', ' . $limit;
        }
        $results = $pdo->requestSQL($query);
        $reservations = [];
        foreach ($results as $result) {
            $reservations[] = new Reservation($result['id_order'], $result['payment_id'], $result['car_id'], $result['date_depart'], $result['date_retour']);
        }
        return $reservations;
     }

     public static function updateReservation($reservation) {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->execSQL('UPDATE reservations SET payment_id = ?, car_id = ?, date_depart = ?, date_retour = ? WHERE id = ?', [$reservation->getPaymentId(), $reservation->getCarId(), $reservation->getDateDepart(), $reservation->getDateRetour(), $reservation->getId()]);
        if($result){
            return true;
        }
        return false;
     }

     // Supprimer une réservation
     public static function deleteReservation($id) {
        $pdo = PDOUtils::getSharedInstance();
        $result=$pdo->execSQL('DELETE FROM reservations WHERE id_order =?',[$id]);
        if($result){
            return true;
        }
        return false;
     }

}