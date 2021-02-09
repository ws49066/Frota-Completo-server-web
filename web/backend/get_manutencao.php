<?php
include 'conect.php';
session_start();

$conn = OpenCon();

// dados veiculo
if(isset($_POST['checking_manutencao'])){

  $s_id = $_POST['id_manutencao'];

  $result_array = [];

  $query = "SELECT  m.idmanutencao,m.pecas,m.servicos,m.valorpecas,m.valorservicos,m.kmatual,m.data,m.total,m.idveiculo,m.idusuario,
                    u.idusuario,u.nome,u.cnh,u.categoria,
                    v.tipo,v.idveiculo,v.marca,v.modelo,v.ano,v.cor,v.roda,v.placa 
                    from manutencao as m
                    inner join usuario as u
                    on m.idusuario=u.idusuario
                    inner join veiculo as v
                    on m.idveiculo=v.idveiculo
                    where m.idmanutencao = '$s_id'";
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

if(isset($_POST['checking_manutencao_fotos'])){

    $s_id_fotos = $_POST['id_manutencao'];
  
    $result_array = [];
  
    $query = "SELECT path from fotos_manut where idmanut = '$s_id_fotos'";
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

