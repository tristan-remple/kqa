<?php

session_start();

$current = NULL;

if ((isset($_POST['consent'])) && ($_POST['consent'] == 'yes')) {
    $_SESSION['consent'] = 'yes';
} elseif ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('frames/root-warning.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap">

<link rel="stylesheet" type="text/css" href="css/desktop.css" media="screen and (min-width: 1000px)">
<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width: 999px)">
<link rel="stylesheet" type="text/css" href="css/sidebar-color.css">
<link rel="stylesheet" type="text/css" href="css/peacock.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts/side-minifier.js"></script>

<title>Knife Queer Art: Homepage</title>

</head>
<body>
    
<div class="gradient"></div>

<div class="verti home-align">

<div class="title imp-txt">Knife Queer Art: Homepage</div>

<div class="home-rowbox">
    
    <a class="home-btn btncolor" href="nav/gallery.php">Gallery</a>
    <a class="home-btn btncolor" href="nav/library.php">Library</a>
    <a class="home-btn btncolor" href="nav/verse-select.php">Wiki</a>
    <a class="home-btn btncolor" href="nav/blog.php">Blog</a>
    <a class="home-btn btncolor" href="https://knifequeer.itch.io/">Shop</a>
    <a class="home-btn btncolor" href="nav/comm-nav.php">Commissions</a>
    <a class="home-btn btncolor" href="nav/about.php">About Me</a>
    <a class="home-btn btncolor" href="nav/friends.php">Friends</a>
    
</div>
</div>
</body>
</html>