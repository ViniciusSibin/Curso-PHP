<?php
    $host = 'localhost'; 
    $db = 'CursoPHP';
    $user = 'sistema';
    $pass = 'sistema1234';

    $mysqli = new mysqli($host, $db, $user, $pass);
    if ($mysqli->connect_errno){
        die("A conexão com o banco de dados falhou");
    }
?>