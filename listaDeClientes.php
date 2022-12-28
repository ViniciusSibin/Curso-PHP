<?php
    require_once("lib/conexao.php");
    require_once("lib/funcoes.php");
    
    $pesquisa = "";

    if(isset($_GET['pesquisa'])) $pesquisa = $_GET['pesquisa'];


    $sql = "SELECT * FROM clientes WHERE nome LIKE '%$pesquisa%' OR email LIKE '%$pesquisa%' OR telefone LIKE '%$pesquisa%' OR Nascimento LIKE '%$pesquisa%'";
    $tabelaClientes = $mysqli->query($sql) or die($mysqli->error);
    $numLinhas = $tabelaClientes->num_rows;

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['usuario'])){
        header("Location: index.php");
        die();
    }

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
    <form method="GET" action="">
        <label>Pesquisa:</label>
        <input type="text" name="pesquisa" placeholder="O que você procura?">
        <button type="submit">Pesquisar</button>
    </form>
    <p>Clientes cadastrados no sistema</p>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>    
            <th>Imagem</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data Nascimento</th>
            <th>Data Cadastro</th>
            <th>Admin</th>
            <?php if($_SESSION['admin']){ ?><th></th><?php } ?>
        </thead>
        <tbody>
            <?php if($numLinhas == 0){ ?> 
                <tr>
                    <td colspan=<?php if($_SESSION['admin']) echo 9; else 8;?>>Nenhum cliente foi cadastrado!!!</td>    
                </tr>
            <?php } ?>

            <?php while($cliente = $tabelaClientes->fetch_assoc()){ ?> 
                <tr>  
                    <td><?php echo $cliente['id']; ?></td>
                    <td><img height="45" src="<?php echo $cliente['fotoPerfil']; ?>" alt=""></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo visualizaTelefone($cliente['telefone']); ?></td>
                    <td><?php echo visualizaNascimento($cliente['nascimento']); ?></td>
                    <td><?php echo visualizaDataBanco($cliente['dataCadastro']); ?></td>
                    <td><?php if($cliente['admin']){echo "SIM";}else{echo "NÃO";}?></td>
                    <?php if($_SESSION['admin']){ ?>
                    <td>
                        <a href="atualizarCadastro.php?id=<?php echo $cliente['id']; ?>">Atualizar</a>
                        <a href="deletarCadastro.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    <button><a href="cadastro.php">Cadastrar</a></button>
    <button><a href="logout.php">Sair</a></button>
</body>
</html>