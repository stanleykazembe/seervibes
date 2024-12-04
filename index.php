<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music World</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
   
    <header class="header">
        <div class="logo">🎵 Musicvibes</div>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="about.html">About</a>
            <a href="features.php">Features</a>
            <a href="contact.html">contact us</a>
           
        </nav>
        <div class="auth-buttons">
            <a href="login.php" class="btn login-btn">Login</a>
            <a href="singup.php" class="btn signup-btn">Sign Up</a>
        </div>
    </header>
    <section class="hero">
        <video autoplay muted loop class="bg-video">
            <source src="song.mp4" type="video/mp4">
          
        </video>

    <div class="hero-content">
            <h1>Welcome to Music World</h1>
            <h2>Login if you have an account, or Sign Up if you don't!</h2>
            <div class="cta-buttons">
                <a href="login.php" class="btn login-btn">Login</a>
                <a href="signup.php" class="btn signup-btn">Sign Up</a>
                <a href="adminlogin.php" class="btn adminlogin-btn">seer</a>
            </div>
        </div>
    </section>
    

    <footer class="footer">
        <p>&copy; 2024 Music World. All Rights Reserved.</p>
        <nav class="footer-nav">
            <a href="index.php">Home</a>
            <a href="#features">Features</a>
            <a href="#about">About</a>
        </nav>
    </footer>
</body>
</html>

