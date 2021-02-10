<?php
include 'conect.php';
session_start();

$conn = OpenCon();

// dados veiculo
if(isset($_POST['checking_checklist'])){

  $s_id = $_POST['id_checklist'];

  $result_array = [];

  $query = "SELECT *
  FROM checklist AS cl
  INNER JOIN veiculo AS ve ON cl.idveiculo = ve.idveiculo
  INNER JOIN usuario AS us ON cl.idusuario = us.idusuario
  WHERE cl.idchecklist = '$s_id'";
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



