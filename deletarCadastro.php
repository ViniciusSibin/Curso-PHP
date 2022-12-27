<?php 
    require_once("lib/conexao.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['usuario'])){
        header("Location: index.php");
        die();
    }

    $usuario = $_GET['id'];
    $sqlConsulta = "SELECT * FROM clientes WHERE id = $usuario";
    $consultaQuery = $mysqli->query($sqlConsulta) or die($mysqli->error);
    $usuario = $consultaQuery->fetch_assoc();
    $usuarioID = $usuario['id'];

    if(isset($_POST['confirmaExclusao'])){
        $sqlExclusao = "DELETE FROM clientes WHERE id = $usuarioID";
        $exclusaoQuery = $mysqli->query($sqlExclusao) or die($mysqli->error);
        if($exclusaoQuery){
                unlink($usuario['fotoPerfil']);
            header("Location: listaDeClientes.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar usuário</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Tem certeza que deseja excluir o usuário: <?php echo $usuario['nome']; ?>?</h1>
        <button><a href="listaDeClientes.php">NAO</a></button>
        <button type="submit" name="confirmaExclusao" value="true">SIM</button>
        
    </form>
    
</body>
</html>




<?php
   
?>