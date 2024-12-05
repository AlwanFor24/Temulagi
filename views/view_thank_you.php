<?php
session_start();
require_once '../backend/config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch thank-you messages along with sender and recipient information
$query = "
    SELECT 
        ty.message, 
        s.name AS sender_name, 
        r.name AS recipient_name 
    FROM 
        thank_you ty
    JOIN users s ON ty.user_id = s.id
    JOIN users r ON ty.recipient_id = r.id
";
$result = $conn->query($query);

// Check query result
if ($result === false) {
    die("Error: " . $conn->error);
}

$thankYouMessages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Thank You Messages</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .carousel-container {
            position: relative;
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            overflow: hidden;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
        }

        .carousel-item h2 {
            margin: 0;
        }

        .controls {
            text-align: center;
            margin-top: 10px;
        }

        .controls button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .controls button:hover {
            background-color: #218838;
        }

        /* Add button styles */
        .add-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Thank You Messages</h1>
    
    <!-- Button to add Thank You message -->
    <a href="add_thank_you.php">
        <button class="add-button">Tambah</button>
    </a>

    <div class="carousel-container">
        <div class="carousel">
            <?php foreach ($thankYouMessages as $message): ?>
                <div class="carousel-item">
                    <h2>From: <?php echo htmlspecialchars($message['sender_name']); ?></h2>
                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                    <h3>To: <?php echo htmlspecialchars($message['recipient_name']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="controls">
        <button onclick="prev()">Previous</button>
        <button onclick="next()">Next</button>
    </div>
    
    <script>
        const carousel = document.querySelector('.carousel');
        const items = document.querySelectorAll('.carousel-item');
        let index = 0;

        function showSlide(newIndex) {
            index = (newIndex + items.length) % items.length;
            const offset = -index * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function next() {
            showSlide(index + 1);
        }

        function prev() {
            showSlide(index - 1);
        }

        // Auto-play functionality
        setInterval(() => {
            next();
        }, 5000); // Change slide every 5 seconds
    </script>
</body>
</html>
