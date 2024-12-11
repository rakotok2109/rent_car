<?php

class Payment {
    private $id;
    private $user_id;
    private $cost;
    private $is_paid;
    private $payment_receipt;

    public function __construct($id = null, $user_id, $cost, $is_paid=false, $payment_receipt=null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->cost = $cost;
        $this->is_paid = $is_paid;
        $this->payment_receipt = $payment_receipt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getIsPaid()
    {
        return $this->is_paid;
    }

    public function setIsPaid($is_paid)
    {
        $this->is_paid = $is_paid;
    }

    public function getPaymentReceipt()
    {
        return $this->payment_receipt;
    }

    public function setPaymentReceipt($payment_receipt)
    {
        $this->payment_receipt = $payment_receipt;
    }
}
