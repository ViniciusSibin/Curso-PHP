<?php
    require_once("conexao.php");
    require_once("funcoes.php");

    if(count($_POST)>0){
        $erro = false;

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if(empty($nome)){
            $erro = "Preencha o campo nome!";
        } else if((strlen($nome)<6) || (strlen($nome)>60)){
            $erro = "O nome deve ter entre 6 60 caracteres!";
        } else if(substr($nome, 0, 1) == " "){
            $erro = "O nome não deve iniciar com espaço";
        }

        if(empty($email)){
            $erro = "Preencha o campo E-mail!";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = "O E-mail deve ser preenchido no padrão: exemplo@gmail.com";
        }

        if(!empty($telefone)){
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11){
                $erro = "O telefone foi preenchido incorretamente!";
            }
        }

        if(empty($nascimento)){
            $erro = "Preencha o campo de data de nascimento!";
        } else if (strlen($nascimento = implode('-', array_reverse(explode('/',$nascimento)))) != 10){
            $erro = "Data de Nascimento está incorreta!";
        }
        
        if($erro){
            echo "<p><b>ERRO: $erro</b></p>";
        } else {
            $sql = "INSERT INTO clientes (nome, email, telefone, nascimento, dataCadastro) VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
            $sqlQuery = $mysqli->query($sql) or die($mysqli->error);

            echo "Usuário cadastrado com sucesso!!";
        }
    }
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
        <p>Todos os campos com * são obrigatórios</p>
        <p>
            <label>Nome</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'] ?>" type="text" name="nome" placeholder="Ex: Vinicius Luiz Silva Sibin"> *
        </p>
        <p>
            <label>E-mail</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" type="text" name="email" placeholder="Ex: exemplo@gmail.com"> *
        </p>
        <p>
            <label>Telefone</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'] ?>" type="text" name="telefone" placeholder="Ex: (44) 9 8765-4321">
        </p>
        <p>
            <label>Nascimento</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'] ?>" type="text" name="nascimento" placeholder="Ex: 21/08/1998"> *
        </p>
        <p>
            <button type="submit">Cadastrar</button> 
            <button><a href="listaDeClientes.php">Lista de Clientes</a></button>
        </p>
    </form>
</body>
</html>