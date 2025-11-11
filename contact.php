<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php'; // Dotenv & PHPMailer (via Composer)

// Load .env from same directory
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Include PHPMailer classes
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

$errName = $errEmail = $errMessage = $errHuman = $result = '';




if (isset($_POST["submit"])) {
    $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $lastName  = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $fullName  = trim("$firstName $lastName");
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject   = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message   = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $honeypot  = $_POST['website'] ?? '';

    $from      = "$fullName <$email>";
    $to        = $_ENV['MAIL_TO']; // pulled from .env
    
    $body = "From: $fullName\n E-Mail: $email\n Message:\n $message";


    // Validation
   if (!$fullName) {
    $errName = 'Please enter your name';
     
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Please enter a valid email address';
    }
    if (!$message) {
        $errMessage = 'Please enter your message';
    }
    if (!empty($honeypot)) {
        $errHuman = 'Bot detected.';
    }

    // If no errors, send mail
    if (!$errName && !$errEmail && !$errMessage && empty($honeypot)){
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USERNAME'];    // FROM .env
            $mail->Password   = $_ENV['MAIL_PASSWORD'];    // FROM .env
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;   // FROM .env

            
            $mail->setFrom($email, $fullName);
            $mail->addReplyTo($email, $fullName);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                              <!DOCTYPE html>
                              <html>
                              <head>
                                <style>
                                  body {
                                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                    background-color: #f0f2f5;
                                    padding: 20px;
                                    color: #333;
                                  }

                                  .container {
                                    background-color: #ffffff;
                                    border-radius: 10px;
                                    padding: 30px;
                                    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
                                    max-width: 640px;
                                    margin: 0 auto;
                                  }

                                  h2 {
                                    color: #2c3e50;
                                    text-align: center;
                                    margin-bottom: 30px;
                                  }

                                  .frame {
                                    border-radius: 8px;
                                    padding: 20px;
                                    margin-bottom: 25px;
                                    box-shadow: 0 1px 5px rgba(0,0,0,0.05);
                                  }

                                  .label {
                                    font-size: 16px;
                                    font-weight: bold;
                                    margin-bottom: 10px;
                                  }

                                  .value {
                                    font-size: 16px;
                                    padding: 10px;
                                    border-radius: 5px;
                                  }

                                  .name-frame { background-color: #e6f4ea; border-left: 5px solid #28a745; }
                                  .email-frame { background-color: #eaf4fc; border-left: 5px solid #007bff; }
                                  .message-frame { background-color: #fff3cd; border-left: 5px solid #ffc107; }
                                </style>
                              </head>
                              <body>
                                <div class='container'>
                                  <h2>New Contact Form Submission</h2>

                                  <div class='frame name-frame'>
                                    <div class='label'>Name</div>
                                    <div class='value'>" . htmlspecialchars($fullName) . "</div>
                                  </div>

                                  <div class='frame email-frame'>
                                    <div class='label'>Email</div>
                                    <div class='value'>" . htmlspecialchars($email) . "</div>
                                  </div>


                                  <div class='frame message-frame'>
                                    <div class='label'>Message</div>
                                    <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
                                  </div>
                                </div>
                              </body>
                              </html>";
            $mail->send();
            $result = "Thank you! Your message has been sent successfully.";
            $_POST = [];
        
        } catch (Exception $e) {
            $result = "<div class='alert alert-danger'>Mailer Error: {$mail->ErrorInfo}</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="contact ">
  <meta name="author" content="BootstrapBay.com">

  <title>Get Intouch - SpringTech </title>
  <link rel="icon" type="image/png" href="images/favcon.png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

  <!-- Bootstrap CSS -->

  <!-- Site CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Colors CSS -->
  <link rel="stylesheet" href="css/colors.css">
  <!-- ALL VERSION CSS -->
  <link rel="stylesheet" href="css/versions.css">
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/contact.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


  <!-- Bootstrap JS (for mobile collapse) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




  <!-- Include Font Awesome if not already included -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Only one <header> tag -->
  <header class="site-header sticky-header">
    <!-- Top contact bar -->

    <div class="container contact-topbar-inner">
      <div class="contact-info">
        <a href="mailto:mullerncybernet@gmail.com"><i class="fa fa-envelope"></i> <span class="label">info@springtech.com</span></a>
        <a href="tel:+254791538749"><i class="fa fa-phone"></i> <span class="label">+254 91538749</span></a>
        <a href="https://wa.me/254791538749?text=Hello%20I%20need%20a%20services" target="_blank">
          <img src="images/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
          <span class="label">WhatsApp</span>
        </a>
      </div>

    </div>


    <!-- Main header nav -->
    <!-- Navigation Wrapper -->

    </div>

  </header>



</head>

<body>

  <div class="nav-wrapper">
    <button class="menu-toggle" id="menuToggle"><i class="fa fa-bars"></i></button>

    <nav class="nav-menu" id="mainMenu">
      <a href="index.php" class="nav-btn">Home</a>
      <a href="services/services.php" class="nav-btn">Services</a>
      <a href="pricing.php" class="nav-btn">Pricing</a>
      <a href="about.php" class="nav-btn">About</a>

    </nav>

  </div>
  <div class="container">
    <h1 class="page-header text-center">Get Intouch</h1>

    <div class="row">
      <div class="col-md-6 col-md-offset-3 form-wrapper">


        <form id="contactForm" class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


          <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" placeholder="First name" required value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last name" required value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
            <?php echo "<p class='text-danger'>$errEmail</p>";?>
          </div>


          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="Subject of your message" required value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
            <?php if (!empty($errMessage)) echo "<p class='text-danger'>$errMessage</p>"; ?>
          </div>

          <div style="display:none;">
            <input type="text" name="website" autocomplete="off">
          </div>
          <div class="form-group">
            <label id="mathQuestion" for="human">Captcha:</label>
            <input type="number" class="form-control" name="human" id="human" placeholder="Your Captcha Answer" required>
            <input type="hidden" id="correctAnswer">
          </div>

      </div>



    </div>
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
      </div>
    </div>



    </form>
  </div>
  </div>







  </div>


  <div id="support" class="section db">





    >

    <footer class="site-footer">


      <div class="footer-container">
        <div class="footer-logo">
          <img src="images/logos/logo-light.png" alt="FlaxSoft Logo">
        </div>
        <div class="footer-info">
          <p>&copy; <?php echo date("Y"); ?> SpringTech Solutions. All rights reserved.</p>
          <div class="footer-links">
            <a href="index.php">Home</a> |
            <a href="services/services.php">Services</a> |
            <a href="contact.php">Contact</a> |
            <a href="privacy/privacy.php">Privacy Policy</a>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script>
      const menuToggle = document.getElementById("menuToggle");
      const mainMenu = document.getElementById("mainMenu");

      // Toggle menu visibility
      menuToggle.addEventListener("click", function(e) {
        e.stopPropagation(); // Prevent the outside click from triggering
        const isOpen = mainMenu.classList.toggle("show");

        // Hide or show the toggle button itself
        menuToggle.style.display = isOpen ? "none" : "block";
      });

      // Close menu if clicking outside
      document.addEventListener("click", function(e) {
        const isClickInsideMenu = mainMenu.contains(e.target);
        const isClickOnToggle = menuToggle.contains(e.target);

        if (!isClickInsideMenu && !isClickOnToggle) {
          if (mainMenu.classList.contains("show")) {
            mainMenu.classList.remove("show");
            menuToggle.style.display = "block"; // Re-show the toggle button
          }
        }
      });



      // Close menu when clicking any link inside it
      mainMenu.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
          mainMenu.classList.remove("show");
          menuToggle.style.display = "block";
        });
      });

      // Hide the confirmation message after 5 seconds
      setTimeout(function() {
        const msg = document.getElementById('confirmation-msg');
        if (msg) msg.style.display = 'none';
      }, 5000);

      //Captcha
      document.addEventListener("DOMContentLoaded", function() {
        // Generate a simple math question
        const a = Math.floor(Math.random() * 10) + 1;
        const b = Math.floor(Math.random() * 10) + 1;
        const correctAnswer = a + b;

        // Show the question
        document.getElementById("mathQuestion").innerText = `What is ${a} + ${b}?`;
        document.getElementById("correctAnswer").value = correctAnswer;

        // Add validation before form submits
        const form = document.querySelector("form");
        form.addEventListener("submit", function(e) {
          const userAnswer = parseInt(document.getElementById("human").value, 10);
          const expectedAnswer = parseInt(document.getElementById("correctAnswer").value, 10);

          if (userAnswer !== expectedAnswer) {
            e.preventDefault();
            Swal.fire({
              icon: "error",
              title: "Oops!",
              text: "Incorrect answer to the CAPTCHA. Please try again.",
            });

            document.getElementById("human").focus();
          }
        });
      });
    </script>


<?php if (!empty($result)): ?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    window.scrollTo({ top: 0, behavior: "smooth" });//scrolls to top

    Swal.fire({
      title: "Message Sent!",
      text: "<?= addslashes($result); ?>",
      icon: "success",
      confirmButtonText: "OK",
      confirmButtonColor: "#007bff"
    }).then(() => {
      // Clear the form
      const form = document.getElementById("contactForm");
      if (form) form.reset();
    });
  });
</script>
<?php endif; ?>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
      // Skip showing if CAPTCHA is incorrect (already handled)
      const userAnswer = parseInt(document.getElementById("human").value, 10);
      const expectedAnswer = parseInt(document.getElementById("correctAnswer").value, 10);
      if (userAnswer !== expectedAnswer) return;

      // Show "Sending..." popup
      Swal.fire({
        title: "Sending...",
        text: "Please wait while we send your message.",
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    });
  });
</script>


</body>

</html>
