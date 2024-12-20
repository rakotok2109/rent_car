<?php

class Reservation {
    private $id;
    private $payment_id;
    private $car_id;
    private $date_depart;
    private $date_retour;

    public function __construct($id = null, $payment_id, $car_id, $date_depart, $date_retour)
    {
        $this->id = $id;
        $this->payment_id = $payment_id;
        $this->car_id = $car_id;
        $this->date_depart = $date_depart;
        $this->date_retour = $date_retour;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPaymentId()
    {
        return $this->payment_id;
    }

    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    public function getCarId()
    {
        return $this->car_id;
    }

    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }

    public function getDateDepart()
    {
        return new DateTime( $this->date_depart);
    }

    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;
    }

    public function getDateRetour()
    {
        return new DateTime($this->date_retour);
    }

    public function setDateRetour($date_retour)
    {
        $this->date_retour = $date_retour;
    }
}