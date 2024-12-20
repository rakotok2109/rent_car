
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

<?php include '../struct/header.php';?>
<body>
    <div class="container-main-form">
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

    <?php include '../struct/footer.php';?>
</body>
</html>