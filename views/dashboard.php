<?php
include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<div class="container mt-5 text-center">
    <h2 class="pt-4">Assalamualaikum, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="view_thank_you.php">
    <button class="add-button">Ucapan Terima Kasih</button>
</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include '../includes/footer.php'; ?>
