<?php
include '../php/functions.php';

check_login();

if (isset($_POST["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset($_SESSION["logged_in"]);
        header("login.php");
        die("redirecting...");
    }

} elseif (isset($_POST["status"])) {
    global $conn;
    if ($_POST["status"] == "offline") {
        $msg = "is Not Online";
   } elseif ($_POST["status"] == "online") {
        $msg = "is Available";
    } else {
        $msg = "is taking a break";
    }
    $sql = "UPDATE handsUp.wait_queue_admin SET availability = :avail WHERE username = :aName;";
    $np = array(':avail' => $msg, ':aName' => $_SESSION["adminName"]);
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute($np);
    echo json_encode(array('message' => $msg));
    return;

} elseif (isset($_GET["create"])) {
    insert_user($_GET["uName"], $_GET["uLocation"], $_GET["uCourse"], $_GET["uHash"], $_GET["uNumber"]);

} elseif (isset($_GET["read"])) {
    get_queue();

} elseif (isset($_GET["update"])) {
    // TODO database call, modify 1 or more fields of a record, found as update_fields()
    update_fields($_GET["userName"], $_GET["userLocation"], $_GET["userCourse"], $_GET["userHas"], $_GET["userNumber"]);

} elseif (isset($_GET["destroy"])) {
    remove_student($_GET["destroy"]);

}
header("/index.php");
die("reloading...");
