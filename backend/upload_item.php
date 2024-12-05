<?php
require_once 'backend/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $status = $_POST['status'];  // 'lost' or 'found'
    $photo = $_FILES['photo']['name'];
    $photo_path = 'assets/uploads/' . $photo;  // Path to upload photo

    // Validate form fields (e.g., check for empty fields, file type)
    if (empty($name) || empty($description) || empty($category) || empty($location) || empty($status) || empty($photo)) {
        echo '<div class="alert alert-danger">All fields are required.</div>';
    } else {
        // Move the uploaded image to the "uploads" folder
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
            // Prepare SQL query to insert the item into the database
            $stmt = $conn->prepare("INSERT INTO items (user_id, name, description, category, location, status, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $user_id = 1;  // For now, set user_id as 1 (you can replace this with the logged-in user ID later)
            $stmt->bind_param("issssss", $user_id, $name, $description, $category, $location, $status, $photo_path);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Item uploaded successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="alert alert-danger">Error uploading the photo.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Upload Item</h2>
    
    <!-- Form for reporting a lost or found item -->
    <form action="upload_item.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Item Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Item Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="lost">Lost</option>
                <option value="found">Found</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Item Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
