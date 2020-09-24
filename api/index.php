<?php
include '../php/functions.php';
include 'auth_key.php';

if ( isset($_POST['key']) ) {
    if ( checkKey($_POST['key']) ) {
        $conn = get_database_connection();
        $return_value = null;
        $sql = null;
        $np = null;
        $fetch = false;

        if ( isset($_POST['getQueue']) ) {
            $sql = "SELECT * FROM handsUp.wait_queue ORDER BY queueTime;";
            $fetch = true;

        } elseif ( isset($_POST['getMyQueue']) ) {
            $sql = "SELECT * FROM handsUp.wait_queue WHERE lta = :me ORDER BY queueTime;";
            $np = array(':me' => $_POST['getMyQueue']);
            $fetch = true;

        } elseif ( isset($_POST['getLastNHelped']) ) {
            $sql = "SELECT * FROM handsUp.helped ORDER BY startTime LIMIT :n;";
            $np = array(':n' => $_POST['getLastNHelped']);
            $fetch = true;

        } elseif ( isset($_POST['dequeueStudent']) ) {
            $sql = "DELETE FROM handsUp.wait_queue WHERE id = :uID;";
            $np = array(':uID' => $_POST['dequeueStudent']);

        } elseif ( isset($_POST['tagStudent']) ) {
            $sql = "UPDATE handsUp.wait_queue SET lta = :lta WHERE id = :sId;";
            $np = array(':sId' => $_POST['tagStudent'], ':lta' => $_POST['lta']);

        } elseif ( isset($_POST['untagStudent']) ) {
            $sql = "UPDATE handsUp.wait_queue SET lta = NULL WHERE id = :sId;";
            $np = array(':sId' => $_POST['untagStudent']);

        } elseif ( isset($_POST['updateMyStatus']) ) {
            $sql = "UPDATE handsUp.wait_queue_admin SET cardColor = :color, cardMsg = :msg WHERE id = :mId;";
            $np = array(':color' => $_POST['color'], ':msg' => $_POST['msg'], ':mId' => $_POST['updateMyStatus']);

        }
        if ($sql) {
            $stmt = $conn->prepare($sql);
            if ($np) {
                $stmt->execute($np);
            } else {
                $stmt->execute();
            }
            if ($fetch) {
                $return_value = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $return_value;
    }
}
