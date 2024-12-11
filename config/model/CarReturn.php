<?php
class CarReturn
{
    private $id;
    private $reservation_id;
    private $date_of_return;
    private $validate_return;

    public function __construct($id = null, $reservation_id, $date_of_return, $validate_return)
    {
        $this->id = $id;
        $this->reservation_id = $reservation_id;
        $this->date_of_return = $date_of_return;
        $this->validate_return = $validate_return;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReservationId()
    {
        return $this->reservation_id;
    }

    public function getDateOfReturn()
    {
        return $this->date_of_return;
    }

    public function getValidateReturn()
    {
        return $this->validate_return;
    }
}
