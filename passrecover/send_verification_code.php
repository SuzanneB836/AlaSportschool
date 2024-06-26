<?php
session_start();

// Include Composer's autoloader
require '../PHPMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$dbname = "login";
$username = "root";
$password = "";
$tableName = "users";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        $verificationCode = random_int(100000, 999999);
        $hashedVerificationCode = password_hash($verificationCode, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE $tableName SET reset_code = :reset_code WHERE email = :email");
        $stmt->bindParam(":reset_code", $hashedVerificationCode);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $mail = new PHPMailer(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'extraaeeemail@gmail.com';
            $mail->Password = 'tvxo lbba wige ausf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587; 
        
            $mail->setFrom('your_email@gmail.com', 'Flexflow');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Verification Code';
            $mail->Body = "Your verification code is: $verificationCode";
        
            $mail->send();
            header("Location: reset_password.html?email=" . urlencode($email));
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit();
        }
    } else {
        header("Location: email_not_found.html");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>