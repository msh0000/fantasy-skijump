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
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="signup.php" method="post">
        <Label for="username">Nazwa użytkownika:</Label></br>
        <input name="username" type="text"></br>
        <?php
            if(isset($_SESSION['e_username'])) echo $_SESSION['e_username'];
        ?>
        <Label for="email">E-mail:</Label></br>
        <input name="email" type="email"></br>
        <?php
            if(isset($_SESSION['e_email'])) echo $_SESSION['e_email'];
        ?>
        <Label for="pass">Hasło:</Label></br>
        <input name="pass" type="password"></br>
        <?php
            if(isset($_SESSION['e_pass'])) echo $_SESSION['e_pass'];
        ?>
        <Label for="pass2">Powtórz hasło:</Label></br>
        <input name="pass2" type="password"></br>
        <?php
            if(isset($_SESSION['e_pass2'])) echo $_SESSION['e_pass2'];
        ?>
        <input type="submit" value="Zaloguj">
    </form> 
</div>

    
</body>
</html>