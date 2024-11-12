<?php 
require_once  '../config/init.php'
 
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!-- <?php include 'header.php'; ?>  -->

    <div class="container-subscribe">
        <div>
        <div >
        <h3 class="form-title">Louer les meilleures voitures sur Car Showcase</h3>
                    <p>Bienvenue ! Inscris toi pour utiliser nos services
                        !</p>
                        <?php if(isset($_SESSION['inscriptionErreur']))
        {
    echo'<div class="errorDiv">';
            
            echo '<ul>';

            foreach($_SESSION['inscriptionErreur'] as $error)
            {
                echo '<li>'.$listOfSubscribeErrors[$error].'</li>';
            }
    echo '</ul>';
    echo '</div>';
        }
           
            
        ?>
        </div>

        <form class="container-form" action="../pages/verif.php?id=subscribe"
                        method="post">
                        <div class="content-form">
                            <div class="label-input-container">
                                <label for="first_name" class="label">Prénom</label>
                                <input class="input" type="text" id="firstname"
                                    name="firstname" placeholder="First name" value="<?php echo (isset($_SESSION['firstname'])?$_SESSION['firstname']: "")?>"> 
                            </div>

                            <div class="label-input-container">
                                <label class="label" for="name">Nom</label>
                                <input class="input"  type="text" id="name" name="lastname"
                                 placeholder="Name" value="<?php echo (isset($_SESSION['lastname'])?$_SESSION['lastname']: "")?>">
                            </div>

                            <div class="label-input-container">
                                <label
                                class="label" for="phone">Numéro de téléphone</label>
                                <input class="input"  type="tel" id="phone" name="phone"
                                    placeholder="07 XX XX XX XX" value="<?php echo (isset($_SESSION['phone'])?$_SESSION['phone']: "")?>">
                            </div>

                            <div class="label-input-container">
                                <label class="label" for="email">Adresse e-mail</label>
                                <input class="input" type="email" id="email" name="email"
                                    placeholder="mail@digital.com" value="<?php echo (isset($_SESSION['email'])?$_SESSION['email']: "")?>">
                            </div>

                            <div class="label-input-container">
                                <label class="label"  for="password">Mot de passe</label>
                                <input class="input"  type="password" id="password"
                                    name="password"
                                    placeholder="********">
                            </div>
                            
                        </div>
                   

                    <div class="role-choices">
                        <input type="radio" id="loueur" name="role" value=1
                            class="radio">
                        <label for="loueur">Loueur</label>
                        <input type="radio" id="client" name="role" value=0
                            class="radio">
                        <label for="client">Client</label>
                    </div>

                   
                        <button type="submit" class="button">S'inscrire</button>
              
                </form>
        </div>
     

                <div class="image">
                <div class="circle"></div>
                <img src="../images/ressources/carOnSubscribeForm.png" alt="=Voiture"/>
            </div>


    </div>

  
        
</body>


</body>
<script src="../js/script.js">
</script>
</html>