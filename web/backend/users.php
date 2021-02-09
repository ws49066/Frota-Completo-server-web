<?php
include 'conect.php';
session_start();

$conn = OpenCon();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query = "SELECT * from usuario WHERE login = '$usuario' and senha='$password'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);

if($count == 1){
    header("location: ../frontend/pages/abastecimento.php");
}else{
    echo "Your Login Name or Password is invalid";
}
