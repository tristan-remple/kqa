<?php

include("../db.php");

$current = 'g';

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

<title>Knife Queer Art Gallery</title>

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
        <div class="title imp-txt">Knife Queer Art Gallery</div>
    </div>
    
    <div class="nav-rowbox navbox-color">
        <a class="nav-btn btncolor" href="#sfw">General Art</a>
        <a class="nav-btn btncolor" href="#nsfw">Mature Art</a>
        <a class="nav-btn btncolor" href="unreality.php">Unreality Agents</a>
    </div>
    
    <div class="verti" id="sfw">
        
        <div class="subtitle imp-txt">General Art</div>
    
        <div class="home-rowbox">
            
            <?php
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE `explicit` = '0' AND `spoiler` = '0' AND `exclude` = '0' ORDER BY `date` DESC");
            
            while ($row = mysqli_fetch_array($q)) {
                
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
                
                if ($row['imgset'] == NULL) {
                
                echo '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="', $row['id'], '">', $row['warntext'], '</div>
                    <img class="thumbnail" src="../img/', $row['filename'], '-thumb.png">
                    <div class="hidden" id="J-', $row['id'], '">1</div>
                    <div class="hidden" src="../img/', $row['filename'], '.png" id="H-', $row['id'], '">
                        <div class="padded">
                        <div class="img-title imp-txt">', $row['title'], '</div>
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
                        
                        echo '
                        </div>
                    </div>
                </div>';
                
                } elseif ($row['imgset'] == '1') {
                  
                  $img_n = 1;
                  
                  do {
                    $filepath = '../img/'.$row['filename'].'-'.$img_n.'.png';
                    if (file_exists($filepath)) {
                      $img_n++;
                    } else {
                      break;
                    }
                  } while ($img_n < 15);
                  
                  $img_n = $img_n - 1;
                  
                  $first_img = $row['filename'].'-1.png';
                  
                  echo '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="', $row['id'], '">', $row['warntext'], '</div>
                    <img class="thumbnail" src="../img/', $row['filename'], '-thumb.png">
                    <div class="hidden" id="J-', $row['id'], '">', $img_n, '</div>
                    <div class="hidden" src="../img/', $first_img, '" id="H-', $row['id'], '">
                    <div class="padded">
                    <div class="img-rowbox">
                        <div class="mini-side-btn btncolor crnt arrow" id="prev" onclick="useArrow(event);" onkeyup="useArrow(event);"><<</div>
                        <div>
                        <div class="img-title imp-txt">', $row['title'], '</div>
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
                        
                        echo '
                        </div>
                        <div class="mini-side-btn btncolor arrow" tabindex="0" id="next" onclick="useArrow(event);" onkeyup="useArrow(event);">>></div>
                        </div>
                        </div>
                    </div>
                </div>';
                }
            }
            
            ?>
            
        </div>
    
    </div>
    
    <div class="verti" id="nsfw">
        
        <div class="subtitle imp-txt">Mature Art</div>
    
        <div class="home-rowbox">
            
            <?php
            
            $q = mysqli_query($db, "SELECT * FROM `gallery` WHERE `explicit` = '1' AND `spoiler` = '0' AND `exclude` = '0' ORDER BY `date` DESC");
            
            while ($row = mysqli_fetch_array($q)) {
                
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
                
                if ($row['imgset'] == NULL) {
                
                echo '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="', $row['id'], '">', $row['warntext'], '</div>
                    <img class="thumbnail" src="../img/', $row['filename'], '-thumb.png">
                    <div class="hidden" id="J-', $row['id'], '">1</div>
                    <div class="hidden" src="../img/', $row['filename'], '.png" id="H-', $row['id'], '">
                        <div class="padded">
                        <div class="img-title imp-txt">', $row['title'], '</div>
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
                        
                        echo '
                        </div>
                    </div>
                </div>';
                
                } elseif ($row['imgset'] == '1') {
                  
                  $img_n = 1;
                  
                  do {
                    $filepath = '../img/'.$row['filename'].'-'.$img_n.'.png';
                    if (file_exists($filepath)) {
                      $img_n++;
                    } else {
                      break;
                    }
                  } while ($img_n < 15);
                  
                  $img_n = $img_n - 1;
                  
                  $first_img = $row['filename'].'-1.png';
                  
                  echo '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="', $row['id'], '">', $row['warntext'], '</div>
                    <img class="thumbnail" src="../img/', $row['filename'], '-thumb.png">
                    <div class="hidden" id="J-', $row['id'], '">', $img_n, '</div>
                    <div class="hidden" src="../img/', $first_img, '" id="H-', $row['id'], '">
                    <div class="padded">
                    <div class="img-rowbox">
                        <div class="mini-side-btn btncolor crnt arrow" id="prev" onclick="useArrow(event);" onkeyup="useArrow(event);"><<</div>
                        <div>
                        <div class="img-title imp-txt">', $row['title'], '</div>
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
                        
                        echo '
                        </div>
                        <div class="mini-side-btn btncolor arrow" tabindex="0" id="next" onclick="useArrow(event);" onkeyup="useArrow(event);">>></div>
                        </div>
                        </div>
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