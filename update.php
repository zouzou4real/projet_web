<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "user_management";

$connect = mysqli_connect($host, $user, $password, $db);

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $new_phone = $_POST['phone'];
    $new_age = $_POST['age'];


    $sql = "
        UPDATE users 
        SET 
            username = '$new_username', 
            password = '$new_password', 
            phone = '$new_phone', 
            age = '$new_age' 
        WHERE id = '$id'
    ";

    if ($connect->query($sql) === TRUE) {
        header("Location: Listofadmins.php");
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($connect) . "'); window.history.back();</script>";
    }
}

mysqli_close($connect);
?>