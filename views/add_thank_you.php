<?php
include('../includes/header.php');
require_once '../backend/config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users from the database
$stmt = $conn->prepare("SELECT id, name FROM users");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logged_in_user_id = $_SESSION['user_id'];
    $selected_user_id = $_POST['user_id'];
    $message = trim($_POST['message']);

    if (!empty($message) && !empty($selected_user_id)) {
        $stmt = $conn->prepare("INSERT INTO thank_you (user_id, message, recipient_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $logged_in_user_id, $message, $selected_user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: view_thank_you.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Thank You</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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

        textarea, select {
            width: 90%;
            max-width: 500px;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        a button {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Berikan Ucapan Terima Kasih</h1>
    <form method="POST">
        <select name="user_id" required>
            <option value="">Select a User</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id']); ?>">
                    <?php echo htmlspecialchars($user['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <textarea name="message" rows="4" cols="50" placeholder="Write your thank you message here..." required></textarea><br>
        <button type="submit">Submit</button>
        <a href="view_thank_you.php"><button type="button">View Thank You Messages</button></a>
    </form>
</body>
</html>