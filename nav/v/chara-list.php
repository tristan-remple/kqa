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
  echo '<title>Knife Queer Wiki:', $row['name'], ' Characters</title>';
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
    
    <div class="hb">
        <div class="title imp-txt">Knife Queer Wiki: <?php echo $row['name']; ?> Characters</div>
    </div>
    
    <div class="nav-rowbox navbox-color">
        <a class="nav-btn btncolor" href="verse.php?v=<?php echo $v, '">', $row['name']; ?> Main</a>
        <a class="nav-btn btncolor" href="../verse-select.php">Verse Selection</a>
    </div>
    
    <div class="home-rowbox">
        
        <?php
        
        $chtbl = $v.'_charas';
        
        $qc = mysqli_query($db, "SELECT * FROM `$chtbl` WHERE `exclude` = '0' ORDER BY `d_index`");
        
        while ($rc = mysqli_fetch_array($qc)) {
          
          if ((isset($rc['bio'])) && ($rc['bio'] !== '')) {
          $icon = '../../img/'.$rc['nick'].'-small.png';
            
            echo '<div class="verse-thumb box-color">';
            if (file_exists($icon)) {
                  echo '<img class="thumbnail" src="', $icon, '">';
                } else {
                  echo '<img class="thumbnail" src="../../img/placeholder.png">';
                }
              echo '<a class="story-title btncolor" href="character.php?v=', $v, '&id=', $rc['id'], '">', $rc['name'], '</a>
              </div>';
          }
        }
        
        ?>
        
    </div>
    
    <?php } else {
      echo '<div class="title imp-txt">Bad URL</div>';
    } ?>
    
</div>
</div>
</body>
</html>