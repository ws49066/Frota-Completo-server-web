<?php
include 'conect.php';
session_start();

$conn = OpenCon();

// dados veiculo
if(isset($_POST['checking_abastece'])){

  $s_id = $_POST['id_abastece'];

  $result_array = [];

  $query = "SELECT a.idabastece,a.data,a.tipocombustivel,a.nrequisicao,a.kmatual,a.idveiculo,a.idusuario,u.idusuario,u.nome,u.cnh,u.categoria,v.tipo,
  v.idveiculo,v.marca,v.modelo,v.ano,v.cor,v.roda,v.placa from abastece as a
  inner join usuario as u
  on a.idusuario=u.idusuario
  inner join veiculo as v
  on a.idveiculo=v.idveiculo
  where a.idabastece = '$s_id'";
  $query_run = mysqli_query($conn, $query);

  if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $row){
        array_push($result_array, $row);
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
  }else{
    echo $return = "<h5> Não encontrado</h5>";
  }
}

if(isset($_POST['checking_abastece_fotos'])){

    $s_id_fotos = $_POST['id_abastece'];
  
    $result_array = [];
  
    $query = "SELECT path from fotos_abastece where idabastece = '$s_id_fotos'";
    $query_run = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            $result_array[] = array('path' => $row['path']);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
      }else{
        echo $return = "<h5> Erro </h5>";
      }
  }

