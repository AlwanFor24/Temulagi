<?php
include('../includes/header.php');
require_once '../backend/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
   

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
           
            $_SESSION["user_id"] =  $user['id'];
            $_SESSION["username"] = $user['name'];
            
            echo '<script type="text/javascript">
        location.replace("dashboard.php");
      </script>';
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">


            <h2 class="text-center mb-3">Login </h2>
            <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="p-3 p-md-5 shadow" method="POST">
                <div class="mb-3">
                    <input maxlength="50" minlength="5" type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required>
                </div>
                <div class="mb-3">
                
                    <input maxlength="50" minlength="5" type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" required>
                </div>
                <div class="border-bottom pb-3 pt-3 text-center">
                <button type="submit" class="btn btn-primary px-3">Login</button>    
                </div>
                <div class="mt-3">
                    <p class="text-center mb-0"> <small>Don't have an account? <a href="register.php">Register</a></small></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>