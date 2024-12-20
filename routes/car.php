<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');

if($_GET['id'] == 'addcar') {
    $user=unserialize($_SESSION['user']);
    $idOwner = $user->getId();

    if(isset( $_SESSION['ajoutvoitureErreur']))
    {
        unset( $_SESSION['ajoutvoitureErreur']);
    }
    $car = new Car(
        $_POST['brand'],
        $_POST['model'],
        $_POST['kilometrage'],
        $_POST['description'],
        $_POST['vitesse'],
        $_POST['year'],
        $_POST['image'],
        $idOwner,
        $_POST['prix'],
        $_POST['ville'],
        $_POST['disponibilite'],         
    );

    var_dump($idOwner);

    CarController::validateBrand($car->getBrand());
    CarController::validateModel($car->getModel());
    CarController::validateKilometrage($car->getKilometrage());
    CarController::validateDescription($car->getDescription());
    CarController::validateVitesse($car->getVitesse());
    CarController::validateYear($car->getYear());   
    CarController::validateImage($car->getImage());
    CarController::validatePrix($car->getPrix());
    CarController::validateVille($car->getVille());
    CarController::validateDisponibilite($car->getDisponibilite());

    CarController::addCar($car);
    //header('Location: /');

   
   
    //header('Location: /');
}