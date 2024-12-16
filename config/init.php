<?php 
if (isset($_SESSION['user']) && time() > $_SESSION['user']['expiration']) {
    session_unset(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
}

// ... code existant ...
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/conf.inc.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/PDOUtils.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/UserController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/model/User.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/model/Car.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/model/CarReturn.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/CarController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/model/Reservation.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/ReservationController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/model/Payment.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/PaymentController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rent_car/config/controller/CarReturnController.php');

?>
