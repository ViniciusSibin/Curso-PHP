<?php
    require_once("conexao.php");
    require_once("funcoes.php");
    $sql = "SELECT * FROM clientes";
    $tabelaClientes = $mysqli->query($sql) or die($mysqli->error);
    $numLinhas = $tabelaClientes->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
</head>
<body>
    <h1>Lista de clientes</h1>
    <p>Clientes cadastrados no sistema</p>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data Nascimento</th>
            <th>Data Cadastro</th>
            <th></th>
        </thead>
        <tbody>
            <?php if($numLinhas == 0){ ?> 
                <tr>
                    <td colspan="7">Nenhum cliente foi cadastrado!!!</td>    
                </tr>
            <?php } ?>

            <?php while($cliente = $tabelaClientes->fetch_assoc()){ ?> 
                <tr>  
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo visualizaTelefone($cliente['telefone']); ?></td>
                    <td><?php echo visualizaNascimento($cliente['nascimento']); ?></td>
                    <td><?php echo visualizaDataBanco($cliente['dataCadastro']); ?></td>
                    <td>
                        <a href="atualizarCadastro.php">Atualizar</a>
                        <a href="deletarCadastro.php">Deletar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    <button><a href="cadastro.php">Cadastrar</a></button>
</body>
</html>