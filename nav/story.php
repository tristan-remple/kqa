<?php

include("../db.php");

$current = NULL;

if ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('../frames/warning.php');
}

if ((isset($_GET)) && (isset($_GET['id']))) {
    $id = intval($_GET['id']);
    $q = mysqli_query($db, "SELECT * FROM `content` WHERE `id` = '$id'");
    $row = mysqli_fetch_array($q);
} else {
    $id = 0;
    $row = NULL;
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

<title>Knife Queer Art: <?php if ($row !== NULL) { echo $row['title']; } else { echo 'Missing Story'; } ?></title>

</head>
<body>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="title imp-txt"><?php if ($row !== NULL) { echo $row['title']; } else { echo 'Missing Story'; } ?></div>
    
    <div class="story box-color">
        <div class="flex-padded">
            
            <div class="img-rowbox">
                
                <?php
                
                if ($row['verse'] !== NULL) {
                    
                    $v = $row['verse'];
                    $qv = mysqli_query($db, "SELECT `name` FROM `verse` WHERE `tag` = '$v'");
                    $vr = mysqli_fetch_array($qv);
                    
                    if ($row['chara1'] !== NULL) {
                        $v_c = $v.'_charas';
                        $c1 = $row['chara1'];
                        $qc1 = mysqli_query($db, "SELECT `id`, `name` FROM `$v_c` WHERE `nick` = '$c1'");
                        $c1_row = mysqli_fetch_array($qc1);
                    }
                    
                    if ($row['chara2'] !== NULL) {
                        $v_c = $v.'_charas';
                        $c2 = $row['chara2'];
                        $qc2 = mysqli_query($db, "SELECT `id`, `name` FROM `$v_c` WHERE `nick` = '$c2'");
                        $c2_row = mysqli_fetch_array($qc2);
                    }
                    
                    if ($row['chara3'] !== NULL) {
                        $v_c = $v.'_charas';
                        $c3 = $row['chara3'];
                        $qc3 = mysqli_query($db, "SELECT `id`, `name` FROM `$v_c` WHERE `nick` = '$c3'");
                        $c3_row = mysqli_fetch_array($qc3);
                    }
                }
                
                echo '
                <div class="story-details box-color">
                    <b>Date Created:</b> ', date('M jS, Y', strtotime($row['date']));
                        if (isset($vr)) {
                            echo '<br><b>Verse:</b> <a class="link-color" href="v/', $v, '.php">', $vr['name'], '.</a>';
                            unset($vr);
                        }
                        
                        if (isset($c1_row)) {
                            echo '<br><b>Characters:</b> <a class="link-color" href="v/character.php?v=', $v, '&id=', $c1_row['id'], '">', $c1_row['name'], '.</a> ';
                            unset($c1_row);
                        }
                        
                        if (isset($c2_row)) {
                            echo '<a class="link-color" href="v/character.php?v=', $v, '&id=', $c2_row['id'], '">', $c2_row['name'], '.</a> ';
                            unset($c2_row);
                        }
                        
                        if (isset($c3_row)) {
                            echo '<a class="link-color" href="v/character.php?v=', $v, '&id=', $c3_row['id'], '">', $c3_row['name'], '.</a> ';
                            unset($c3_row);
                        }
                    echo '<br><b>Contains:</b> ', $row['warntext'], '<br>
                </div>';
                
                ?>
                
                <div class="btncolor mini-side-btn" id="mode">Dark Mode</div>
            
            </div>
            
            <hr class="story-line line-color">
            
            <div class="story-main">
            <?php
            
            $filepath = '../text/'.$row['filename'];
            
            $text = fopen($filepath, "r") or die("The specified text could not be found.");
            while (!feof($text)) {
                echo fgets($text) . "<br>";
            }
            fclose($text);
            
            ?>
            </div>
            
            <?php
            
            if ($row['storyarc'] !== NULL) {
                
                $arc = $row['storyarc'];
                
                $qc = mysqli_query($db, "SELECT MAX(chapter) FROM `content` WHERE `storyarc` = '$arc'");
                $ch = mysqli_fetch_array($qc);
                $last_ch = intval($ch['MAX(chapter)']);
                
                if ($last_ch !== '1') {
                    $curr_ch = intval($row['chapter']);
                    if ($curr_ch !== 1) {
                        $prev_ch = $curr_ch - 1;
                        $qp = mysqli_query($db, "SELECT `id` FROM `content` WHERE `storyarc` = '$arc' AND `chapter` = '$prev_ch'");
                        $rp = mysqli_fetch_array($qp);
                        $prev_id = $rp['id'];
                    }
                    if ($curr_ch !== $last_ch) {
                        $next_ch = $curr_ch + 1;
                        $qn = mysqli_query($db, "SELECT `id` FROM `content` WHERE `storyarc` = '$arc' AND `chapter` = '$next_ch'");
                        $rn = mysqli_fetch_array($qn);
                        $next_id = $rn['id'];
                    }
                }
            
                echo '<div class="img-rowbox">';
                
                if ($row['chapter'] == '1') {
                    echo '<div class="mini-side-btn btncolor arrow crnt" id="prev"><<</div>';
                } else {
                    echo '<a class="mini-side-btn btncolor arrow" id="prev" href="story.php?id=', $prev_id, '"><<</a>';
                }
                
                if ($row['chapter'] == $last_ch) {
                    echo '<div class="mini-side-btn btncolor arrow crnt" id="next">>></div>';
                } else {
                    echo '<a class="mini-side-btn btncolor arrow" id="next" href="story.php?id=', $next_id, '">>></a>';
                }
                
                echo '</div>';
            
            }
            
            ?>
            
        </div>
    </div>
    
</div>
</div>
</body>
</html>