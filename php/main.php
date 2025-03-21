<?php
    session_start();
    if(!isset($_SESSION['loged'])){
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowna</title>
</head>
<body>
    <a href="/skiJump/logout.php">Wyloguj</a> 
<?php
    echo "Witaj ".$_SESSION['user'];
?>
</body>
</html>