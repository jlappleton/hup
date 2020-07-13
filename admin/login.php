<?php
include '../php/functions.php';
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Help Queue Admin Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
    <script src="../js/classes.js" type="text/javascript"></script>
    <script src="../js/functions.js" type="text/javascript"></script>
</head>

<body style="text-align: center">
<div class="container">
    <form class="form-signin" method="POST" action="auth.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username: </label> <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Username"/> <br />
        <label for="inputPassword" class="sr-only">Password: </label> <input class="form-control" id="inputPassword" type="password" name="password" placeholder="password"/> <br />

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br /><br />
        <?php
        if (isset($_SESSION['incorrect'])) {
            echo "<p class='lead' id='error' style='color:red'>";
            echo "<strong>Incorrect Username or Password</strong></p>";
        }
        ?>
    </form>
</div>
<span></span>
</body>
</html>