<?php session_start()?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <h1>Cadastro</h1>
    <form action="processa_cadastro.php" method="post">
        <input type="email" name="email">
        <input type="password" name="senha">
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>
</body>
</html>