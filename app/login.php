<?php

//error_reporting(E_ERROR | E_PARSE);

include "db_connect.php";

$username = $_POST['PHP_AUTH_USERNAME'];
$password = $_POST['PHP_AUTH_PASSWORD'];

$stmt = $db->prepare("SELECT * FROM employees WHERE username=:usr");
$stmt->bindValue(':usr', $username, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() == 1) {

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //$salt = $row['salt'];

    //$supplied_password = $salt . $password;
    //$supplied_password = sha1($supplied_password);

    if($password == $row['password']){

        session_start();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_firstname'] = $row['firstname'];
        $_SESSION['user_lastname'] = $row['lastname'];
        $_SESSION['user_fullname'] = $row['firstname'] . ' ' . $row['lastname'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_phone'] = $row['phone'];
        $_SESSION['user_group'] = $row['workgroup'];
        $_SESSION['user_avatar'] = $row['avatardir'];
        $_SESSION['date'] = date("Y-m-d");

        header('Location: app.php');
        }
    else
    {
        header('Location: secure_login.php?error=1');
    }
}
else
{
    header('Location: secure_login.php?error=3');
}





