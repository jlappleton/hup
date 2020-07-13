<?php
session_start();
include '../php/functions.php';

$username = $_POST['username'];
$password = $_POST['password'];//sha1($_POST['password']);

$sql = "SELECT * FROM handsUp.wait_queue_admin WHERE username = :username AND password = :password";

$np = array();
$np[":username"] = $username;
$np[":password"] = $password;

$stmt = $conn->prepare($sql);
$stmt->execute($np);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($record)) {
    $_SESSION['incorrect'] = true;
    header("Location:login.php");
} else {
    $_SESSION['logged_in'] = true;
    $_SESSION['adminName'] = $record['username'];
    header("Location:index.php");
}