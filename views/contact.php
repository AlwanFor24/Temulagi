<?php include('../includes/header.php'); ?>
<?php require_once '../backend/config.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">


            <h2 class="text-center mb-3">Contact Us</h2>

            <?php
            require '../PHPMailer/src/PHPMailer.php';
            require '../PHPMailer/src/SMTP.php';
            require '../PHPMailer/src/Exception.php';

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            $mail = new PHPMailer(true);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'mail address'; // Your Gmail address
                    $mail->Password   = 'password'; // Use the App Password generated from Google
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
                    $mail->Port       = 587; // Port for TLS/STARTTLS

                    // Sender and recipient
                    $mail->setFrom('mail addresss', 'Your Name');
                    $mail->addAddress('recipient email address', 'Recipient Name');
                    $mail->addReplyTo('mail address', 'Your Name');

                    // Data from a form (e.g., $_POST)
                    $name = $_POST['name'] ?? 'Anonymous';
                    $phone = $_POST['phone'] ?? 'Not provided';
                    $email = $_POST['email'] ?? 'Not provided';
                    $message = nl2br($_POST['message'] ?? 'No message'); // Preserve line breaks
                    $subject = $_POST['subject'] ?? 'No subject';

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = $subject;

                    // Create the message body
                    $mail->Body = "
                <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Message:</strong><br>{$message}</p>
            ";

                    // Add a plain-text alternative
                    $mail->AltBody = "
                New Contact Form Submission:
                Name: {$name}
                Phone: {$phone}
                Email: {$email}
                Message: {$message}
            ";

                    // Send email
                    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
                        throw new Exception('All fields are required: Name, Phone, Email, and Message.');
                    } else {
                        $mail->send();
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Thanks!</strong> Message has been sent successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                    }
                } catch (Exception $e) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> Contact Form Not Working Now. We will complete it soon...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                }
            }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="p-3 p-md-5 shadow" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Subject" class="form-label">Subject <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="Subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                    <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                </div>

                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-primary px-3">Send</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
