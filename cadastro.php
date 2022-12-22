<?php
    require_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Clientes</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Cadastrar Clientes</h1>
        <p>
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Ex: Vinicius Luiz Silva Sibin">
        </p>
        <p>
            <label>E-mail</label>
            <input type="text" name="email" placeholder="Ex: exemplo@gmail.com">
        </p>
        <p>
            <label>Telefone</label>
            <input type="text" name="telefone" placeholder="Ex: (44) 9 8765-4321">
        </p>
        <p>
            <label>Nascimento</label>
            <input type="text" name="nascimento" placeholder="Ex: 21/08/1998">
        </p>
        <p>
            <button type="submit">Cadastrar</button> 
            <button><a href="listaDeClientes.php">Lista de Clientes</a></button>
        </p>
    </form>
</body>
</html>