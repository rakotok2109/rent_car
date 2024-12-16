<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">

    <title>Details</title>
</head>

<body>
    <session class="details">
        <?php include '../pages/struct/header.php'; ?>
        <?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $car = CarController::getCarById($car_id);
    if ($car) {
        $car_data = $car->jsonSerialize();
        if ($car_data) {
            $carJson = json_encode($car_data);
        
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo 'Erreur lors de la conversion en JSON : ' . json_last_error_msg();
                var_dump($car_data); // Affichez les données pour comprendre le problème
                exit();
            }
        }
    } else {
        echo "Car not found";
        exit();
    }
} else {
    echo "Car not found";
    exit();
}
?>
        <div class="details_container1">
            <div class="card_details">
                <div class="row">
                    <div class="car-image">
                        <img src="../images/Vehicules/<?php echo $car->getImage() ?>" alt="<?php echo $car->getBrand() . ' ' . $car->getModel() ?>">
                        
                    </div>
                    <div class="car-details">
                        <h1><?php echo htmlspecialchars($car->getBrand() . ' ' .  $car->getmodel())  ?></h1>
                        <p class="price">€ <?php echo htmlspecialchars($car->getPrix()); ?>/jour</p>
                        <p class="ville">Ville limite: <?php echo !empty($car->getVille()) ? htmlspecialchars($car->getVille()) : 'Non spécifié'; ?></p>
                        <form action="../routes/reservation.php" method="post">
<?php 
if (!empty($carJson)) {
    echo '<input type="hidden" name="car" value="' . htmlspecialchars($carJson) . '">';
} else {
    echo 'Erreur : Les données du véhicule ne sont pas disponibles.';
    exit();
}
?>

<div class="label-input-container">
                                <label for="pickup-date" class="label">Date Emprunt</label>
                                <input type="date" name="pickup-date" class="form-control" id="pickup-date" required>
                            </div>
                            <div class="label-input-container">
                                <label for="dropoff-date" class="label">Date Retour</label>
                                <input type="date" name="dropoff-date" class="form-control" id="dropoff-date" required>
                            </div>
                            <button class="btn btn-primary" type="submit">Réserver maintenant</button>
                        </form>
                        <?php if (isset($_SESSION['reservationErreur'])) {
                            echo '<div class="errorDiv">';

                            echo '<ul>';
                            
                            foreach ($_SESSION['reservationErreur'] as $error) {
                                echo '<li>' . htmlspecialchars($listOfRentCarError[$error]) . '</li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="details_container2">
            <div class="card_details">
                <h5 class="text-center">Fiche du produit</h5>
                <hr>
                <div class="detail-product row text-center">
                    <div class="col">
                        <p class="mb-1">Marque</p>
                        <p><?php echo htmlspecialchars($car->getBrand()); ?></p>
                    </div>
                    <div class="col">
                        <p class="mb-1">Type</p>
                        <p><?php echo htmlspecialchars($car->getmodel()); ?></p>
                    </div>
                    <div class="col">
                        <p class="mb-1">Boîte de vitesse</p>
                        <p><?php echo htmlspecialchars($car->getVitesse() === 1 ? 'Automatique' : 'Manuelle'); ?></p>
                    </div>
                    <div class="col">
                        <p class="mb-1">Année</p>
                        <p><?php echo htmlspecialchars($car->getYear()); ?></p>
                    </div>
                </div>
                <hr>
                <div class="detail-desc">
                    <h3 class="text-center">Description</h3>
                    <p class="text-center">
                        <?php echo                         htmlspecialchars($car->getDescription())
;?>
                    
                    <!-- Cette voiture offre une variété de fonctionnalités possibles
                    Une expérience de conduite confortable, sûre et sophistiquée.Avec un design moderne et
                    Aérodynamique, cette voiture a les caractéristiques suivantes: <br>
                    1. Haute performance: la voiture est équipée d'un moteur haut de gamme qui offre une accélération et une
                    vitesse maximale impressionnantes.Le système de direction réactif est également disponible avec une
                    précision et un contrôle stable. <br>
                   2. Connectivité numérique: avec le dernier système d'infodivertissement, cette voiture fournit une
                    Connectivité numérique extraordinaire.Les conducteurs et les passagers peuvent être connectés à un smartphone
                    , accéder aux applications, écoutez de la musique ou utiliser facilement la navigation via l'écran
                    Touch intuitif. <br>
                  3. Sécurité de haut niveau: fonctionnalités de sécurité avancées telles que les systèmes de freinage antiblocage, les superviseurs
                     d'angles morts, les caméras arrières et les capteurs de stationnement aident à réduire le risque d'accidents.Cette voiture est aussi
                    équipée de coussins gonflables (airbags) et de systèmes de freinage d'urgence qui optimisent la 
                    protection des passagers.<br>
                    4. Caractéristique de confort: avec un fauteuil confortable et un réglage électrique, le conducteur peut trouver une
                    position idéale.Autres fonctionnalités telles que la climatisation automatique, le chauffage des sièges, le système audio
                    La clime et le contrôle de la température de la double zone assurent un confort maximal pour votre trajet.<br>
                   5. Efficacité énergétique: cette voiture est équipée d'une technologie qui optimise l'efficacité des matériaux
                    GRILD, comme un système hybride ou un moteur respectueux de l'environnement.Cela aide à réduire la consommation de carburants et l'émission de gaz à effet de serre.<br>
                    6. Conception innovante: la conception extérieure de cette voiture se démarque avec des lignes aérodynamiques élégantes
                    et des détails charmants.Un intérieur grand et polyvalent offre suffisamment d'espace pour
                    passagers et bagages.<br>
                    Cette voiture est une manifestation des progrès de la technologie automobile qui unit de haute performance,
                    sécurité, confort, efficacité et beauté dans un ensemble incroyable </p> -->
         
                    </p>
                </div>
            </div>

        </div>
        </div>
    </session>

    <?php include '../pages/struct/footer.php';?>

</body>

</html>