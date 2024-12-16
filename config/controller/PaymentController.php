<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');

class PaymentController
{
public static function createPayment($user_id, $cost, $is_paid = false, $payment_receipt = null)
{


    try {
        // Créez une nouvelle instance de Payment
        $payment = new Payment(null,(int)$user_id, (int)$cost, $is_paid, $payment_receipt);
        
        // Obtenez l'instance PDO partagée
      $pdo = PDOUtils::getSharedInstance();
        
// Réécriture de la requête d'insertion
$sql = 'INSERT INTO payements (user_id, cost, is_paid, payment_receipt) VALUES (?, ?, ?, ?)';
$params = [
    (int)$user_id,
    (int)$cost,
   (int)$is_paid,
    $payment_receipt
];

// Appel de la méthode requestSQL
$result = $pdo->requestSQL($sql, $params);
    

    // Récupère l'ID du paiement inséré
    var_dump($pdo->lastInsertId());
    $lastInsertId = $pdo->lastInsertId(); // Récupère l'ID de la dernière insertion
    $insertedPaymentData = PaymentController::getPaymentById($lastInsertId);
    
 
    
    // Si des données sont récupérées, mettez à jour l'objet Payment
    if ($insertedPaymentData) {
        $payment->setId($insertedPaymentData->getId());
    }
    else {
        throw new Exception('Erreur lors de l\'insertion du paiement dans la base de données.');
    }
    return $payment; // Retournez l'objet Payment avec les données mises à jour

       
    } catch (PDOException $e) {
        // Affiche le message d'erreur en cas d'exception PDO
        echo 'Erreur de base de données : ' . $e->getMessage();
        return null; // Retourne null en cas d'échec
    } catch (Exception $e) {
        // Affiche le message d'erreur pour d'autres exceptions
        echo 'Erreur : ' . $e->getMessage();
        return null; // Retourne null en cas d'échec
    }
}
public static function getPaymentById($id)
{
    // Vérifie si l'ID est un entier positif
    // if (!is_numeric($id) || $id <= 0) {
    //     throw new InvalidArgumentException('L\'ID doit être un entier positif.');
    // }

    $pdo = PDOUtils::getSharedInstance();
    $sql = "SELECT * FROM payements WHERE id_payement = ?";
    $params = [$id];

    try {
        $result = $pdo->requestSQL($sql, $params);
        
        // Vérifie si le résultat n'est pas vide
        if (!empty($result)) {
            // Crée un nouvel objet Payment avec les données récupérées
            $payment = new Payment(
                $result[0]['id_payement'],
                $result[0]['user_id'],
                $result[0]['cost'],
                $result[0]['is_paid'],
                $result[0]['payment_receipt']
            );
            return $payment;
        } else {
            // Aucune ligne trouvée pour cet ID
            throw new Exception('Aucun paiement trouvé avec cet ID.');
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        throw new Exception('Erreur de base de données : ' . $e->getMessage());
        // echo 'Erreur de base de données : ' . $e->getMessage();
        // return null; // Retournez null en cas d'échec
    } catch (Exception $e) {
        // Gérer d'autres exceptions
        throw new Exception('Erreur : ' . $e->getMessage());
        // echo 'Erreur : ' . $e->getMessage();
        // return null; // Retournez null en cas d'échec
     
    }
}

    public static function updatePayment($payment)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "UPDATE payment SET user_id = :user_id, cost = :cost, is_paid = :is_paid, payment_receipt = :payment_receipt WHERE id = :id";
        $params = array(
            ':id' => $payment->getId(),
            ':user_id' => $payment->getUserId(),
            ':cost' => $payment->getCost(),
            ':is_paid' => $payment->getIsPaid(),
            ':payment_receipt' => $payment->getPaymentReceipt()
        );
        $pdo->execSQL($sql, $params);
    }



    public static function deletePayment($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "DELETE FROM payements WHERE id = :id";
        $params = array(':id' => $id);
        $pdo->execSQL($sql, $params);
    }

    public static function getPaymentByUserId($user_id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result =  $pdo->requestSQL('SELECT id FROM payments WHERE user_id = ?', [$user_id]);

        $payments = [];
        foreach ($result as $payment) {
            $payments[] = new Payment($payment['id'], $payment['user_id'], $payment['cost'], $payment['is_paid'], $payment['payment_receipt']);
        }
        return $payments;

    }


    public static function submit_payment_receipt(Reservation $reservation, $request)
    {
        //Récupérer le fichier  du reçu de paiement depuis la requête
        $payment_receipt = $request->file('payment_receipt');

        // Génère un nom de fichier unique basé sur la date et le nom de l'utilisateur
        $filename =time(). 'reçu' .uniqid(). '-'. $payment_receipt->getClientOriginalName();

        // Stocker le fichier dans le système de fichiers (dans le dossier storage/receipts)
        $payment_receipt->storeAs('../../storage/receipts', $filename);

        // Met à jour le chemin du reçu de paiement dans la base de données
        $payment = PaymentController::getPaymentById($reservation->getPaymentId());
        $payment->setPaymentReceipt($filename);
        PaymentController::updatePayment($payment);

        $car = CarController::getCarById($reservation->getCarId());
        $car->setDisponibilite(0);
        CarController::updateCar($car);

        return ;
        


    }

    public function confirmPayment(Reservation $reservation)
    {
        $payment = PaymentController::getPaymentById($reservation->getPaymentId());
        $payment->setIsPaid(true);
        PaymentController::updatePayment($payment);

        
        $car = CarController::getCarById($reservation->getCarId());
        $car->setDisponibilite(0);
        CarController::updateCar($car);

        return;
    }


} 