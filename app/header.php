<?php

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['user_group'])){
    header('Location: secure_login.php?error=2');
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

    if($user_group == 999){
        //Admin logged in
        $admin_btn = '<li><a href="administration.php">Administration</a></li>';
        $stats_btn = '<li><a href="analytics.php">Analytics</a></li>';
    }else{
        $admin_btn = '';
        $stats_btn = '';
    }
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
    <link type="text/css" rel="stylesheet" href="css/weather-icons.min.css"/>
    <link rel="stylesheet" href="css/custom.css">

    <!-- Compiled and minified JavaScript -->
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/main.js"></script>

</head>
<body>

<ul id="slide-out" class="side-nav fixed">
    <li><div class="userView black">
            <a href="#!user"><img class="circle" src="<?php echo($_SESSION['user_avatar']) ?>"></a>
            <a href="#!name"><span class="white-text name"><?php echo($_SESSION['user_fullname']) ?></span></a>
            <a href="#!email"><span class="white-text email"><?php echo($_SESSION['user_email']) ?></span></a>
        </div></li>
    <!-- MAIN LINK BLOCK -->
    <li><a href="#!" class="side-nav-button" data-page="0"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <li><a href="#!" class="side-nav-button" data-page="1"><i class="material-icons">accessibility</i>Leads</a></li>
    <li><a href="#!" class="side-nav-button" data-page="2"><i class="material-icons">date_range</i>Schedule</a></li>
    <li><a href="#!" class="side-nav-button" data-page="3"><i class="material-icons">assessment</i>Estimate Calculator</a></li>
    <li><a href="#!" class="side-nav-button" data-page="4"><i class="material-icons">work</i>Work Orders</a></li>
    <li><a href="#!" class="side-nav-button" data-page="5"><i class="material-icons">shopping_cart</i>Material Orders</a></li>
    <!-- SEPARATOR BLOCK -->
    <li><div class="divider"></div></li>
    <li><a class="subheader"><?php echo($user_firstname . '\'s Account') ?></a></li>
    <!-- SECONDARY LINK BLOCK -->
    <li><a href="#!"><i class="material-icons">settings</i>Account Settings</a></li>
    <li><a href="logout.php"><i class="material-icons">close</i>Logout</a></li>
</ul>

<header>
<nav>
    <div class="nav-wrapper blue-grey darken-2">
        <div class="valign-wrapper">
            <a id="app_page_title" href="#" class="brand-logo center" style="font-weight: 200;">Dashboard</a>
        </div>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php echo($admin_btn) ?>
            <?php echo($stats_btn) ?>
        </ul>
    </div>
</nav>
 </header>