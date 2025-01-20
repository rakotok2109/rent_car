<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/styles.css">
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

    $cars = CarController::getCarByOwner($user->getId());

}


if( isset($_SESSION['deleteMessage'])) {
    // Affichez un message d'alerte
    echo "<script type='text/javascript'>
            alert".$_SESSION['deleteMessage'].";);
          </script>";

    unset($_SESSION['deleteMessage']);
}

// Sidebar
require_once ($_SERVER['DOCUMENT_ROOT'] . '/pages/struct/sidebar-admin.php');

?>

<section id="content-dashboard">
<nav>
            <i class="icon fa fa-menu"></i>
            <h4 class="texte">Tableau de bord Car Showcase</h4>
        </nav>

        <main>
        <div class="head-title">
        <div class="left">
            <h1>Véhicules</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <i class="icon fas fa-chevron-right "></i>
                    
                </li>
                <li>
                    <a href="../admin/dashboard_car.php" class="active">
                        Véhicules
                    </a>
                </li>
            </ul>

        </div>
        <a href="../admin/dashboard_add_car.php">
            <button class="btn btn-download">
                <i class="icon fa-solid fa-car"></i>
                <span class="text">Ajouter un véhicule</span>
            </button>
        
                
            </a>
    </div>

    <div class="table-data">
        <div class="table-content">
            <div class="head">
               
                    <h3>Vos véhicules</h3>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <i class="icon fa-solid fa-filter"></i>
        
            </div>
            <table>
        <thead>
                        <tr>
                            <th>Id_Voiture</th>
                            <th>Nom</th>
                            <th>Marque</th>
                            <th>Plaque d'immatriculation</th>
                            <th>Prix ​​/ jour</th>
                            <!-- <th>Capacité</th> -->
                            <!-- <th>Couleur</th> -->
                            <!-- <th>Carburant</th> -->
                            <th>Image</th>
                            <th>Disponible</th>
                            <th>Actions</th>
                        </tr>
        </thead>
        <tbody>

            <?php foreach($cars as $car):?>
                <tr>
                    <td><?php echo $car->getId();?></td>
                    <td><?php echo $car->getBrand();?></td>
                    <td><?php echo $car->getModel();?></td>
                    <td><?php echo $car->getModel();?></td>
                    <td><?php echo $car->getPrix();?></td>
      
                    
                    <td><img src="../../images/Vehicules/<?php echo $car->getImage();?>" alt="image"></td>
                    <td><?php echo $car->getDisponibilite() == 1 ? 'Oui' : 'Non';?></td>
                    <td class="action_btns">
                        <form action="" method="get">
                            <input type="hidden" name="id" value="<?php echo $car->getId();?>">
                            <button type="submit">
                            <i class="icon fa-solid fa-edit" style="color:green; font-size: 20px;"></i>
                            </button>
                        </form>
                        <form action="/routes/car.php?action=delete" method="POST" >
    <input type="hidden" name="id" value="<?php echo $car->getId(); ?>">
    <button class="action_btn" type="submit">
        <i class="icon fa-solid fa-trash" style="color:red; font-size: 20px;"></i>
    </button>
</form>
                    
                    </td>
                </tr>
            <?php endforeach;?>

        </tbody>
        </table>
        </div>
     
    </div>
        </main>
</section>


    
</body>
</html>