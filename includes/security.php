<?php
session_start();
include('dbconfig.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: dbconfig.php");
}

if(!$_SESSION['username'])
{
    header('Location: login.php');
}
?>