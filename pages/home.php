<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Car Showcase</title>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <?php include '../pages/struct/header.php'; ?>

    <!-- Section Voitures -->
    <section class="cars py-10">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Nos Voitures</h2>

            <?php
            require_once '../config/init.php'; // Inclure la configuration

            try {
                // Récupération des données depuis CarController
                $cars = CarController::getAllCars(); // Méthode pour récupérer toutes les voitures
                
                if (count($cars) === 0) {
                    echo "<p class='text-gray-500 text-center'>Aucune voiture disponible.</p>";
                } else {
                    echo "<div class='carousel flex overflow-x-auto space-x-4'>";
                    foreach ($cars as $car) {
                        echo "
                        <div class='card w-64 bg-white rounded-lg shadow-lg overflow-hidden'>
                            <img src='../images/Vehicules/{$car->getImage()}' alt='{$car->getBrand()} {$car->getModel()}' class='w-full h-40 object-cover'>
                            <div class='p-4'>
                                <h3 class='text-xl font-semibold'>{$car->getBrand()} {$car->getModel()}</h3>
                                <p class='text-gray-600'>{$car->getDescription()}</p>
                                <p class='text-sm text-gray-500'>Kilométrage : {$car->getKilometrage()} km</p>
                                <p class='text-sm text-gray-500'>Vitesse : " . ($car->getVitesse() ? 'boîte manuelle' : 'boîte auto') . "</p>
                                <p class='text-sm text-gray-500'>Année : {$car->getYear()}</p>
                            </div>
                        </div>
                       
                        
                        ";
                    }
                    echo "</div>";
                }
            } catch (Exception $e) {
                echo "<p class='text-red-500 text-center'>Erreur lors du chargement des données : {$e->getMessage()}</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../pages/struct/footer.php'; ?>
</body>

</html>
