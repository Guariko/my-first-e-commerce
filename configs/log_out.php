<?php

session_start();
session_unset();
session_destroy();

$homePath = "../index.php";


header("location: $homePath");
die();
