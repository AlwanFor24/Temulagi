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


            <h2 class="text-center mb-3">Lapor Menemukan Barang</h2>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_SESSION['user_id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $location = $_POST['location'];
                $founddate = $_POST['founddate'];
                $status = 'found';

                $photo = $_FILES['photo']['name'];
                $photo_extension = pathinfo($photo, PATHINFO_EXTENSION); // Get file extension
                $unique_photo_name = uniqid('photo_', true) . '.' . $photo_extension; // Unique name
                $photo_path = '../assets/uploads/' . $unique_photo_name;
                
                // Check if a photo is uploaded and move it to the appropriate folder
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
                    $stmt = $conn->prepare("INSERT INTO items (user_id, name, description, category, location, status, photo, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssss", $user_id, $name, $description, $category, $location, $status, $photo_path, $founddate);

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
            ?>

            <form action="report_found.php" class="p-3 p-md-5 shadow" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                    <input maxlength="50" minlength="5" type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi<span class="text-danger">*</span></label>
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
                    <label for="location" class="form-label">Lokasi Ditemukan<span class="text-danger">*</span></label>
                    <input maxlength="100" minlength="5" type="text" name="location" id="location" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="founddate" class="form-label">Ditemukan pada Tanggal <span class="text-danger">*</span></label>
                    <input  type="date" max="<?php echo date('Y-m-d'); ?>" name="founddate" id="founddate" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Photo <span class="text-danger">*</span></label>
                    <input  type="file" name="photo" id="photo" class="form-control" required>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-primary px-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>