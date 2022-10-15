<?php

include("../db.php");

$current = 'l';

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

<title>Knife Queer Story Library</title>

</head>
<body>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="hb">
        <div class="title imp-txt">Knife Queer Story Library</div>
    </div>
    
    <div class="nav-rowbox navbox-color">
        <a class="nav-btn btncolor" href="#sfw">General Stories</a>
        <a class="nav-btn btncolor" href="#nsfw">Mature Stories</a>
        <a class="nav-btn btncolor" href="unreality.php">Unreality Agents</a>
    </div>
    
    <div class="verti" id="sfw">
        
        <div class="subtitle imp-txt">General Stories</div>
        
        <div class="story-box">
            
            <?php
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE `explicit` = '0' AND `spoiler` = '0' AND `exclude` = '0' ORDER BY `date` DESC");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $v = $row['verse'];
                $qv = mysqli_query($db, "SELECT `name` FROM `verse` WHERE `tag` = '$v'");
                $vr = mysqli_fetch_array($qv);
                
            if ($row['storyarc'] == NULL) {
                
                echo '<div class="story-preview box-color">
                    <div class="flex-padded">
                        <a class="story-title btncolor" href="story.php?id=', $row['id'],'">', $row['title'], '</a>
                        <div class="quote">❝ ', $row['tagline'], ' ❞</div>',
                        $row['mdesc'],
                        '<br><br>
                        <div class="small">Date Created: ', date('M jS, Y', strtotime($row['date'])),
                        '  |  Verse: <a class="link-color" href="v/', $v, '.php">', $vr['name'], '</a>';
                        if ($row['warntext'] !== NULL) { echo '  |  Contains: ', $row['warntext']; }
                        echo '</div>
                    </div>
                </div>';
            
            } elseif ($row['chapter'] == '1') {
                
                $arc = $row['storyarc'];
                $qc = mysqli_query($db, "SELECT `warntext` FROM `content` WHERE `storyarc` = '$arc'");
                $warntext = [];
                while ($rw = mysqli_fetch_array($qc)) {
                    if (($rw['warntext'] !== NULL) && (str_contains($rw['warntext'], ', '))) {
                        $ch_warn = explode(', ', $rw['warntext']);
                        foreach ($ch_warn as $item) {
                            array_push($warntext, $item);
                        }
                    } elseif ($rw['warntext'] !== NULL) {
                        array_push($warntext, $rw['warntext']);
                    }
                }
                
                $warntext = array_unique($warntext);
                $last = end($warntext);
                
                echo '<div class="story-preview box-color">
                    <div class="flex-padded">
                        <a class="story-title btncolor" href="story.php?id=', $row['id'],'">', $row['storyarc'], ': Chapter 1 - ', $row['title'], '</a>
                        <div class="quote">❝ ', $row['tagline'], ' ❞</div>',
                        $row['mdesc'],
                        '<br><br>
                        <div class="small">Date Created: ', date('M jS, Y', strtotime($row['date'])),
                        '  |  Verse: <a class="link-color" href="v/', $v, '.php">', $vr['name'], '</a>';
                        if ($warntext !== NULL) {
                            echo '  |  Contains: ';
                            foreach ($warntext as $item) {
                                echo $item;
                                if ($item !== $last) {
                                    echo ', ';
                                }
                            }
                        }
                        echo '</div>
                    </div>
                </div>';
            }
            
            }
            
            ?>
            
        </div>
        
    </div>
    
    <div class="verti" id="nsfw">
        
        <div class="subtitle imp-txt">Mature Stories</div>
        
        <div class="story-box">
            
            <?php
            
            $q = mysqli_query($db, "SELECT * FROM `content` WHERE `explicit` = '1' AND `spoiler` = '0' AND `exclude` = '0' ORDER BY `date` DESC");
            
            while ($row = mysqli_fetch_array($q)) {
                
                $v = $row['verse'];
                $qv = mysqli_query($db, "SELECT `name` FROM `verse` WHERE `tag` = '$v'");
                $vr = mysqli_fetch_array($qv);
                
            if ($row['storyarc'] == NULL) {
                
                echo '<div class="story-preview box-color">
                    <div class="flex-padded">
                        <a class="story-title btncolor" href="story.php?id=', $row['id'],'">', $row['title'], '</a>
                        <div class="quote">❝ ', $row['tagline'], ' ❞</div>',
                        $row['mdesc'],
                        '<br><br>
                        <div class="small">Date Created: ', date('M jS, Y', strtotime($row['date'])),
                        '  |  Verse: <a class="link-color" href="v/', $v, '.php">', $vr['name'], '</a>';
                        if ($row['warntext'] !== NULL) { echo '  |  Contains: ', $row['warntext']; }
                        echo '</div>
                    </div>
                </div>';
            
            } elseif ($row['chapter'] == '1') {
                
                $arc = $row['storyarc'];
                $qc = mysqli_query($db, "SELECT `warntext` FROM `content` WHERE `storyarc` = '$arc'");
                $warntext = [];
                while ($rw = mysqli_fetch_array($qc)) {
                    if (str_contains($rw['warntext'], ', ')) {
                        $ch_warn = explode(', ', $rw['warntext']);
                        foreach ($ch_warn as $item) {
                            array_push($warntext, $item);
                        }
                    } elseif ($rw['warntext'] !== NULL) {
                        array_push($warntext, $rw['warntext']);
                    }
                }
                
                $warntext = array_unique($warntext);
                $last = end($warntext);
                
                echo '<div class="story-preview box-color">
                    <div class="flex-padded">
                        <a class="story-title btncolor" href="story.php?id=', $row['id'],'">', $row['storyarc'], ': Chapter 1 - ', $row['title'], '</a>
                        <div class="quote">❝ ', $row['tagline'], ' ❞</div>',
                        $row['mdesc'],
                        '<br><br>
                        <div class="small">Date Created: ', date('M jS, Y', strtotime($row['date'])),
                        '  |  Verse: <a class="link-color" href="v/', $v, '.php">', $vr['name'], '</a>';
                        if ($warntext !== NULL) {
                            echo '  |  Contains: ';
                            foreach ($warntext as $item) {
                                echo $item;
                                if ($item !== $last) {
                                    echo ', ';
                                }
                            }
                        }
                        echo '</div>
                    </div>
                </div>';
            }
            
            }
            
            ?>
            
        </div>
        
    </div>
    
</div>

</div>
</body>
</html>