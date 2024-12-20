<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/styles.css">

    <title>Ajout de voiture</title>
</head> 
<body>  
<?php 
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');?>

    <div class="container-main-form">
        <form class="container-form" action="../../routes/verif.php?id=addcar" method="POST">
            <div class="content-form">     
                <div class="label-input-container">
                    <label class="label" for="brand"></label>
                    <input class="input" type="text" id="brand" name="brand"  placeholder="Brand">
                </div>

                <div class="label-input-container">
                    <label class="label" for="model"></label>
                    <input class="input" type="text" id="model" name="model"  placeholder="Model"><br /></br />
                </div>

                <div class="label-input-container">
                    <label class="label" for="kilometrage"></label>
                    <input class="input" type="number" id="kilometrage" name="kilometrage"  placeholder="Kilometrage"><br /></br />
                </div>

                <div class="label-input-container">
                    <label class="label" for="description"></label>
                    <input class="input" type="text" id="description" name="description"  placeholder="Description"><br /></br />
                </div>

                <div class="choices">
                        <input type="radio" id="manuelle" name="vitesse" value=1
                            class="radio">
                        <label for="loueur">Manuelle</label>
                        <input type="radio" id="automatique" name="vitesse" value=0
                            class="radio">
                        <label for="client">Automatique</label>
                </div>

                <div class="label-input-container">
                    <label class="label" for="year"></label>
                    <input class="input" type="number" id="year" name="year"  placeholder="Year"><br /></br />
                </div>

                <div class="label-input-container">
                    <label class="label" for="image"></label>
                    <input class="input" type="text" id="image" name="image"  placeholder="Lien de l'image"><br /></br />
                </div>

                <div class="label-input-container">
                    <label class="label" for="prix"></label>
                    <input class="input" type="number" id="prix" name="prix"  placeholder="Prix"><br /></br />
                </div>

                <div class="label-input-container">
                    <label class="label" for="ville"></label>
                    <input class="input" type="text" id="ville" name="ville"  placeholder="Ville"><br /></br />
                </div>

                <div class="choices">
                        <input type="radio" id="oui" name="disponibilite" value=1
                            class="radio">
                        <label for="loueur">Disponible</label>
                        <input type="radio" id="non" name="disponibilite" value=0
                            class="radio">
                        <label for="client">Non Disponible</label>
                </div>
            </div>

            <button type="submit" class="button">Ajouter ma voiture</button>
        </form>
    </div>

    <?php include '../struct/footer.php';?>
</body>
</html>

