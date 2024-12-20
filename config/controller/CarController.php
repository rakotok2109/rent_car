<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');


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
    
    public static function validateBrand($brand) {
        if (empty($brand)) {
            throw new Exception("Le champ 'Brand' est obligatoire.");
        }
        if (strlen($brand) > 50) {
            throw new Exception("Le champ 'Brand' ne doit pas dépasser 50 caractères.");
        }
        return true;
    }

    public static function validateModel($model) {
        if (empty($model)) {
            throw new Exception("Le champ 'Model' est obligatoire.");
        }
        if (strlen($model) > 50) {
            throw new Exception("Le champ 'Model' ne doit pas dépasser 50 caractères.");
        }
        return true;
    }

    public static function validateKilometrage($kilometrage) {
        if ($kilometrage < 0) {
            throw new Exception("Le kilométrage doit être un nombre positif.");
        }
        return true;
    }

    public static function validateDescription($description) {
        if (empty($description)) {
            throw new Exception("Le champ 'Description' est obligatoire.");
        }
        if (strlen($description) > 255) {
            throw new Exception("Le champ 'Description' ne doit pas dépasser 255 caractères.");
        }
        return true;
    }

    public static function validateVitesse($vitesse) {
        if (!in_array($vitesse, [0, 1])) {
            throw new Exception("Le champ 'Vitesse' doit être 0 (Automatique) ou 1 (Manuelle).");
        }
        return true;
    }

    public static function validateYear($year) {
        $currentYear = (int)date("Y");
        if ($year < 1900 || $year > $currentYear) {
            throw new Exception("L'année doit être comprise entre 1900 et $currentYear.");
        }
        return true;
    }

    public static function validateImage($image) {
        if (empty($image)) {
            throw new Exception("Le champ 'Image' est obligatoire.");
        }
        if (strlen($image) > 255) {
            throw new Exception("Le champ 'Image' doit contenir une URL valide.");
        }
        return true;
    }

    public static function validatePrix($prix) {
        if ($prix < 0) {
            throw new Exception("Le prix doit être un nombre positif.");
        }
        return true;
    }

    public static function validateVille($ville) {
        if (empty($ville)) {
            throw new Exception("Le champ 'Ville' est obligatoire.");
        }
        if (strlen($ville) > 100) {
            throw new Exception("Le champ 'Ville' ne doit pas dépasser 100 caractères.");
        }
        return true;
    }

    public static function validateDisponibilite($disponibilite) {
        if (!in_array($disponibilite, [0, 1])) {
            throw new Exception("Le champ 'Disponibilité' doit être 0 (Non Disponible) ou 1 (Disponible).");
        }
        return true;
    }
}
