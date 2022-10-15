<?php

include("../db.php");

$current = 'w';

if ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('../frames/warning.php');
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

<link rel="stylesheet" type="text/css" href="../css/desktop.css" media="screen and (min-width: 1000px)">
<link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width: 999px)">
<link rel="stylesheet" type="text/css" href="../css/sidebar-color.css">
<link rel="stylesheet" type="text/css" href="../css/peacock.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/side-minifier.js"></script>

<title>Knife Queer Art: Verse Selection</title>

</head>
<body>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="title imp-txt">Knife Queer Art: Verse Selection</div>
    
    <div class="home-rowbox">
        
        <?php
        
        $q = mysqli_query($db, "SELECT * FROM `verse` WHERE `include` = '1' ORDER BY `d_index`");
        
        while ($row = mysqli_fetch_array($q)) {
            
            echo '<div class="verse-thumb box-color">
                <img class="thumbnail" src="../img/', $row['logo'], '">
                <a class="story-title btncolor" href="v/verse.php?v=', $row['tag'], '">', $row['name'], '</a>',
                $row['tagline'],
            '</div>';
            
        }
        
        ?>
    
        <div class="verse-thumb box-color">
            <img class="thumbnail" src="../img/ffxiv.png">
            <a class="story-title btncolor" href="https://wol.knifequeerart.com/">Warriors of Light</a>
            A webshrine to my FFXIV characters.
        </div>
        
    </div>
    
</div>
</div>
</body>
</html>