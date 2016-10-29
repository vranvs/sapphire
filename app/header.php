<?php

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['user_group'])){
    header('secure_login.php?error=2');
}else {

    $user_id        = $_SESSION['user_id'];
    $user_name      = $_SESSION['username'];
    $user_firstname = $_SESSION['user_firstname'];
    $user_lastname  = $_SESSION['user_lastname'];
    $user_fullname  = $_SESSION['user_fullname'];
    $user_email     = $_SESSION['user_email'];
    $user_phone     = $_SESSION['user_phone'];
    $user_avatar    = $_SESSION['user_avatar'];
    $user_group     = $_SESSION['user_group'];
    $user_ldate     = $_SESSION['date'];
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

<ul id="slide-out" class="side-nav fixed">
    <li><div class="userView black">
            <a href="#!user"><img class="circle" src="<?php echo($_SESSION['user_avatar']) ?>"></a>
            <a href="#!name"><span class="white-text name"><?php echo($_SESSION['user_fullname']) ?></span></a>
            <a href="#!email"><span class="white-text email"><?php echo($_SESSION['user_email']) ?></span></a>
        </div></li>
    <li><a href="#!"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <li><a href="#!"><i class="material-icons">accessibility</i>Leads</a></li>
    <li><a href="#!"><i class="material-icons">date_range</i>Schedule</a></li>
    <li><a href="#!"><i class="material-icons">assessment</i>Estimates</a></li>
    <li><a href="#!"><i class="material-icons">work</i>Work Orders</a></li>
    <li><a href="#!"><i class="material-icons">shopping_cart</i>Material Order</a></li>
</ul>

<header>
<nav>
    <div class="nav-wrapper blue-grey darken-4">
        <div class="valign-wrapper">
            <a href="#" class="brand-logo center">Innovation</a>
        </div>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="group_manage.php?group=$user_group">Manage</a></li>
        </ul>
    </div>
</nav>
 </header>