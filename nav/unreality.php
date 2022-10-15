<?php

include("../db.php");

$current = 'ua';

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
<script src="../scripts/lightbox.js"></script>

<title>Unreality Agents</title>

</head>
<body>

<div class="lightbox lb-color hidden">
    <img class="full-img" src="../img/kqa-logo-small.png">
    <div class="img-text box-color">This is my logo.</div>
    <div class="close btncolor" tabindex="0">X</div>
</div>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="hb">
        <div class="title imp-txt">Unreality Agents</div>
    </div>
    
    <div class="nav-rowbox navbox-color">
        <a class="nav-btn btncolor" href="#1">1: Prologue</a>
        <a class="nav-btn btncolor" href="#2">2: The Hunt</a>
        <a class="nav-btn btncolor" href="#3">3: Captivity</a>
        <a class="nav-btn btncolor" href="#4">4: The Escape</a>
        <a class="nav-btn btncolor" href="#5">5: War Games</a>
        <a class="nav-btn btncolor" href="#6">6: Breaking Point</a>
        <a class="nav-btn btncolor" href="#7">7: Epilogue</a>
        <a class="nav-btn btncolor" href="#0">Aesthetics</a>
    </div>
    
    <div class="verti" id="1">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">1: Prologue</div>
                It wouldn't be right to say everything was alright, in the beginning.<br>
                But compared to the days ahead, it was the calm before the storm.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '1'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '1'
                              ");
            
            include('../scripts/ua-gal.php');
                        
                        
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="2">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">2: The Hunt</div>
                What does it mean to be hunted? To be chased down, to fear for your life?
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '2'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '2'
                              ");
            
            include('../scripts/ua-gal.php');
                        
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="3">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">3: Captivity</div>
                Another unfamiliar ceiling.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '3'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '3'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="4">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">4: The Escape</div>
                Disrupting the natural order.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '4'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '4'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="5">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">5: War Games</div>
                The games we play with human lives, like cat and mouse.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '5'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '5'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="6">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">6: Breaking Point</div>
                At long last, we are destroyed.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '6'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '6'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="7">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">7: Epilogue</div>
                When the dust settles, everything is new to us.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '7'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '7'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="0">
        
        <div class="text box-color">
            <div class="padded">
                <div class="subtitle">Aesthetics</div>
                Bits and pieces, belonging neither here nor there.
            </div>
        </div>
        
        <div class="home-rowbox">
            
            <?php
            
            $array = [];
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '0'
                              ");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $current = '<div class="story-thumb box-color">
                <div class="flex-padded">
                    <a class="story-title btncolor" href="story.php?id='.$row['id'].'">'.$row['title'].'</a>'.
                    $row['mdesc'].
                    '<div class="small">Contains: '.$row['warntext'].'</div>
                </div>
            </div>';
            
            $array += [$row['date'] => $current];
            
            }
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE
                              `verse` = 'ua' AND 
                              `exclude` = '0' AND
                              `arc` = '0'
                              ");
            
            include('../scripts/ua-gal.php');
            
            krsort($array);
            
            foreach ($array as $value) {
                echo $value;
            }
            
            ?>
            
        </div>
        
    </div>
    
</div>
</div>
</body>
</html>