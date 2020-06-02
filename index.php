<?php

require_once 'bootstrap.php';

session_start();

use Classes\Request;
use Classes\BackendController;
use Classes\FrontendController;

if (!empty($_POST)) {
    BackendController::processRequest();
}

if (isset($_SESSION['username'])) {
    $bodyContent = FrontendController::displayPage();
} else {
    $bodyContent = FrontendController::displayLogin();
}

if (!empty($_POST)) {
    echo $bodyContent;
    die;
}

?>

<html>
<head>
    <title>Danielius Pranckevičius - Tribe Test Task</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/scripts.js'></script>
    <link rel='stylesheet' href='assets/css/styles.css'/>
</head>
<body>
    <?= $bodyContent; ?>
</body>