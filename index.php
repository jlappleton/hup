<?php
session_start();
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <button type="button" class="login" onclick="location.href = 'admin/login.php'">LTA Login</button>
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
            <label for="name-field">Pipeline Username</label><input id="name-field" class="form-control" placeholder="Name" type="text"
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
    <div class="dequeue-container" id="dequeue-container" style="visibility: hidden">
        <p>Confirmation number: <span id="user-number"></span></p>
        <div id="contact-method-link"><p></p></div>
    <div id="wait_instructions">
        <p>Do not refresh or navigate away from this page, if you do don't worry as your place in the queue will be saved</p>
        <p>If you no longer need help, please dequeue yourself by pressing the button below</p>
    </div>
        <div class="form-group">
            <button id="dequeue-button" class="btn btn-outline-danger" onclick="dequeueAjax()">dequeue();
            </button>
        </div>
    </div>
    <!--<script>hideDequeue();</script>-->
</div>

<div class="queue">

</div>

<div class="queue-container">
    <?php
    ?>
</div>
</body>
<footer>
    <div id="slack"> Meet us on <a href="https://sbcccs.slack.com">Slack</a>, or click here to <a href="https://join.slack.com/t/sbcccs/shared_invite/zt-dm3lgrg5-ydcp52lpyR4oCorRZEHx6Q">Join</a> </div>
    <div id="hangouts">Or <a href="https://hangouts.google.com/group/FFSw1A2XNVt3rUyH9">Hangouts</a> </div>
    <div id="appointments">Or make an appointment with <a href="https://calendar.google.com/calendar/selfsched?sstoken=UVBxM3hnekhMaE53fGRlZmF1bHR8OTU2Mjc4ZmZiZjMwZTI4OWFiNGJjMzUxYzVjNmMwYmI">James</a> or <a href="https://www.google.com/url?q=https://calendar.google.com/calendar/selfsched?sstoken%3DUUN1TUROTFVMNTByfGRlZmF1bHR8ZGNlMDUwZmUzNDc2NmQ2OTEzOTllYzJkZGM0MzI0OTY&sa=D&source=hangouts&ust=1584405482147000&usg=AFQjCNEInE8Sj8fkwNnlsyNNTJ_Be8Zajw">Joseph</a> </div>
    <div id="csdept"><a href="https://cs.sbcc.edu">CS Dept Website</a></div>
    <div id="tutoring"><a href="https://docs.google.com/document/d/1EdbQUj3rnSRoHvtuoXPKk-1zuZKmfemJcqqoch0eIFc/edit">Tutoring Resources</a> </div>
</footer>
<script>initPage();</script>
</html>
