<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/styles.css">

    <title>Dashboard</title>
</head>
<body>
<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if($_SESSION['user'] == null){
    header('Location: /pages/auth/login.php');
}
else{
    $user = unserialize($_SESSION['user']);
    if($user->getRole() != 1){
        header('Location: /pages/home.php');
    }

    $reservations = ReservationController::getAllReservations();

}

// Sidebar
require_once ($_SERVER['DOCUMENT_ROOT'] . '/pages/struct/sidebar-admin.php');

?>

<!-- MAIN -->

<main>
    <div class="head-title">
        <div class="left">
            <h1>Accueil</h1>
            <ul class="nav">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <i class="icon fas fa-chevron-right "></i>
                    
                </li>
                <li>
                    <a href="../admin/dashboard_home.php" class="active">
                        Accueil
                    </a>
                </li>
            </ul>

        </div>
    </div>

    <div class="table-data">
       <div class="reservation">
        <div class="head">
        <h3>États financiers CarHub</h3>
                    <button onclick="" class="btn-pdf">Télécharger
                        PDF</button>
                        <!-- todo -->
            <a href="" class="btn btn-primary">Par semaine</a>
            <a href="" class="btn btn-primary">Par mois</a>
            <a href="" class="btn btn-primary">Par année</a>

        </div>
        <table>
            <thead>
                <?php 
                    $no=0;
                    $totalCost = 0;
                ?>
                <tr>
                    <th>No</th>
                    <th>ID Réservation</th>
                    <th>Date de retour</th>
                    <th>Montant payé</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation):
                    $payement = PaymentController::getPaymentById($reservation->getPaymentId());
                    ?>
                    <?php $totalCost += $payement->getCost(); $no++;?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $reservation->getId();?></td>
                        <td><?php echo $reservation->getDateRetour()->format('d-m-Y');?></td>
                        <td><?php echo $payement->getCost();?></td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?php echo $totalCost;?></td>
                </tr>
            </tbody>
        </table>
       </div>
    </div>
</main>

    
</body>
</html>