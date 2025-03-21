<?php
    session_start();
    if(isset($_SESSION['loged'])){
        header('Location: main.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
<div class="container">
    <form action="login.php" method="post">
        <Label for="username">Nazwa użytkownika:</Label></br>
        <input name="username" type="text"></br>
        <Label for="pass">Hasło:</Label></br>
        <input name="pass" type="password"></br>
        <input type="submit" value="Zaloguj">
    </form> 
</div>
<?php
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];


    }
?>  

</body>
</html>