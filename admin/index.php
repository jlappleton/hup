<?php
include '../php/functions.php';
if (isset($_POST["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset($_SESSION["logged_in"]);
    }
}
check_login();
if (isset($_POST["delete"])) {
    remove_student($_POST["delete"]);
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Help Queue Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
    <script src="../js/classes.js" type="text/javascript"></script>
    <script src="../js/functions.js" type="text/javascript"></script>
</head>

<body style="text-align: center">
<div id="alert-modal" class="alert alert-dismissible alert-success">
    <button type="button" class="close" onclick="hideAlert();">&times;</button>
    <span id="alert-text"></span>
</div>
<script>hideAlert();</script>

<div id="header-container">
    <?php
    //todo get_header();
    ?>
</div>
<div id="title-container" class="container text-center">
    <h1>Help Queue Admin</h1>
</div>
<div id="status-update-container" >
    <div class="form-group" id="status-update-form">
        <label for="status-field">Current Status?</label>
        <select id="location-field" class="form-control" placeholder="isOnline" type="text" name="location">
            <option value="online">isOnline</option>
            <option value="offline">isOffline</option>
            <option value="break">break;</option>

        </select>
        <br>
        <button id="status-update-button" class="btn btn-outline-info" onclick="updateStatus();">update();
        </button>
    </div>
</div>
<div class="queue-container">
    <?php
    print("<table> <tr> <th>id</th> <th>name</th> <th>location</th> <th>course</th> <th>hash</th> <th>confirmation</th> <th><form method='post'> <input type='submit' name='logout' class='button' value='logout'/> </form></th></tr>");
    $student_queue = get_queue();
    foreach ($student_queue as &$val) {
        print("<tr>");
        foreach ($val as &$v) {
            if($v != "") {
                print("<td> {$v} </td>");
            }
        }
        //$student_row = "<td>{$val["id"]}</td> <td>{$val["uName"]}</td> <td>{$val["uLocation"]}</td> <td>{$val["uCourse"]}</td> <td>{$val["uNumber"]}</td> <td>{$val["uHash"]}</td>";
        //print($student_row);
        print("<td> <form method='post'> <input type='submit' name='delete' class='button' value='{$val['id']}' content='{$val['id']}'/> </form></td>");
        print("</tr>");
    }
    print("</table>");
    ?>
</div>
</body>
<script>
    initPage();
    setTimeout("window.location.href = window.location.href;", 30000);</script>
</html>
