<?php
session_start();
include_once 'conexao.php';

//Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Filtra e valida os dados do formulario
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    //Verifica se os campos foram preenchidos
    if (empty($email) || empty($senha)) {
        $_SESSION['msg'] = "<p class='msg'>Por favor, preencha tudo.</p>";
        header("Location: cadastro.php");
        exit(); //Encerra o script para evitar execução adicional
    }


    //Verifica se o email já está cadastrado
    $query_verifica_email = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado_verifica_email = mysqli_query($conexao, $query_verifica_email);

    if (mysqli_num_rows($resultado_verifica_email) > 0) {
        $_SESSION['msg'] = "<p class='msg'>Email já cadastrado.</p>";
        header("location: cadastro.php");
        exit();
    }

    //Se tudo estiver correto insere o novo usuário no banco de dados
    $create_user = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
    $created_user = mysqli_query($conexao, $create_user);

    if ($created_user) {
        $_SESSION['msg'] = "<p class='msg' style='color:green'>Usuário cadastrado com sucesso.</p>";
        header("location: cadastro.php");
    } else {
        $_SESSION['msg'] = "<p class='msg'>Erro ao cadastrar usuário</p>";
        header("location: cadastro.php");
    }
} else {
    //Redireciona para a página cadastro caso o método da requisição não seja POST
    header("Location: cadastro.php");
}