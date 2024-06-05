<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

if(isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username']; 
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=login_failed");
            exit();
        }
    } else {
        echo "<script src='login.js'></script>";
        echo "</script>"; 
        echo "<script>";
        echo "showAlert();";
        echo "</script>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
