<?php 
session_start();
include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        if(!isset($_SESSION['login'])){

            if(isset($_POST['acao'])){
                //login
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

                $verifica = "SELECT * FROM usuarios WHERE email= '$email' AND senha = '$senha'";
                $resultado = mysqli_query($conexao, $verifica);

                if (mysqli_num_rows($resultado) > 0) {
                    $_SESSION['login'] = $email;
                    header('Location: index.php');

                } 
                else {

                    echo 'Dados errados';
                }
                exit();
            }

            

            include('login.php');
        } 
        else{

            if(isset($_GET['logout'])){
                unset($_SESSION['login']);
                session_destroy();
                header('Location: index.php');
                exit();
            }
            include('home.php');
        }
    ?>
</body>
</html>