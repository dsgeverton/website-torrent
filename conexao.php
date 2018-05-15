<?php
    $servername = "mysql.hostinger.com.br";
    $usuariodb = "u286184676_teste";
    $senhadb = "jurema123";
    $nomedb = "u286184676_teste";

    $link = mysqli_connect($servername,$usuariodb,$senhadb) or die("Não foi possível conectar");

    mysqli_select_db($link,$nomedb) or die("Erro ao efeturar login. Entre em contato com o Administrador do Sistema.");

?>
