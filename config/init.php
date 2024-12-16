<?php 
if (isset($_SESSION['user']) && time() > $_SESSION['user']['expiration']) {
    session_unset(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
}

// ... code existant ...
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once ('../config/conf.inc.php');
require_once ('../config/controller/PDOUtils.php');
require_once ('../config/controller/UserController.php');
require_once ('../config/model/User.php');
require_once ('../config/model/Car.php');
require_once ('../config/model/CarReturn.php');
require_once ('../config/controller/CarController.php');
require_once ('../config/model/Reservation.php');
require_once ('../config/controller/ReservationController.php');
require_once ('../config/model/Payment.php');
require_once ('../config/controller/PaymentController.php');
require_once ('../config/controller/CarReturnController.php');

?>
