<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Showcase</title>
<link rel="stylesheet" href="/css/styles.css">


</head>

<body class="homepage">
    <!-- Header -->
    <?php include '../pages/struct/header.php'; ?>
    <?php include '../pages/struct/searchForm.php'; ?>

    <!-- Section Voitures -->
    <section class="cars">
        <div class="carsContainer">
            <hr>
            <h2>Nos Voitures</h2>

            <?php
            require_once '../config/init.php'; // Inclure la configuration

            try {
                // Récupération des données depuis CarController
                $cars = CarController::getAllCars(); // Méthode pour récupérer toutes les voitures
         

                
                if (count($cars) === 0) {
                    echo "<p class=''>Aucune voiture disponible.</p>";
                } else {
                    echo "<div class='carousel'>";
                    foreach ($cars as $car) {
                        echo "
                        <div class='card'>
                            <img src='../images/Vehicules/" . htmlspecialchars($car->getImage()) . "' alt='" . htmlspecialchars($car->getBrand() . " " . $car->getModel()) . "'>
                            <div class='card-content'>
                                <h3>" . htmlspecialchars($car->getBrand() . ' ' . $car->getModel()) . "</h3>
                                <p>" . htmlspecialchars($car->getDescription()) . "</p>
                                <p>Kilométrage : " . htmlspecialchars($car->getKilometrage()) . " km</p>
                                <p>Vitesse : " . ($car->getVitesse() ? 'Manuelle' : 'Automatique') . "</p>
                                <p>Année : " . htmlspecialchars($car->getYear()) . "</p>
                                   <a href='../pages/show_car.php?id=".htmlspecialchars($car->getId()) ."' class='book-now'>Réserver maintenant</a>
                            </div>
                        </div>
                        ";
                    }
                    echo "</div>";
                }
            } catch (Exception $e) {
                echo "<p class='r'>Erreur lors du chargement des données : {$e->getMessage()}</p>";
            }
            ?>
        </div>
    </section>

    <!-- section Appel à l'action -->
    <section class="callToAction">
    <div class="callToActionContainer">
        <div class="image">
            <img src="../images/ressources/person.png" alt="Homme">
        </div>
        <div class="content">
            <h2>Ajouter vos voiture avec CAR SHOWCASE<br>pour les louer et gagner de l'argent</h2>
            <p>Facile et rapide pour tous les véhicules !</p>
            <div class="action-buttons">
                <a href="#" class="btn primary">Ajouter ma voiture</a>
                <a href="#" class="btn secondary">Comment ça marche ?</a>
            </div>
        </div>
    </div>
</section>


    <!-- Footer -->
    <?php include '../pages/struct/footer.php'; ?>
</body>

</html>
