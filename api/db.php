<?php
$conn = new mysqli("localhost","root","","gearguard",3307);
if($conn->connect_error) die("DB Error");
session_start();
?>

