<?php
require_once("../config/init.php");

class CarController
{
    public static function addCar(Car $car)
    {
        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO cars (brand, model, kilometrage, description, vitesse, year, image, idOwner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [$car->getBrand(), $car->getModel(), $car->getKilometrage(), $car->getDescription(), $car->getVitesse(), $car->getYear(), $car->getImage(), $car->getIdOwner()]);
    }

    public static function getAllCars()
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars', []);
        $cars = [];
        foreach ($result as $car) {
            $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'], $car['description'], $car['vitesse'], $car['year'], $car['image'], $car['idOwner']);
        }
        return $cars;
    }

    public static function getCarById($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars WHERE id = ?', [$id]);
        return new Car($result[0]['id'], $result[0]['brand'], $result[0]['model'], $result[0]['kilometrage'], $result[0]['description'], $result[0]['vitesse'], $result[0]['year'], $result[0]['image'], $result[0]['idOwner']);
    }

    public static function getCarByOwner($idOwner)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars WHERE idOwner = ?', [$idOwner]);
        $cars = [];
        foreach ($result as $car) {
            $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'], $car['description'], $car['vitesse'], $car['year'], $car['image'], $car['idOwner']);
        }
        return $cars;
    }

    public static function deleteCar($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('DELETE FROM cars WHERE id =?', [$id]);
    }
    
    public static function updateCar($car)
    {
        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('UPDATE cars SET brand = ?, model = ?, kilometrage = ?, description = ?, vitesse = ?, year = ?, image = ?, idOwner = ? WHERE id = ?', [$car->getBrand(), $car->getmodel(), $car->getKilometrage(), $car->getDescription(), $car->getVitesse(), $car->getYear(), $car->getImage(), $car->getIdOwner(), $car->getId()]);
    }
}
