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

<div id="header-container" style="float: right">
    <button type="button" class="login" onclick="location.href = 'admin/login.php'">LTA Login</button>
    <?php
    //todo get_header();
    ?>
</div>

<div class="container">

    <div class="lta" style="width: 100px; margin-left: 95px; margin-top: 10px">
        <div class="card border-primary" id="jamesCard" style="margin-top: 12px">
            <img src="img/james.jpg" alt="" class="card-img-top" alt="James' avatar, him on a surfboard whith the same reflected in the smooth water">
            <div class="card-body">
                <h6 class="card-title"> James </h6>
                <h6 class="panel-title" id="james"> </h6>
            </div>
        </div>
        <div class="card border-primary" id="josephCard">
            <img src="img/joseph.jpg" alt="" class="card-img-top j" alt="Joseph's avatar, a beard and hair with no face on a striped background">
            <div class="card-body">
                <h6 class="card-title"> Joseph </h6>
                <h6 class="panel-title" id="joseph"> </h6>
            </div>
        </div>

    </div>

    <div class="jumbotron">
    <div class="enqueue-dequeue">
    <div id="title-container" class="container text-center">
        <h1>Help Queue</h1>
        <h5 id="subtitle-container" class="text-success">Enter your information and submit for assistance</h5>
    </div>
    <div class="enqueue-container" id="enqueue-container">
        <!--        <h4 class="text-center">Enqueue Here</h4>-->
        <div class="form-group" id="queue-form">
            <label for="name-field">Pipeline Username</label><input id="name-field" class="form-control" placeholder="Name" type="text"
                                                                    name="name">
            <label for="location-field">How are we getting together?</label><select id="location-field" class="form-control" placeholder="Location"
                                                                                    type="text" name="location">
                <option value="slack">Slack</option>
                <option value="hangouts">Hangouts</option>
                <option value="email">Email</option>

            </select>
            <label for="course-field">What course?</label><input id="course-field" class="form-control" placeholder="Course"
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
            <p></p>
            <p><b>Do not refresh or navigate away from this page.</b></p>
            <p>If you do don't worry as your place in the queue will be saved</p>
            <p>If you no longer need help, please dequeue yourself by pressing the button below</p>
        </div>
        <div class="form-group">
            <button id="dequeue-button" class="btn btn-outline-danger" onclick="dequeueAjax()">dequeue();
            </button>
        </div>
    </div>
    <!--<script>hideDequeue();</script>-->
</div>
</div>

</div>
<div class="queue">

</div>

<div class="queue-container">
    <?php
    ?>
</div>
</body>
<footer>
    <div id="slack"> Meet us on <a href="https://sbcccs.slack.com" target="_blank">Slack</a>, or click here to <a href="https://join.slack.com/t/sbcccs/shared_invite/zt-dm3lgrg5-ydcp52lpyR4oCorRZEHx6Q" target="_blank">Join if you have not already done so.</a> </div>
    <div id="hangouts">Reach out on <a href="https://hangouts.google.com" target="_blank">Hangouts</a> to James: jhhoward  or  Joseph: jlappleton2</div>
    <div id="appointments"><a href="https://mail.google.com" target="_blank">Pipeline Email</a>: James: jhhoward  or  Joseph: jlappleton2  *** @pipeline.sbcc.edu</div>
    <div id="csdept"><a href="https://cs.sbcc.edu" target="_blank">C.S. Department Website</a></div>
    <div id="tutoring">S.B.C.C. Tutoring Resources Link Coming Soon</div>
</footer>
<script>
    initPage();
    ltaStatusCheck();
    setInterval(ltaStatusCheck, 60000);
</script>
</html>
