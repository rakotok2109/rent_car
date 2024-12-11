<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Document</title>
</head>
<body>
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
    
</body>
</html>