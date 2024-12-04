<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Here you would save to the database (mock example)
    $success = "User registered successfully! You can now log in.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Music World</title>
    <link rel="stylesheet" href="singup.css">
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop id="background-video">
            <source src="song.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>

        <div class="form-container">
            <h1>Sign Up</h1>
            <?php if (isset($success)): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="signup.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn signup-btn">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>

