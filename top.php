<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Top 5 Ski Resorts in Vermont</title>
    <meta name="author" content="Shamus Murphy, Miles Goldsmith, Tyler Sheehan">
    <meta name="description" content="A description of the top 5 ski resorts in Vermont!">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
    <link rel="stylesheet" href="css/layout-desktop.css?version=<?php print time(); ?>" type="text/css">
    <link rel="stylesheet" href="css/layout-tablet.css?version=<?php print time(); ?>" type="text/css" media="(max-width: 820px)">
    <link rel="stylesheet" href="css/layout-phone.css?version=<?php print time(); ?>" type="text/css" media="(max-width: 430px)">
</head>
<?php

print '<body class="' . $pathParts['filename'] . '">';

include 'database-connect.php';
include "header.php";
include "nav.php";
?>