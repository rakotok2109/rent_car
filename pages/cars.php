<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Nos véhicules</title>
</head>
<body>
    <?php include '../pages/struct/header.php';?>
    <section class="cars" id="cars">
    <h1>Nos véhicules</h1>
    <div class="cars-container grid-container">
        <!-- Afficher les véhicules ici -->
        <?php
            require_once '../config/init.php'; // Inclure la configuration

            // Définir le nombre de voitures par page
            $carsPerPage = 5; 
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($currentPage - 1) * $carsPerPage;

            try {
                // Récupération des données depuis CarController avec pagination
                $cars = CarController::getCars($offset, $carsPerPage); // Méthode pour récupérer les voitures avec pagination
                $totalCars = CarController::getTotalCars(); // Méthode pour récupérer le nombre total de voitures
                $totalPages = ceil($totalCars / $carsPerPage); // Calculer le nombre total de pages

                if (count($cars) === 0) {
                    echo "<p class=''>Aucune voiture disponible.</p>";
                } else {
                    echo "<div class='row'>";

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
                                
                                ";
                                if($car->getDisponibilite() == 1){
                                    echo "<a href='/pages/show_car.php?id=" . htmlspecialchars($car->getId()) . "' class='book-now'>Réserver maintenant</a>";
                                }else{
                                   echo "<p class='notAvailable '>Non disponible</p>";
                                   
                                }

                                   echo"
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
    <?php
    // Afficher les liens de pagination si nécessaire
    if ($totalPages > 1) {
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=". $i. "#cars' class='". ($currentPage == $i? 'active' : ''). "'>". $i. "</a>";
        }
        echo "</div>";
    }
    // Fin des liens de pagination
    
    
    
    ?>
    </section>
    
  
    
    <?php include '../pages/struct/footer.php';?>
    
    <script src="script.js"></script> <!-- Ajouter votre script JavaScript ici -->
    
</body>
</html>
