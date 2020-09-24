<?php
/**
 * functions.php - general use functions for the application
 */
session_start();

/*
 * check_login - checks the current user session for a flag, sends user to index if not found
 */
function check_login()
{
    if (!isset($_SESSION['logged_in'])) {
        header("Location:login.php");
    }
}

/*
 * get_database_connection - returns a database connection
 */
function get_database_connection($host = 'host', $dbName = 'dbname', $user = 'user', $pass = 'pass')
{
    if ($host == 'host') {
        $host = getenv("DB_HOST");
        $dbName = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $pass = getenv("DB_PASS");

    }
    $conn = new PDO("mysql:host=$host;dbName=$dbName", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

$conn = get_database_connection();

/*
 * get_queue - return entire queue as json
 */
function get_queue()
{
    global $conn;
    $sql = "SELECT * FROM handsUp.wait_queue ORDER BY queueTime";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/*
 * insert_user - inserts a user
 */
function insert_user($userName, $userLocation, $userCourse, $userHash, $userNumber)
{
    global $conn;
    $sql = "INSERT INTO handsUp.wait_queue 
                    ( uName, uLocation, uCourse, uHash, uNumber) 
                    VALUES 
                    ( :uName, :uLocation, :uCourse, :uHash, :uNumber)";

    $np = array(
        ':uName' => $userName,
        ':uLocation' => $userLocation,
        ':uCourse' => $userCourse,
        ':uHash' => $userHash,
        ':uNumber' => $userNumber);

    $stmt = $conn->prepare($sql);
    $stmt->execute($np);

    $sql = "SELECT id FROM handsUp.wait_queue where uHash = :uHash";
    $np = array(  ':uHash' => $userHash );
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/*
 * update_fields - updates 1 or more fields
 */
function update_fields($userName, $userLocation, $userCourse, $userHash, $userNumber) {
    global $conn;
        $sql = "UPDATE handsUp.wait_queue
                    SET uName = :uName,
                        uLocation = :uLocation,
                        uCourse = :uCourse,
                        uHash = :uHash,
                        uNumber = :uNumber
                    WHERE uHash = :uHash;";
        $np = array(
            ':uName' => $userName,
            ':uLocation' => $userLocation,
            ':uCourse' => $userCourse,
            ':uHash' => $userHash,
            ':uNumber' => $userNumber);

        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
}

/*
 * remove_student - removes student by id
 */
function remove_student($uID) {
    global $conn;
    $sql = "DELETE FROM handsUp.wait_queue WHERE id = :uID;";
    $np = array(
        ':uID' => $uID);

    $stmt = $conn->prepare($sql);
    $stmt->execute($np);

}
