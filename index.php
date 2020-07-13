<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Help Queue</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <script src="js/classes.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>
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
    <h1>Help Queue</h1>
    <h5 id="subtitle-container" class="text-success">Enter your information and submit for assistance</h5>
</div>
<div class="enqueue-dequeue">
    <div class="enqueue-container" id="enqueue-container">
        <!--        <h4 class="text-center">Enqueue Here</h4>-->
        <div class="form-group" id="queue-form">
            <label for="name-field">Name or pipeline</label><input id="name-field" class="form-control" placeholder="Name" type="text"
                                                   name="name">
            <label for="location-field">How are we getting together?</label><select id="location-field" class="form-control" placeholder="Location"
                                                       type="text" name="location">
                <option value="slack">Slack</option>
                <option value="email">Email</option>
                <option value="hangouts">Hangouts</option>
            </select>
            <label for="course-field">What course and assignment?</label><input id="course-field" class="form-control" placeholder="Course"
                                                     type="text" name="course">
            <br>
            <button id="enqueue-button" class="btn btn-outline-primary" onclick="enqueueAjax();">enqueue();
            </button>
        </div>
    </div>
    <div class="dequeue-container" id="dequeue-container">
        <span id="user-number">#7: A123</span>
        <div class="form-group">
            <button id="dequeue-button" class="btn btn-outline-danger" onclick="dequeueAjax()">dequeue();
            </button>
        </div>
    </div>
    <script>hideDequeue();</script>
</div>

<div class="queue">

</div>

<div class="queue-container">
    <?php
    ?>
</div>
</body>
<script>initPage();</script>
</html>
