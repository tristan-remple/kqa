<?php

session_start();

$current = 'c';

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

<title>Knife Queer Art: Commissions</title>

</head>
<body>
    
<div class="outer">
    
<?php include('../frames/sidebar.php'); ?>
    
<div class="gradient"></div>

<div class="verti">
    
    <div class="title imp-txt">Knife Queer Art: Commissions</div>
    
    <div class="story box-color">
        <div class="flex-padded">
            Commissions are currently closed as I adjust to my workload at school.
        </div>
    </div>
    
</div>
</div>
</body>
</html>