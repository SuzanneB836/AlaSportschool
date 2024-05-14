<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                            
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

    header("Location: login.html");
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>