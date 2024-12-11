<?php
require_once("../config/init.php");

class CarController
{
    public static function addCar(Car $car)
    {
        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO cars (brand, model, kilometrage, description, vitesse, year, image, idOwner, prix, ville) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$car->getBrand(), $car->getModel(), $car->getKilometrage(), $car->getDescription(), $car->getVitesse(), $car->getYear(), $car->getImage(), $car->getIdOwner(), $car->getprix(), $car->getVille()]);
    }

    public static function getAllCars()
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars', []);
        $cars = [];
        foreach ($result as $car) {
            $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'], $car['description'], $car['vitesse'], $car['year'], $car['image'], $car['idOwner'], $car['prix'], $car['ville'], $car['disponibilite']);
        }
        return $cars;
    }

    public static function getCars($offset, $limit)
    {
        $pdo = PDOUtils::getSharedInstance();
        
        // S'assurer que OFFSET et LIMIT sont des entiers
        $offset = (int)$offset;
        $limit = (int)$limit;
        
        $result = $pdo->requestSQL('SELECT * FROM cars LIMIT ' . $offset . ', ' . $limit);
        
        $cars = [];
        if (is_array($result)) {
            foreach ($result as $car) {
                $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'],
                                  $car['description'], $car['vitesse'], $car['year'],
                                  $car['image'], $car['idOwner'], $car['prix'],
                                  $car['ville'], $car['disponibilite']);
            }
        }
    
        return $cars;
    }


    public static function getTotalCars()
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT COUNT(*) as total FROM cars', []);
        return $result[0]['total'];
    }

    public static function getCarById($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars WHERE id = ?', [$id]);
        return new Car($result[0]['id'], $result[0]['brand'], $result[0]['model'], $result[0]['kilometrage'], $result[0]['description'], $result[0]['vitesse'], $result[0]['year'], $result[0]['image'], $result[0]['idOwner'], $result[0]['prix'], $result[0]['ville'], $result[0]['disponibilite']);
    }

    public static function getCarByOwner($idOwner)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars WHERE idOwner = ?', [$idOwner]);
        $cars = [];
        foreach ($result as $car) {
            $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'], $car['description'], $car['vitesse'], $car['year'], $car['image'], $car['idOwner'], $car['prix'], $car['ville'], $car['disponibilite']);
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
        $pdo->execSQL('UPDATE cars SET brand = ?, model = ?, kilometrage = ?, description = ?, vitesse = ?, year = ?, image = ?, disponibilite = ? , idOwner = ? WHERE id = ?', [$car->getBrand(), $car->getmodel(), $car->getKilometrage(), $car->getDescription(), $car->getVitesse(), $car->getYear(), $car->getImage(), $car->getDisponibilite() ,$car->getIdOwner(), $car->getId()]);
    }

    public static function searchCar($searchTerm)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM cars WHERE brand LIKE ? OR model LIKE ? OR description LIKE ?', ["%$searchTerm%", "%$searchTerm%", "%$searchTerm%"]);
        $cars = [];
        foreach ($result as $car) {
            $cars[] = new Car($car['id'], $car['brand'], $car['model'], $car['kilometrage'], $car['description'], $car['vitesse'], $car['year'], $car['image'], $car['idOwner'], $car['id'], $car['prix'], $car['ville']);
        }
        return $cars;
    }
    
}
