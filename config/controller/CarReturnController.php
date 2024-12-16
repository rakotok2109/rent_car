<?php

require_once ('../config/init.php');


class CarReturnController
{

    public static function addCarReturn ($reservation_id)
    {
        $pdo = PDOUtils::getSharedInstance();
     $result=   $pdo->execSQL('INSERT INTO car_returns (reservation_id, date_of_return, validate_return) VALUES (?, ?, ?)', [$reservation_id, null, 0]);

     return $result;

    }
    public static function getCarReturn ()
    {
        $pdo = PDOUtils::getSharedInstance();
       $result = $pdo->requestSQL('SELECT * FROM car_returns', []);
        
       $carReturns= [];
       foreach($result as $row) {
            $carReturn = new CarReturn($row['id'], $row['reservation_id'],$row['date_of_return'], $row['validate_return']);
            $carReturns[] = $carReturn;
       }
    }

    public static function update_return (CarReturn $carReturn, $request)
    {
        $date_of_return = $request['date_of_return'];

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('UPDATE car_returns SET date_of_return =?, validate_return =? WHERE id =?', [$date_of_return, true, $carReturn->getId()]);

        $reservation = ReservationController::getReservationById($carReturn->getReservationId());
        
        $car = CarController::getCarById($reservation[0]['car_id']);

        $car->setDisponibilite(1);
        CarController::updateCar($car);

        return;
        
   
    }
}