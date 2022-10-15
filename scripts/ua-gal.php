<?php while ($row = mysqli_fetch_array($q)) {
                
                $v = 'ua';
                    
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
                    
                    if ($row['imgset'] == NULL) {
                
                $current = '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="'.$row['id'].'">'.$row['warntext'].'</div>
                    <img class="thumbnail" src="../img/'.$row['filename'].'-thumb.png">
                    <div class="hidden" id="J-'.$row['id'].'">1</div>
                    <div class="hidden" src="../img/'.$row['filename'].'.png" id="H-'.$row['id'].'">
                        <div class="padded">
                        <div class="img-title imp-txt">'.$row['title'].'</div>
                        <b>Date Created:</b> '.date('M jS, Y', strtotime($row['date']));
                        
                        if (isset($c1_row)) {
                            $current = $current.'<br><b>Characters:</b> <a class="link-color" href="v/character.php?v='.$v.'&id='.$c1_row['id'].'">'.$c1_row['name'].'.</a> ';
                            unset($c1_row);
                        }
                        
                        if (isset($c2_row)) {
                            $current = $current.'<a class="link-color" href="v/character.php?v='.$v.'&id='.$c2_row['id'].'">'.$c2_row['name'].'.</a> ';
                            unset($c2_row);
                        }
                        
                        if (isset($c3_row)) {
                            $current = $current.'<a class="link-color" href="v/character.php?v='.$v.'&id='.$c3_row['id'].'">'.$c3_row['name'].'.</a> ';
                            unset($c3_row);
                        }
                        
                        $current = $current.'</div></div></div>';
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
                  
                  $current = '<div class="thumb-box ia-border">
                    <div class="thumb-hover th-color" tabindex="0" id="'.$row['id'].'">'.$row['warntext'].'</div>
                    <img class="thumbnail" src="../img/'.$row['filename'].'-thumb.png">
                    <div class="hidden" id="J-'.$row['id'].'">'.$img_n.'</div>
                    <div class="hidden" src="../img/'.$first_img.'" id="H-'.$row['id'].'">
                    <div class="padded">
                    <div class="img-rowbox">
                        <div class="mini-side-btn btncolor crnt arrow" id="prev" onclick="useArrow(event);" onkeyup="useArrow(event);"><<</div>
                        <div>
                        <div class="img-title imp-txt">'.$row['title'].'</div>
                        <b>Date Created:</b> '.date('M jS, Y', strtotime($row['date']));
                        
                        if (isset($c1_row)) {
                            $current = $current.'<br><b>Characters:</b> <a class="link-color" href="v/character.php?v='.$v.'&id='.$c1_row['id'].'">'.$c1_row['name'].'.</a> ';
                            unset($c1_row);
                        }
                        
                        if (isset($c2_row)) {
                            $current = $current.'<a class="link-color" href="v/character.php?v='.$v.'&id='.$c2_row['id'].'">'.$c2_row['name'].'.</a> ';
                            unset($c2_row);
                        }
                        
                        if (isset($c3_row)) {
                            $current = $current.'<a class="link-color" href="v/character.php?v='.$v.'&id='.$c3_row['id'].'">'.$c3_row['name'].'.</a> ';
                            unset($c3_row);
                        }
                        
                        $current = $current.'
                        </div>
                        <div class="mini-side-btn btncolor arrow" tabindex="0" id="next" onclick="useArrow(event);" onkeyup="useArrow(event);">>></div>
                        </div>
                        </div>
                    </div>
                </div>';
                      
                    }
                    $array += [$row['date'] => $current];
            }
            
            ?>