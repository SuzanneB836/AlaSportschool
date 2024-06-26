<?php
session_start();

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
    $reset_token = $_POST["reset_token"];
    $new_password = $_POST["new_password"];

    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($reset_token, $user['reset_code'])) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE $tableName SET password = :hashed_password, reset_code = NULL WHERE email = :email");
        $update_stmt->bindParam(":hashed_password", $hashed_password);
        $update_stmt->bindParam(":email", $email);
        $update_stmt->execute();

        header("Location: index.php");
        exit();
    } else {
        header("Location: reset_password.html?error=invalid_reset_token");
        exit();
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
    exit();
}
?>