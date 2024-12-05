<?php
require_once '../backend/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $user_proof = $_FILES['proof']['name'];
    $proof_path = 'assets/uploads/proofs/' . $user_proof;

    // Move uploaded proof file to the correct folder
    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // Prepare an update query to link the proof to the item
        $stmt = $conn->prepare("UPDATE items SET proof_photo = ? WHERE id = ?");
        $stmt->bind_param("si", $proof_path, $item_id);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Proof submitted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Error uploading proof file.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Proof of Ownership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Submit Proof of Ownership</h2>

        <!-- Form to submit proof for an item -->
        <form action="submit_proof.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="item_id" class="form-label">Item ID</label>
                <input type="number" name="item_id" id="item_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="proof" class="form-label">Upload Proof</label>
                <input type="file" name="proof" id="proof" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Proof</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
