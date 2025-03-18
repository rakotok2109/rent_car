   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav Bar</title>
    <link rel="stylesheet" href="/css/navbar.css">

   </head>
   <body>
      <!-- Navbar -->
   <div class="container navbar-container">
            <div class="logo">CAR Showcase</div>
            <nav class="navbar">
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/pages/cars.php">Nos Voitures</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">A Propos</a></li>
                    <li><a href="/pages/faq.php">FAQ</a></li>
                    <?php if (isset( $_SESSION['user'])) :
                        $user = unserialize($_SESSION['user']);
                        ?>
<li>
                <a href="#">
                <span><?php echo $user->getName();?></span>
                             <span><?php echo $user->getFirstname();?></span>
                             <i class="fa-solid fa-arrow-down"></i>
                </a>
                <ul class="dropdown">
                <?php if ($user->getIsAdmin() == 1) :
                      
                        ?>

                    <li><a href="/pages/admin/dashboard_home.php">Dashboard</a></li>
                    <?php endif; ?>

                    <li><a href="/pages/account">Comptes</a></li>

                    <li><a href="/pages/show_order">Reservations</a></li>
                    <li><a href="../../routes/verif.php?id=logout">Déconnexion</a></li>
                </ul>
            </li>

                       
                    <?php else : ?>
                        <li><a href="/pages/auth/login.php">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

        </div>
   </body>
   </html>
   
 