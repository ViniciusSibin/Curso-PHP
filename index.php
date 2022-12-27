<?php
    if(isset($_POST['email']) && isset($_POST['senha'])){
        require_once('lib/conexao.php');

        $email = $mysqli->escape_string($_POST['email']);
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM clientes WHERE email = '$email'";
        $sql_query = $mysqli->query($sql) or die($mysqli->error);

        if($sql_query->num_rows == 0){
            echo "<p style='color: red;'><b>ERRO: E-mail digitado está incorreto</b></p>";
        } else {
            $usuario = $sql_query->fetch_assoc();
            if(!password_verify($senha, $usuario['senha'])){
                echo "<p style='color: red;'><b>ERRO: A senha informada está incorreta</b></p>";
            } else {
                if(!isset($_SESSION)){
                    session_start();
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['admin'] = $usuario['admin'];
                    header("Location: listaDeClientes.php");
                } 
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Login</h1>
        <p>
            <label>E-mail</label>
            <input type="text" name="email" placeholder="Ex: exemplo@gmail.com">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Acessar</button>
        </p>
        
    </form>
</body>
</html>