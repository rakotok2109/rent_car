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
            <div class="logo">NN CAR</div>
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
                        <li><a href="/pages/account">
                            <!-- <i class="fas fa-user"></i> -->
                             <span><?php echo $user->getName();?></span>
                             <span><?php echo $user->getId();?></span>
                            <i class="fas fa-user"></i>

                            </a></li>
                        <li><a href="../../routes/verif.php?id=logout">Déconnexion</a></li>
                    <?php else : ?>
                        <li><a href="/pages/auth/login.php">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

        </div>
   </body>
   </html>
   
 