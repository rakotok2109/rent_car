<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/styles.css">
    <title>Document</title>

</head>
<body>
<div>

    <section id="sidebar">
        <?php 
            require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');

            $user = unserialize( $_SESSION['user']);
            $currentUrl = htmlspecialchars($_SERVER['REQUEST_URI']);
            
            
        ?>
              <a href="#" class="brand" style="margin-left:20px">
            <i class="icon fas fa-car"></i>
           
            <span class="texte"><?php echo $user->getName() . ' '. $user->getFirstname()  ?></span>
        </a>

        <ul class="side-menu top">

        <li class="<?= strpos($currentUrl, 'dashboard_home.php') !== false ? 'active' : '' ?>" >
            <a href="../admin/dashboard_home.php">
                <i class="icon fas fa-tachometer-alt"></i>
                <span  class="texte">Tableau de bord</span>
            </a>
        </li>

        <li class="<?php strpos($currentUrl, 'dashboard_car.php') !== false ? 'active' : '' ?>" >
            <a href="../admin/dashboard_car.php">
            <i class="icon fa-solid fa-car"></i>
                <span  class="texte">Véhicules</span>
            </a>
        </li>
        <?php if($user->getIsAdmin() == 1): ?>
        <li class="<?php strpos($currentUrl, 'dashboard_user') !== false ? 'active' : '' ?>" >
            <a href="../admin/dashboard_users.php">
                <i class="icon fa fa-users
                "></i>
                <span  class="texte">Utilisateurs</span>
            </a>
        </li>
        <?php endif; ?>
        <li class="<?php strpos($currentUrl, 'dashboard_order')!== false ? 'active' : '' ?>" >
            <a href="../admin/dashboard_order.php">
                <i class="icon fa fa-shopping-cart
                "></i>
                <span class="texte">Réservations</span>
            </a>
        </li>
        <li class=<?php strpos($currentUrl, 'dashboard_order') !== false ? 'active' : '' ?> >
            <a href="../admin/dashboard_order.php">
                <i class="icon fa fa-credit-card
                "></i>
                <span class="texte">Retour de véhicules</span>
            </a>
        </li>

        </ul>

        <ul class="side-menu bottom">
            <li>
                <a href="#" class="logout">
                    <i class="icon fas fa-sign-out-alt"></i>
                    <span class="texte">Déconnexion</span>
                </a>
            </li>
        </ul>

    </section>

  
</div>
</body>
</html>

