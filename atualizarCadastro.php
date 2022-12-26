<?php
    require_once("conexao.php");
    require_once("funcoes.php");

    $idUsuario = $_GET['id'];
    $sqlUpdate = "SELECT * FROM clientes where id = '$idUsuario'";
    $updateQuery = $mysqli->query($sqlUpdate) or die($mysqli->error);
    $dadosUsuario = $updateQuery->fetch_assoc();

    
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
    <form enctype="multipart/form-data" method="POST" action="">
        <h1>Cadastrar Clientes</h1>
        <p>Todos os campos com <b style='color: red;'>*</b> são obrigatórios</p>
        <p>
            <label>Nome: </label>
            <input value="<?php if(isset($dadosUsuario['nome'])) echo $dadosUsuario['nome'] ?>" type="text" name="nome" placeholder="Ex: Vinicius Luiz Silva Sibin"> <b style='color: red;'>*</b>
        </p>
        <p>
            <label>E-mail: </label>
            <input value="<?php if(isset($dadosUsuario['email'])) echo $dadosUsuario['email'] ?>" type="text" name="email" placeholder="Ex: exemplo@gmail.com"> <b style='color: red;'>*</b>
        </p>
        <p>
            <label>Telefone: </label>
            <input value="<?php if(isset($dadosUsuario['telefone'])) echo visualizaTelefone($dadosUsuario['telefone']); ?>" type="text" name="telefone" placeholder="Ex: (44) 9 8765-4321">
        </p>
        <p>
            <label>Data de Nascimento: </label>
            <input value="<?php if(isset($dadosUsuario['nascimento'])) echo visualizaNascimento($dadosUsuario['nascimento']); ?>" type="text" name="nascimento" placeholder="Ex: 21/08/1998"> <b style='color: red;'>*</b>
        </p>
        <p>
            <label>Senha:</label>
            <input value="<?php if(isset($_POST['senha'])) echo $_POST['senha'] ?>" type="password" name="senha" placeholder="Ex: @1234Senha">
        </p>
        <?php if($dadosUsuario['fotoPerfil']){ ?>
        <p>
            <label>Foto atual:</label>
            <img height="45" src="<?php echo $dadosUsuario['fotoPerfil'];?>" alt="">
        </p>
        <?php }?>
        <p>
            <label>Foto de Perfil:</label>
            <input name="fotoPerfil" type="file">
        </p>

        <?php 
        if(count($_POST)>0){
            $erro = false;
    
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $nascimento = $_POST['nascimento'];
            $senha = $_POST['senha'];
            $sql_code_extra = "";

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

            if(!empty($senha)){
                if(strlen($senha)<6 || strlen($senha)>20){
                $erro = "A senha deve conter entre 6 e 20 caracteres.";
                } else if(substr($senha, 0, 1) == " "){
                $erro = "A senha não deve iniciar com espaço";
                } else {
                    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
                    $sql_code_extra = "senha = '$senha_criptografada',";
                }
            }    

            $path = "";
            if(isset($_FILES['fotoPerfil'])){
                $arq = $_FILES['fotoPerfil'];
                $path = uploadArquivo ($arq['error'], $arq['size'], $arq['name'], $arq['tmp_name'], "arquivos/fotoPerfil/");
                if($path == false){
                    $erro = "Falha ao enviar arquivo. Tente novamente";
                }
            }
            
            if($erro){
                echo "<p style='color: red;'><b>ERRO: $erro</b></p>";
            } else {
                $senha = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "UPDATE cursophp.clientes SET nome='$nome', email='$email', $sql_code_extra telefone='$telefone', nascimento='$nascimento', fotoPerfil='$path' WHERE id='$idUsuario';";
                $sqlQuery = $mysqli->query($sql) or die($mysqli->error);
    
                echo "<p style='color: green;'><b>Usuário atualizado com sucesso!!</b></p>";
                header('Refresh:0');
            }
        }
        ?>

        <p>
            <button type="submit">Atualizar</button> 
            <button><a href="listaDeClientes.php">Lista de Clientes</a></button>
        </p>
        
    </form>
</body>
</html>