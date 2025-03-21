<?php
    session_start();
    if(isset($_SESSION['loged'])) header('Location: main.php');
    require_once "connect.php";
    

    $connect = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($connect->connect_errno != 0){
        echo "Error: ".$connect->connect_errno;
    }
    else{
        $username = $_POST['username'];
        $username = htmlentities($username, ENT_QUOTES, "UTF-8");
        
        $password = $_POST['pass'];


        if($result = @$connect->query(sprintf(
            "SELECT * FROM user WHERE username='%s'",
            mysqli_real_escape_string($connect, $username))))
        {
            $users = $result->num_rows;
            if($users>0){
                $wiersz = $result->fetch_assoc();
                if(password_verify($password,$wiersz['password'])){
                    $_SESSION['user'] = $wiersz['username'];
                    $_SESSION['loged'] = true;
                    $result->free_result();

                    unset($_SESSION['error']);
                    header('Location: main.php');
                }else{
                    $_SESSION['error']='<span style="color:red">Incorrect Password!</span>';
                    header('Location: index.php');
                }

            }else{
                $_SESSION['error']='<span style="color:red">Incorrect Login </span>';
                header('Location: index.php');
            }

        }
        $connect->close();
    }
?>