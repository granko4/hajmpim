<?php

$host="localhost";
$perdoruesit="root";
$password="";
$vt="userat";


$lidhja = mysqli_connect($host, $perdoruesit, $password, $vt);
mysqli_set_charset($lidhja,"UTF8");

if (!$lidhja) {
    die("Connection failed: " . mysqli_connect_error());
}
?>                      