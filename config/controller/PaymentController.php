<?php

class PaymentController
{
    public static function createPayment($user_id, $cost, $is_paid = false, $payment_receipt = null)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "INSERT INTO payment (user_id, cost, is_paid, payment_receipt) VALUES (:user_id, :cost, :is_paid, :payment_receipt)";
        $params = array(
            ':user_id' => $user_id,
            ':cost' => $cost,
            ':is_paid' => $is_paid,
            ':payment_receipt' => $payment_receipt
        );
        $pdo->execSQL($sql, $params);
    }

    public static function getPaymentById($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "SELECT * FROM payment WHERE id = :id";
        $params = array(':id' => $id);
        $result = $pdo->requestSQL($sql, $params);
        if (count($result) > 0) {
            $payment = new Payment($result[0]['id'], $result[0]['user_id'], $result[0]['cost'], $result[0]['is_paid'], $result[0]['payment_receipt']);
            return $payment;
        }
        return null;
    }

    public static function updatePayment($id, $user_id, $cost, $is_paid, $payment_receipt)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "UPDATE payment SET user_id = :user_id, cost = :cost, is_paid = :is_paid, payment_receipt = :payment_receipt WHERE id = :id";
        $params = array(
            ':id' => $id,
            ':user_id' => $user_id,
            ':cost' => $cost,
            ':is_paid' => $is_paid,
            ':payment_receipt' => $payment_receipt
        );
        $pdo->execSQL($sql, $params);
    }

    public static function deletePayment($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $sql = "DELETE FROM payment WHERE id = :id";
        $params = array(':id' => $id);
        $pdo->execSQL($sql, $params);
    }
}