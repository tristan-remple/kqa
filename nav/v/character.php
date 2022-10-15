<?php

include("../../db.php");

$current = NULL;

if ((!isset($_SESSION['consent'])) || ($_SESSION['consent'] !== 'yes')) {
    include('../../frames/warning-lvl2.php');
}

if ((isset($_GET)) && (isset($_GET['v'])) && (isset($_GET['id']))) {
  if ((preg_match('/[^a-z]/i', $_GET['v'])) || (preg_match('/[^0-9]/i', $_GET['id']))) {
    $error = 'url';
  } else {
    $v = $_GET['v'];
    $c = $_GET['id'];
    $chtbl = $v.'_charas';
    $q = mysqli_query($db, "SELECT * FROM `$chtbl` WHERE `id` = '$c'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    } else {
      $error = 'nonexistent';
    }
  }
} else {
  $error = 'url';
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

if (isset($v)) {
$vq = mysqli_query($db, "SELECT * FROM `verse` WHERE `tag` = '$v'");
$vrow = mysqli_fetch_array($vq);

if (isset($row['css'])) {
  $color = $row['css'];
} elseif (isset($vrow['css'])) {
  $color = $vrow['css'];
} else {
  $color = 'peacock';
}
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
    
    <div class="title imp-txt"><?php echo $row['name']; ?></div>
    
    <div class="twocol-layout">
        
        <div class="narrow-col">
          
          <?php
          
          $profile = '../../img/'.$row['nick'].'-large.png';
          $icon = '../../img/'.$row['nick'].'-small.png';
          
          if (file_exists($profile)) {
            
            echo '<img class="profile nia-border pro-fit" src="', $profile, '">';
            
          } elseif (file_exists($icon)) {
            echo '<img class="profile nia-border pro-fit" src="', $icon, '">';
          } else {
            echo '<img class="profile nia-border pro-fit" src="../../img/placeholder.png">';
          }
          
          ?>
            
            <div class="bio-text box-color scroll-pls">
                <div class="padded story-main">
                  
                    <?php
                    
                    if ((isset($row['pronouns'])) && ($row['pronouns'] !== '')) {
                      echo '<b>Pronouns:</b> ', $row['pronouns'], '<br>';
                    }
                    
                    if ((isset($row['age'])) && ($row['age'] !== '')) {
                      echo '<b>Age:</b> ', $row['age'], '<br>';
                    }
                    
                    if ((isset($row['height'])) && ($row['height'] !== '')) {
                      echo '<b>Height:</b> ', $row['height'], '<br>';
                    }
                    
                    if ((isset($row['race'])) && ($row['race'] !== '')) {
                      echo '<b>Ethnicity:</b> ', $row['race'], '<br>';
                    }
                    
                    if ((isset($row['gender'])) && ($row['gender'] !== '')) {
                      echo '<b>Gender:</b> ', $row['gender'], '<br>';
                    }
                    
                    if ((isset($row['sexuality'])) && ($row['sexuality'] !== '')) {
                      echo '<b>Sexuality:</b> ', $row['sexuality'], '<br>';
                    }
                    
                    if ((isset($row['birthday'])) && ($row['birthday'] !== '')) {
                      echo '<b>Birthday:</b> ', $row['birthday'], '<br>';
                    }
                    
                    if ((isset($row['faction'])) && ($row['faction'] !== '')) {
                      echo '<b>Affiliation:</b> ', $row['faction'], '<br>';
                    }
                    
                    if ((isset($row['job'])) && ($row['job'] !== '')) {
                      echo '<b>Profession:</b> ', $row['job'], '<br>';
                    }
                    
                    if ((isset($row['specialty'])) && ($row['specialty'] !== '')) {
                      echo '<b>Extra:</b> ', $row['specialty'], '<br>';
                    }
                    
                    ?>
                    
                </div>
            </div>
            
        </div>
        
        <div class="wide-col">
            
            <div class="bio-text box-color scroll-pls">
                <div class="padded">
                    <?php
                    if ((isset($row['bio'])) && ($row['bio'] !== '')) {
                      echo $row['bio'];
                    } else {
                      echo 'This character does not have a written bio yet. Check back later!';
                    }
                    ?>
                </div>
            </div>
            
            <div class="ship-rowbox">
                
                <?php
                
                $rtbl = $v.'_ships';
                $q = mysqli_query($db, "SELECT * FROM `$rtbl` WHERE `id` = '$c'");
                if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
                  $rs = mysqli_fetch_array($q);
                } else {
                  $rs = NULL;
                }
                
                if ((isset($rs['r_thumb1'])) && ($rs['r_thumb1'] !== '')) {
                  
                $s1 = $rs['r_thumb1'];
                $q1 = mysqli_query($db, "SELECT `name`, `id` FROM `$chtbl` WHERE `nick` = '$s1'");
                $r1 = mysqli_fetch_array($q1);
                
                ?>
                
                <div class="bio-text box-color no-grow">
                    <div class="flex-padded">
                        <div class="subhead">Connections</div>
                    </div>
                </div>
                
                <div class="ship-box">
                    <div class="thumb-box ia-border">
                        <a class="thumb-hover th-color" href="character.php?v=<?php echo $v, '&id=', $r1['id']; ?>"><?php echo $r1['name']; ?></a>
                        <?php
                        $icon = '../../img/'.$rs['r_thumb1'].'-small.png';
                        
                        if (file_exists($icon)) {
                          echo '<img class="thumbnail" src="', $icon, '">';
                        } else {
                          echo '<img class="thumbnail" src="../../img/placeholder.png">';
                        }
                        ?>
                    </div>
                    <div class="bio-text box-color scroll-pls hidden ship-text">
                        <div class="padded">
                            <?php echo $rs['r_text1']; ?>
                        </div>
                    </div>
                </div>
                
                <?php }
                
                if ((isset($rs['r_thumb2'])) && ($rs['r_thumb2'] !== '')) {
                  
                $s2 = $rs['r_thumb2'];
                $q2 = mysqli_query($db, "SELECT `name`, `id` FROM `$chtbl` WHERE `nick` = '$s2'");
                $r2 = mysqli_fetch_array($q2);
                
                ?>
                
                <div class="ship-box">
                    <div class="thumb-box ia-border">
                        <a class="thumb-hover th-color" href="character.php?v=<?php echo $v, '&id=', $r2['id']; ?>"><?php echo $r2['name']; ?></a>
                        <?php
                        $icon = '../../img/'.$rs['r_thumb2'].'-small.png';
                        
                        if (file_exists($icon)) {
                          echo '<img class="thumbnail" src="', $icon, '">';
                        } else {
                          echo '<img class="thumbnail" src="../../img/placeholder.png">';
                        }
                        ?>
                    </div>
                    <div class="bio-text box-color scroll-pls hidden ship-text">
                        <div class="padded">
                            <?php echo $rs['r_text2']; ?>
                        </div>
                    </div>
                </div>
                
                <?php }
                
                if ((isset($rs['r_thumb3'])) && ($rs['r_thumb3'] !== '')) {
                  
                $s3 = $rs['r_thumb3'];
                $q3 = mysqli_query($db, "SELECT `name`, `id` FROM `$chtbl` WHERE `nick` = '$s3'");
                $r3 = mysqli_fetch_array($q3);
                
                ?>
                
                <div class="ship-box">
                    <div class="thumb-box ia-border">
                        <a class="thumb-hover th-color" href="character.php?v=<?php echo $v, '&id=', $r3['id']; ?>"><?php echo $r3['name']; ?></a>
                        <?php
                        $icon = '../../img/'.$rs['r_thumb3'].'-small.png';
                        
                        if (file_exists($icon)) {
                          echo '<img class="thumbnail" src="', $icon, '">';
                        } else {
                          echo '<img class="thumbnail" src="../../img/placeholder.png">';
                        }
                        ?>
                    </div>
                    <div class="bio-text box-color scroll-pls hidden ship-text">
                        <div class="padded">
                            <?php echo $rs['r_text3']; ?>
                        </div>
                    </div>
                </div>
                
                <?php }
                
                if ((isset($rs['r_thumb4'])) && ($rs['r_thumb4'] !== '')) {
                  
                $s4 = $rs['r_thumb4'];
                $q4 = mysqli_query($db, "SELECT `name`, `id` FROM `$chtbl` WHERE `nick` = '$s4'");
                $r4 = mysqli_fetch_array($q4);
                
                ?>
                
                <div class="ship-box">
                    <div class="thumb-box ia-border">
                        <a class="thumb-hover th-color" href="character.php?v=<?php echo $v, '&id=', $r4['id']; ?>"><?php echo $r4['name']; ?></a>
                        <?php
                        $icon = '../../img/'.$rs['r_thumb4'].'-small.png';
                        
                        if (file_exists($icon)) {
                          echo '<img class="thumbnail" src="', $icon, '">';
                        } else {
                          echo '<img class="thumbnail" src="../../img/placeholder.png">';
                        }
                        ?>
                    </div>
                    <div class="bio-text box-color scroll-pls hidden ship-text">
                        <div class="padded">
                            <?php echo $rs['r_text4']; ?>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
                
            </div>
            
        </div>
        
        <?php
        
        $full = '../../img/'.$row['nick'].'-full.png';
        
        if (file_exists($full)) {
        
        echo '<div class="narrow-col">
            <img class="full hidden" src="', $full, '">
        </div>';
        
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