<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header class="header">
        <!-- Navbar -->
        <div class="container navbar-container">
            <div class="logo">NN CAR</div>
            <nav class="navbar">
                <ul>
                    <li><a href="#">Réserver</a></li>
                    <li><a href="#">Nos Voitures</a></li>
                    <li><a href="/pages/faq.php">FAQ ?</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <button class="btn">Connexion / Inscription</button>
            </div>
        </div>
    </header>
<!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero1">
            <div class="hero-text">
                <h1>TROUVE ET RÉSERVE LES MEILLEURS VOITURES FACILEMENT</h1>
            </div>
            <div class="car-image">
                <div class="cercle"></div>
                <img src="/images/ressources/carOnSubscribeForm.png" alt="=Voiture"/>
            </div>
            </div>
          
            <div class="search-box">
                <form class="search-form">
                    <div class="label-input-container">
                        <label for="pickup">Pickup Location</label>
                        <input type="text" id="pickup" placeholder="Cruise Port">
                    </div>
                    <div class="label-input-container">
                        <label for="dropoff">Drop-off Location</label>
                        <input type="text" id="dropoff" placeholder="Miami Intl. Airport">
                    </div>
                    <div class="label-input-container">
                        <label for="pickup-date">Pickup Date & Time</label>
                        <input type="datetime-local" id="pickup-date">
                    </div>
                    <div class="label-input-container">
                        <label for="dropoff-date">Drop-off Date & Time</label>
                        <input type="datetime-local" id="dropoff-date">
                    </div>
                    <button class="btn btn-primary" type="submit">Find a Car</button>
                </form>
            </div>
        </div>
    </section>

   
</body>
</html>
