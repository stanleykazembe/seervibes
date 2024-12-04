<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mock validation (Replace with DB verification)
    if ($username == "admin" && $password == "password") {
        session_start();
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Music World</title>
    <link rel="stylesheet" href="singin.css">
</head>
<body>
    <div class="video-container">
        <video autoplay muted loop id="background-video">
            <source src="song.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>

        <div class="form-container">
            <h1>Login</h1>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

