<?php
include('../includes/header.php');
require_once '../backend/config.php';
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
        location.replace("login.php");
      </script>';
    exit();
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">


            <h2 class="text-center mb-3">Lapor Kehilangan Barang</h2>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_SESSION['user_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $location = $_POST['location'];
                $lostdate = $_POST['lostdate'];
                $status = 'lost';

                // File properties
                $photo = $_FILES['photo']['name'];
                $photo_size = $_FILES['photo']['size']; // File size in bytes
                $photo_tmp_name = $_FILES['photo']['tmp_name'];
                $photo_extension = strtolower(pathinfo($photo, PATHINFO_EXTENSION)); // Get file extension
                $unique_photo_name = uniqid('photo_', true) . '.' . $photo_extension; // Generate unique name
                $photo_path = '../assets/uploads/' . $unique_photo_name;

                // Validate file size (max 5MB = 5 * 1024 * 1024 bytes)
                $max_size = 5 * 1024 * 1024;

                if ($photo_size > $max_size) {
                    echo '<div class="alert alert-danger">Error: The file size exceeds the maximum limit of 5MB.</div>';
                } else {
                    // Validate allowed file extensions (optional)
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    if (!in_array($photo_extension, $allowed_extensions)) {
                        echo '<div class="alert alert-danger">Error: Only JPG, JPEG, PNG, WEBP, and GIF files are allowed.</div>';
                    } else {
                        // Move file and save to database
                        if (move_uploaded_file($photo_tmp_name, $photo_path)) {
                            $stmt = $conn->prepare("INSERT INTO items (user_id, name, description, category, location, status, photo, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssssssss", $user_id, $name, $description, $category, $location, $status, $photo_path, $lostdate);
                            if ($stmt->execute()) {
                                echo '<div class="alert alert-success">Item reported successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
                            }
                            $stmt->close();
                        } else {
                            echo '<div class="alert alert-danger">Error uploading photo.</div>';
                        }
                    }
                }
            }
            ?>


            <form action="report_lost.php" class="p-3 p-md-5 shadow" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                    <input maxlength="50" minlength="5" type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea maxlength="250" minlength="5" name="description" id="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select" name="category" id="category" required>
                        <option selected value="">Select One</option>
                        <option value="Phone">Ponsel</option>
                        <option value="Book">Kunci</option>
                        <option value="Other">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi Ditemukan <span class="text-danger">*</span></label>
                    <input maxlength="100" minlength="5" type="text" name="location" id="location" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lostdate" class="form-label">Tanggal Kehilangan <span class="text-danger">*</span></label>
                    <input type="date" name="lostdate" max="<?php echo date('Y-m-d'); ?>" id="lostdate" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Photo <span class="text-danger">*</span></label>
                    <input type="file" accept="image/*" name="photo" id="photo" class="form-control" required>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-primary px-3">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>