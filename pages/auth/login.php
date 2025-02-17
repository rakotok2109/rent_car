
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Connexion</title>
</head>
</html>
<?php 
// require_once('../../config/init.php');
 
?>


<body>
<?php include '../struct/header.php';?>
    <div class="container-main-form">
        <div>
        <div >
        <h3 class="form-title">Louer les meilleures voitures sur Car Showcase</h3>
                    <p>Bienvenue ! Connectes toi pour utiliser nos services
                        !</p>
                        <?php if(isset($_SESSION['connexionErreur']))
        {
    echo'<div class="errorDiv">';
            
            echo '<ul>';

            foreach($_SESSION['connexionErreur'] as $error)
            {
                echo '<li>'.$listOfLoginErrors[$error].'</li>';
            }
    echo '</ul>';
    echo '</div>';
        }
           
            
        ?>
        </div>
        <form class="container-form" action="../../routes/verif.php?id=login" method="POST">
            <div class="content-form">
                <div class="label-input-container">
                    <label class="label" for="email"></label>
                    <input class="input" type="email" id="email" name="email"  placeholder="Email">
                </div>

                <div class="label-input-container">
                    <label class="label" for="mot_de_passe"></label>
                    <input class="input" type="password" id="password" name="password"  placeholder="Mot de passe"><br /></br />
                </div>
            </div>

            <button type="submit" class="button">Se connecter</button>
        </form>
       
   
        </div>
        <div class="image">
                <div class="circle"></div>
                <img src="../../images/ressources/carOnSubscribeForm.png" alt="=Voiture"/>
            </div>
 </div>

    <?php include '../struct/footer.php';?>
</body>
</html>