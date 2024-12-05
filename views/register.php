<?php
require_once '../backend/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contactlink = $_POST['contactlink'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check_query = $conn->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
    $check_query->bind_param("ss", $username, $email);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        $error = "Username or email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, contact_link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $contactlink);

        if ($stmt->execute()) {
            header("Location: login.php?success=registered");
            exit();
        } else {
            $error = "Registration failed. Try again!";
        }
        $stmt->close();
    }
}
?>
<?php include('../includes/header.php'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">


            <h2 class="text-center mb-3">Register </h2>
            <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
            <form action="register.php" class="p-3 p-md-5 shadow" method="POST">
                <div class="mb-3">
                    <input maxlength="50" minlength="5" type="text" name="username" id="username" class="form-control" placeholder="Enter Your Name" required>
                </div>
                <div class="mb-3">
                    <input maxlength="50" minlength="5" type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required>
                </div>
               
                <div class="mb-3">
                    <input maxlength="50" minlength="5" type="password" name="password" id="password" class="form-control" placeholder="Enter Your Passowrd" required>
                </div>
                <div class="mb-3">
                    <input maxlength="100" minlength="5" type="text" name="contactlink"  class="form-control" placeholder="Your Contact Link (Phone/FB link/Whatsapp)" required>
                </div>
                <div class="border-bottom pb-3 pt-3 text-center">
                    <button type="submit" class="btn btn-primary px-3">Register</button>
                </div>
                <div class="mt-3">
                    <p class="text-center mb-0"> <small>Have an account? <a href="login.php">Login</a></small></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>