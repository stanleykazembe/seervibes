<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'music_platform');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search functionality
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM music WHERE title LIKE '%$search%' OR artist LIKE '%$search%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Platform</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
    gap: 20px;
}

.navbar .menu a {
    text-decoration: none;
    color: #fff;
    padding: 5px 10px;
    transition: background 0.3s ease;
}

.navbar .menu a:hover {
    background: #007BFF;
    border-radius: 5px;
}

        .container {
            margin: 100px auto 0;
            max-width: 800px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 70%;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color: #fff;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #333;
        }
        table tr:hover {
            background: #444;
        }
        .download-btn {
            color: #007BFF;
            text-decoration: none;
        }
        .download-btn:hover {
            text-decoration: underline;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
    <div class="logo">🎵 Seervibes</div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About Us</a>
    </div>
</div>


    <!-- Background Video -->
    <div class="video-background">
        <video autoplay muted loop>
            <source src="song.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Music Library</h1>
        <form method="get">
            <input type="text" name="search" placeholder="Search by title or artist" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <table>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Download</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['artist']); ?></td>
                    <td><a class="download-btn" href="uploads/<?php echo htmlspecialchars($row['filename']); ?>" download>Download</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>


