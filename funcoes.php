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
?>