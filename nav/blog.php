<?php

include("../db.php");

$current = 'b';

if ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('../frames/warning.php');
}

if ((isset($_GET)) && (isset($_GET['id']))) {
    $id = intval($_GET['id']);
    $q = mysqli_query($db, "SELECT * FROM `blogen` WHERE `id` = '$id'");
    $row = mysqli_fetch_array($q);
} else {
    $q = mysqli_query($db, "SELECT * FROM `blogen` ORDER BY `id` DESC LIMIT 1");
    $row = mysqli_fetch_array($q);
    $id = $row['id'];
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
<link rel="stylesheet" type="text/css" href="../css/peacock.css" id="main-color">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/side-minifier.js"></script>
<script src="../scripts/mode-change.js"></script>

<title>Knife Queer Blog</title>

</head>
<body>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="title imp-txt">Knife Queer Blog</div>
    
    <div class="story box-color">
        <div class="flex-padded">
            
            <div class="img-rowbox">
                <div class="story-details box-color">
                    <div class="subtitle imp-txt"><?php echo $row['title']; ?></div><br>
                    <b>Date Created:</b> <?php echo date('M jS, Y', strtotime($row['date'])); ?>
                </div>
                <div class="btncolor mini-side-btn" id="mode">Dark Mode</div>
            </div>
            
            <hr class="story-line line-color">
            
            <div class="story-main">
                
                <?php
            
                $filepath = '../text/'.$row['filename'].'.txt';
                
                $text = fopen($filepath, "r") or die("The specified text could not be found.");
                while (!feof($text)) {
                    echo fgets($text);
                }
                fclose($text);
                
                ?>
            </div>
            <br>
            <?php
            
                $qc = mysqli_query($db, "SELECT MAX(id) FROM `blogen` WHERE `exclude` = '0'");
                $ch = mysqli_fetch_array($qc);
                $last_ch = intval($ch['MAX(id)']);
                
                if ($last_ch !== '1') {
                    $curr_ch = intval($row['id']);
                    if ($curr_ch !== 1) {
                        $prev_id = $curr_ch - 1;
                    }
                    if ($curr_ch !== $last_ch) {
                        $next_id = $curr_ch + 1;
                    }
                }
            
                echo '<div class="img-rowbox">';
                
                if ($row['id'] == '1') {
                    echo '<div class="mini-side-btn btncolor arrow crnt" id="prev"><<</div>';
                } else {
                    echo '<a class="mini-side-btn btncolor arrow" id="prev" href="blog.php?id=', $prev_id, '"><<</a>';
                }
                
                if ($row['id'] == $last_ch) {
                    echo '<div class="mini-side-btn btncolor arrow crnt" id="next">>></div>';
                } else {
                    echo '<a class="mini-side-btn btncolor arrow" id="next" href="blog.php?id=', $next_id, '">>></a>';
                }
                
                echo '</div>';
                
                ?>
        </div>
    </div>
    
</div>
</div>
</body>
</html>