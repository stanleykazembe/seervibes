


<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'music_platform');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize messages
$message = "";
$messageClass = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $artist = $conn->real_escape_string($_POST['artist']);
    $file = $_FILES['file'];

    // Validate form inputs
    if (empty($title) || empty($artist) || $file['error'] !== UPLOAD_ERR_OK) {
        $message = "All fields are required, and a valid file must be selected.";
        $messageClass = "error";
    } else {
        $filename = time() . "_" . basename($file['name']);
        $destination = __DIR__ . "/uploads/" . $filename;

        // Ensure the uploads directory exists
        if (!is_dir(__DIR__ . "/uploads")) {
            mkdir(__DIR__ . "/uploads", 0777, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $sql = "INSERT INTO music (title, artist, filename) VALUES ('$title', '$artist', '$filename')";
            if ($conn->query($sql)) {
                $message = "Music uploaded successfully!";
                $messageClass = "success";
            } else {
                $message = "Database error: " . $conn->error;
                $messageClass = "error";
            }
        } else {
            $message = "Failed to upload file. Check folder permissions.";
            $messageClass = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload Music</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.8);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 10;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .navbar .menu {
            display: flex;
            gap: 15px;
        }
        .navbar .menu a {
            text-decoration: none;
            color: #fff;
            padding: 5px 30px;
            transition: background 0.3s;
        }
        .navbar .menu a:hover {
            background: #007BFF;
            border-radius: 5px;
        }
        .container {
            position: relative;
            max-width: 500px;
            margin: 100px auto 0; /* Offset for the navbar */
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="file"],
        button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.8);
            color: #000;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #28a745;
            color: white;
        }
        .error {
            background-color: #dc3545;
            color: white;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">🎵 seervibes</div>
        <div class="menu">
            <a href="index.php">Home</a>
           
        </div>
    </div>

    <!-- Background Video -->
    <div class="video-background">
        <video autoplay muted loop>
            <source src="song.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Upload Form -->
    <div class="container">
        <h1>Upload Music</h1>
        <?php if (!empty($message)) : ?>
            <div class="message <?php echo $messageClass; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Music Title" required>
            <input type="text" name="artist" placeholder="Artist Name" required>
            <input type="file" name="file" accept=".mp3,.wav" required>
            <button type="submit">Upload
