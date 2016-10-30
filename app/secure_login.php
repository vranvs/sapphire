<?php

if(isset($_GET['error'])){
    if($_GET['error'] == 1){
        $login_error = 'Incorrect password.';
    }
    elseif($_GET['error'] == 2){
        $login_error = 'You are not logged in.';
    }
    elseif($_GET['error'] == 3){
        $login_error = 'Username does not exist.';
    }
}else{
    $login_error = '';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title></title>
    <!-- Compiled and minified CSS -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/chartist.css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Compiled and minified JavaScript -->
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/chartist.min.js"></script>

</head>
<body>
<div class="row">

</div>
<div class="row">
    <div class="col s1 m2 l3"></div>
    <div class="col s10 m8 l6 grey darken-4 z-depth-2 no-margins">
        <div class="row center-align">
            <h4 class="white-text" style="font-weight: 200;">
                Secure Login
            </h4>
        </div>
        <form action="login.php" method="post">
            <input type="text" name="PHP_AUTH_USERNAME" placeholder="Username">
            <input type="password" name="PHP_AUTH_PASSWORD" placeholder="Password">
        <div class="row right-align">
            <button class="btn waves-effect waves-light" type="submit" name="action">LOGIN
                <i class="material-icons right">lock</i>
            </button>
        </div>
        </form>
        <div class="center-align">
            <p class="red-text">
                <?php echo($login_error) ?>
            </p>
        </div>
    </div>
    <div class="col s1 m2 l3"></div>
</div>
<div class="row no-margins">
    <div class="col s1 m2 l3"></div>
    <div class="col s10 m8 l6 center-align">
        <p class="white-text fine-print">NOT COPYRIGHT 2016 SOME INTERVIEW APP</p>
    </div>
    <div class="col s1 m2 l3"></div>
</div>

</body>
</html>