<?php
    function limpar_texto($str){
        return preg_replace("/[^0-9]/", "", $str);
    }

    function visualizaNascimento($str){
        return implode('/', array_reverse(explode('-', $str)));
    }

    function visualizaTelefone ($str){
        if(empty($str)){
            return "Não informado";
        }

        $ddd = substr($str, 0, 2);
        $parte1 = substr($str, 2, 5);
        $parte2 = substr($str, 7);
        return "($ddd) $parte1-$parte2";
    }

    function visualizaDataBanco($str){
        return date("d/m/Y H:i:s", strtotime($str));
    }
    
    use PHPMailer\PHPMailer\PHPMailer;
    function enviarEmail($destinatario, $assunto, $mensagem){
        require_once 'vendor/autoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0; //Para visualizar o log do e-mail coloque o atributo com o valor 2
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'vinisibim@hotmail.com.br';
        $mail->Password = 'A21081998b';

        $mail->SMTPSecure = false;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('vinisibim@hotmail.com.br', "Vinicius Sibin");
        $mail->addAddress("$destinatario");
        $mail->Subject = "$assunto";
        $mail->Body = "$mensagem";

        if($mail->send()){
            return true;
        } else {
            return false;
        }
    }
?>