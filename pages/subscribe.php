<?php 
require_once  '../config/init.php'
 
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #1a202c; /* Couleur de fond sombre */
        }
        .formulaire {
         
            padding: 20px;
           
        }
     
        .image {
            position: relative;
            margin-top: 20px;
           
        }
        .circle {
            position: absolute;
            background-color:#D5FD05 ; /* Couleur du cercle */
            border-radius: 50%;
            width: 300px;
            height: 300px;
            top: 50%;
            left: 85%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }
    </style>
</head>
<body>
    <!-- <?php include 'header.php'; ?>  -->

    <div class="formulaire flex flex-col-reverse md:flex-row items-center justify-center text-white">
        <div class="">
        <h3 class="text-3xl font-bold mb-4 text-lime-400">Louer les meilleures voitures sur Car Showcase</h3>
        <p>Bienvenue ! Inscris-toi pour utiliser nos services !</p>
        <?php if(isset($_SESSION['inscriptionErreur']))
        {
    echo'<div class="bg-red-500 p-2 rounded mt-4">';
            
            echo '<ul>';

            foreach($_SESSION['inscriptionErreur'] as $error)
            {
                echo '<li>'.$listOfSubscribeErrors[$error].'</li>';
            }
    echo '</ul>';
    echo '</div>';
        }
           
            
        ?>
            
            
        <form action="../pages/verif.php?id=subscribe" method="post" class="form p-4 rounded bg-white w-4/5 mt-5">
            <label class="label"  for="first_name">Prénom</label>
            <input type="text" id="firstname" name="firstname" required class="input" placeholder="First name" value="<?php echo (isset($_SESSION['firstname'])?$_SESSION['firstname']: "")?>">
            
            <label class="label" for="name">Nom</label>
            <input type="text" id="name" name="lastname" required class="input" placeholder="Name" value="<?php echo (isset($_SESSION['lastname'])?$_SESSION['lastname']: "")?>">
            
            <label class="label" for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone" name="phone" required class="input" placeholder="07 XX XX XX XX" <?php echo (isset($_SESSION['phone'])?$_SESSION['phone']: "")?>>
            
            <label class="label" for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" required class="input" placeholder="mail@digital.com" <?php echo (isset($_SESSION['email'])?$_SESSION['email']: "")?>>
            
            <label class="label" for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required class="input" placeholder="********">
            
            <div class="flex items-center mb-4">
                <input type="radio" id="loueur" name="role" value=1 class="mr-2">
                <label class="label" for="loueur">Loueur</label>
                <input type="radio" id="client" name="role" value=0  class="ml-4 mr-2">
                <label class="label" for="client">Client</label>
            </div>
            
            <button type="submit" class="button">S'inscrire</button>
        </form>
        </div>
       
        <div class="">
            <div class="circle">
                
            </div>
            <img src="/images/ressources/carOnSubscribeForm.png" alt="Voiture" >
        </div>
    </div>
</body>


</body>
<script src="../js/script.js">
</script>
</html>