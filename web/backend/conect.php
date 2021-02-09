<?php

function OpenCon(){
    $host = "localhost";
    $user = "root";
    $pass = "t00r@nimda";
    $db = "frota";

    $conn = new mysqli($host,$user,$pass,$db) or die("Conexão falhou: %s\n". $conn -> error);

    return $conn;
}

function CloseCon($conn){
    $conn -> close();
}

?>