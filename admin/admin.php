<?php
include '../php/functions.php';

check_login();

if (isset($_POST["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset($_SESSION["logged_in"]);
        header("login.php");
        die("redirecting...");
    }
} elseif (isset($_POST["login"])) {
    if (isset($_POST["pw"])) {
        if ($_POST["pw"] == "test auth not for prod") {
            $_SESSION["logged_in"] = 1;
        }
    }
} elseif (isset($_GET["create"])) {
    insert_user($_GET["uName"], $_GET["uLocation"], $_GET["uCourse"], $_GET["uHash"], $_GET["uNumber"]);
} elseif (isset($_GET["read"])) {
    get_queue();
} elseif (isset($_GET["update"])) {
    // TODO database call, modify 1 or more fields of a record, found as update_fields()
    update_fields($_GET["update"], $_GET["update"], $_GET["update"], $_GET["update"], $_GET["update"]);
} elseif (isset($_GET["destroy"])) {
    remove_student($_GET["destroy"]);
}
header("/index.php");
die("reloading...");