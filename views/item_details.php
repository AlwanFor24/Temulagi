<!-- item_details.php -->
<?php include('../includes/header.php'); ?>
<?php require_once '../backend/config.php'; ?>

<?php
$item_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
if(empty($item)){
    echo '<div class="text-center mt-5">
    <h1 class="display-6 text-danger">Oops! Page Not Found 😔</h1>
    <p class="lead text-muted">It seems the page you\'re looking for isn\'t here. We\'re really sorry about that!</p>
    <div class="mt-4">
      <a href="index.php" class="btn btn-primary me-2">Go to Homepage</a>
      <a href="contact.php" class="btn btn-outline-secondary">Contact Us</a>
    </div>
  </div>';

    die();
}

$user_id = $item['user_id']; // Explicitly set user ID to prevent ambiguity
$stmt2 = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt2->bind_param("i", $user_id); // Correct type specifier is "i"
$stmt2->execute();
$result2 = $stmt2->get_result();
$item2 = $result2->fetch_assoc();
?>

<div class="container mt-5">
    
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $item['photo']; ?>" class="img-fluid" alt="Item">
        </div>
        <div class="col-md-6">
          <h2><?php echo $item['name']; ?></h2>
            <p class="mb-0"><strong class="text-capitalize"><i class="ri-calendar-2-line"></i> <?php echo $item['status']; ?> Date:</strong> <?php echo date("d-m-Y", strtotime($item['date'])); ?></p>
            <p class="mb-0"><strong><i class="ri-square-root"></i> Kategori:</strong> <?php echo $item['category']; ?></p>
            <p class="mb-0"><strong><i class="ri-eye-line"></i> Terakhir Dilihat:</strong> <?php echo $item['location']; ?></p>
            <p class="mb-0"><strong><i class="ri-aed-electrodes-line"></i>Deskripsi:</strong> <?php echo $item['description']; ?></p>
            <hr>
            <h4>Contact Person</h4>
            <p class="mb-0"><strong> <i class="ri-user-3-line"></i> Nama:</strong> <?php echo $item2['name']; ?></p>
            <p class="mb-0"><strong><i class="ri-mail-line"></i> Email:</strong> <?php echo $item2['email']; ?></p>
            <p class="mb-0"><strong><i class="ri-contacts-book-3-line"></i> Kontak:</strong> <?php echo $item2['contact_link']; ?></p>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
