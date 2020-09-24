<?php
include 'functions.php';

$conn = get_database_connection();

if (isset($_POST["dequeue"])) {
    remove_student($_POST["dequeue"]);
    unset($_SESSION["id"]);
    unset( $_SESSION["uHash"]);
} elseif (isset($_GET["enqueue"])) {
    $user_hash = sha1($_GET["name"] . $_GET["course"] . $_GET["location"] . microtime());
    $_SESSION["uHash"] = $user_hash;
    $help_number = substr($user_hash, 4, 3);
    $uID = insert_user($_GET['name'], $_GET["location"], $_GET["course"], $user_hash, $help_number);
    $_SESSION['id'] = $uID['id'];
    echo json_encode(array("uID" => $uID['id'], "uNumber" => $help_number));
} elseif (isset($_POST["statusCheck"])) {
    global $conn;
    $avail = array();
    $sql = "SELECT availability FROM handsUp.wait_queue_admin WHERE name = 'james';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avail['james'] = $stmt->fetch(PDO::FETCH_ASSOC)['availability'];
    $sql = "SELECT availability FROM handsUp.wait_queue_admin WHERE name = 'joseph';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $avail['joseph'] = $stmt->fetch(PDO::FETCH_ASSOC)['availability'];
    echo json_encode($avail);
}
