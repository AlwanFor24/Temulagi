<!-- view_items.php -->
<?php include('../includes/header.php'); ?>
<?php require_once '../backend/config.php'; ?>

<div class="container mt-5">
    <h2>All Lost and Found Items</h2>
    <div class="row">
        <?php
        $result = $conn->query("SELECT * FROM items ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-3">';
            echo '<div class="card">';
            echo '<img src="' . $row['photo'] . '" class="card-img-top" alt="Item">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['name'] . '</h5>';
            echo '<p class="card-text">' . $row['description'] . '</p>';
            echo '<a href="item_details.php?id=' . $row['id'] . '" class="btn btn-primary">View Details</a>';
            echo '</div></div></div>';
        }
        ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
