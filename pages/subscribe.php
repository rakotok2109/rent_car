<?php 
require_once  '../config/init.php'
 
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
    <style>
        body {
            background-color: #1a202c; /* Couleur de fond sombre */
        }
        .formulaire {
            background-color: #2d3748; /* Couleur de fond du formulaire */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        .highlight {
            background-color: #38a169; /* Couleur de surbrillance pour le bouton */
        }
        .image {
            position: relative;
            margin-top: 20px;
        }
        .circle {
            position: absolute;
            background-color: #a0e0b0; /* Couleur du cercle */
            border-radius: 50%;
            width: 300px;
            height: 300px;
            top: 50%;
            left: 70%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }
    </style>
</head>
<body>
    <!-- <?php include 'header.php'; ?>  -->

    <div class="formulaire flex flex-row items-center justify-center text-white">
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
            
            
        <form action="../pages/verif.php?id=subscribe" method="post" class="p-6 rounded">
            <label for="first_name">Prénom</label>
            <input type="text" id="firstname" name="firstname" required class="mb-4 p-2 w-full text-black" placeholder="First name">
            
            <label for="name">Nom</label>
            <input type="text" id="name" name="lastname" required class="mb-4 p-2 w-full  text-black" placeholder="Name">
            
            <label for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone" name="phone" required class="mb-4 p-2 w-full  text-black" placeholder="07 XX XX XX XX">
            
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" required class="mb-4 p-2 w-full  text-black" placeholder="mail@digital.com">
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required class="mb-4 p-2 w-full  text-black" placeholder="********">
            
            <div class="flex items-center mb-4">
                <input type="radio" id="loueur" name="role" value=1 class="mr-2">
                <label for="loueur">Loueur</label>
                <input type="radio" id="client" name="role" value=0  class="ml-4 mr-2">
                <label for="client">Client</label>
            </div>
            
            <button type="submit" class="highlight text-white p-2 rounded">S'inscrire</button>
        </form>
        </div>
       
        <div class="">
            <div class="circle">
                
            </div>
            <img src="/images/ressources/carOnSubscribeForm.png" alt="Voiture" class="w-full">
        </div>
    </div>
</body>
</html>