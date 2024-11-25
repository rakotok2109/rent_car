
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Component</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Links Section -->
            <div class="footer-links">
                <div class="column">
                    <a href="#">Manage Booking</a>
                    <a href="#">Pickup Locations</a>
                    <a href="#">Payments</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="column">
                    <a href="#">Blog</a>
                    <a href="#">Careers</a>
                    <a href="#">Jobs</a>
                    <a href="#">In Press</a>
                    <a href="#">Gallery</a>
                </div>
                <div class="column">
                    <a href="#">Support</a>
                    <a href="#">WhatsApp</a>
                    <a href="#">Telegram</a>
                    <a href="#">Ticketing</a>
                    <a href="#">Call Center</a>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="footer-newsletter">
                <h3>Our news letter</h3>
                <p>Be the first one to know about discounts, offers and events. Unsubscribe whenever you like.</p>
                <form action="subscribe.php" method="POST" class="newsletter-form">
                    <input type="email" name="email" placeholder="Enter Email" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="footer-bottom">
            <p>A Member of Carento</p>
            <p>© 2000-2022, All Rights Reserved</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
