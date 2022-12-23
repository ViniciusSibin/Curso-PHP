<?php
    function limpar_texto($str){
        return preg_replace("/[^0-9]/", "", $str);
    }

    function visualizaNascimento($str){
        return implode('/', array_reverse(explode('-', $str)));
    }
?>