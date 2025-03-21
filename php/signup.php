<?php
    session_start();
    require_once "connect.php";
    
    function LoginInUse($connect, $username){
        $username = mysqli_real_escape_string($connect, $username);
        
        $result = @$connect->query(sprintf(
            "SELECT * FROM user WHERE username='%s'",
            mysqli_real_escape_string($connect, $username)));
        if($result->num_rows>0){
            return true;
        }
        return false;
    }
    function EmailInUse($connect, $email){
        $email = mysqli_real_escape_string($connect, $email);
        
        $result = @$connect->query(sprintf(
            "SELECT * FROM user WHERE email='%s'",
            mysqli_real_escape_string($connect, $email)));
        if($result->num_rows>0){
            return true;
        }
        return false;
    }

    function samePasswords($pass, $pass2){
        return $pass === $pass2;   
    }

    try{
        $connect = new mysqli($host, $db_user, $db_password, $db_name);
        if($connect->connect_errno){
            throw new Exception(mysqli_connect_errno());
        }
    }catch(Exception $e){
        echo "Server error";
        exit();
    }
    

    $username=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $pass2=$_POST['pass2'];

    $flag = true;
    if(LoginInUse($connect, $username)){
        $_SESSION['e_username'] = "Username already in use<br>";
        $flag=false;
    }
    if(strlen($username)<3 || strlen($username)>20){
        $_SESSION['e_username'] = "Username must contain 3-20 characters<br>";
        $flag=false;
    }
    if(!ctype_alnum($username)){
        $_SESSION['e_username'] = "Your username contain disallowed characters<br>";
        $flag=false;
    }
    if(EmailInUse($connect, $email)){
        $_SESSION['e_email'] = "Email already in use<br>";
        $flag=false;
    }
    if(strlen($pass)<6 || strlen($pass)>20){
        $_SESSION['e_pass'] = "Password m'ust contain 6-20 characters<br>";
        $flag=false;
    }
    if(!samePasswords($pass,$pass2)){
        $_SESSION['e_pass2'] = "Passwords must be equal<br>";
        $flag=false;
        
    }

    if($flag){
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        try{
            if($connect->query("INSERT INTO user VALUES (NULL,'$username','$pass_hash','$email',NULL,25,2,1,1,1)")){
                $_SESSION['user'] = $username;
                $_SESSION['loged'] = true;
                header('Location: main.php');
            }else{
                throw new Exception($connect->error);
            }
        }catch(Exception $e){
            echo "blad";
        }
    }else{
        header('Location: register.php');
    }

    $connect->close();
?>