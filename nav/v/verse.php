<?php

include("../../db.php");

$current = NULL;

if ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('../../frames/root-warning.php');
}

if ((isset($_GET)) && (isset($_GET['v']))) {
  if (preg_match('/[^a-z]/i', $_GET['v'])) {
    $error = 'url';
  } else {
    $v = $_GET['v'];
    $q = mysqli_query($db, "SELECT * FROM `verse` WHERE `tag` = '$v'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    }
  }
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

<link rel="stylesheet" type="text/css" href="../../css/desktop.css" media="screen and (min-width: 1000px)">
<link rel="stylesheet" type="text/css" href="../../css/mobile.css" media="screen and (max-width: 999px)">
<link rel="stylesheet" type="text/css" href="../../css/sidebar-color.css">

<?php

if (isset($row['css'])) {
  $color = $row['css'];
} else {
  $color = 'peacock';
}

echo '<link rel="stylesheet" type="text/css" href="../../css/', $color, '.css">';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../../scripts/side-minifier.js"></script>

<?php

if ($error == NULL) {
  echo '<title>Knife Queer Art:', $row['name'], '</title>';
} else {
  '<title>Bad URL</title>';
}

?>

</head>
<body>
    
<div class="outer">
    
<?php include('../../frames/sidebar-lvl2.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
  
  <?php if ($error == NULL) { ?>
    
    <div class="title imp-txt">Knife Queer Wiki: <?php echo $row['name']; ?></div>
    
    <div class="twocol-layout fixed">
        
        <div class="wide-col">
        
            <div class="bio-text box-color scroll-pls">
                <div class="padded">
                    <?php echo $row['synop']; ?>
                </div>
            </div>
            
            <?php
            
            $chtbl = $v.'_charas';
            $check = mysqli_query($db, "SELECT `id` FROM `$chtbl`");
            if ($check !== FALSE) {
              
            echo '<div class="home-rowbox">
                <a class="home-btn btncolor" href="chara-list.php?v=', $row['tag'], '">Characters</a>';
                if ($v == 'ua') {
                  echo '<a class="home-btn btncolor" href="../unreality.php">Media</a>';
                }
                echo '<a class="home-btn btncolor" href="../verse-select.php">Selection</a>';
            echo '</div>';
            
            } else {
              echo '<div class="home-rowbox">
              <a class="home-btn btncolor" href="../verse-select.php">Selection</a>
              </div>';
            }
            
            ?>
            
        </div>
        <div class="narrow-col">
            
            <img class="profile nia-border" src="../../img/<?php echo $row['logo']; ?>">
            
            <?php
            
            if ($check !== FALSE) {
            
            $feat1 = $row['feat_c1'];
            if (($feat1 !== NULL) && ($feat1 !== '')) {
            $fq1 = mysqli_query($db, "SELECT `name`, `nick` FROM `$chtbl` WHERE `id` = '$feat1'");
            $fr1 = mysqli_fetch_array($fq1);
            $i1 = '../../img/'.$fr1['nick'].'-small.png';
            
            echo '<div class="icon-rowbox">
                <div class="thumb-box ia-border">
                    <a class="thumb-hover th-color" href="character.php?v=', $v, '&id=', $feat1, '"><br>', $fr1['name'], '</a>';
                    if (file_exists($i1)) {
                      echo '<img class="thumbnail" src="', $i1, '">';
                    } else {
                      echo '<img class="thumbnail" src="../../img/placeholder.png">';
                    }
                echo '</div>';
            }
                
            $feat2 = $row['feat_c2'];
            if (($feat2 !== NULL) && ($feat2 !== '')) {
            $fq2 = mysqli_query($db, "SELECT `name`, `nick` FROM `$chtbl` WHERE `id` = '$feat2'");
            $fr2 = mysqli_fetch_array($fq2);
            $i2 = '../../img/'.$fr2['nick'].'-small.png';
                
                echo '<div class="thumb-box ia-border">
                    <a class="thumb-hover th-color" href="character.php?v=', $v, '&id=', $feat2, '"><br>', $fr2['name'], '</a>';
                    if (file_exists($i2)) {
                      echo '<img class="thumbnail" src="', $i2, '">';
                    } else {
                      echo '<img class="thumbnail" src="../../img/placeholder.png">';
                    }
                echo '</div>
            </div>';
            }
            }
            
            ?>
            
        </div>
        
    </div>
    
    <?php } else {
      echo '<div class="title imp-txt">Bad URL</div>';
    } ?>
    
</div>
</div>
</body>
</html>