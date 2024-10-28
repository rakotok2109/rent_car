<?php 
require_once  '../config/init.php'
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
<body>
    <div class="form-container">
        <form action="../pages/verif.php?id=login" method="POST">
            <label for="email"></label>
            <input type="email" id="email" name="email"  placeholder="Email">
        
            <label for="mot_de_passe"></label>
            <input type="password" id="password" name="password"  placeholder="Mot de passe"><br /></br />
            
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</body>
</html>