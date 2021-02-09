<?php
include 'conect.php';
session_start();

$conn = OpenCon();


// Criar USUARIO
if (isset($_POST['salvar_usuario'])) {

  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  $nome = $_POST['nome'];

  $query = "INSERT INTO usuario (login,senha,nome) VALUES('$usuario','$password','$nome')";
  $query_run = mysqli_query($conn, $query);
  
  if ($query_run) {
    $_SESSION["status"] = "Usuario Cadastrado com Sucesso";
    header("location: ../frontend/pages/usuarios.php");
  } else {
    $_SESSION["status"] = "Erro ao cadastra Usuario";
    header("location: ../frontend/pages/usuarios.php");
  }
}

// dados veiculo
if(isset($_POST['checking_veiculo'])){

  $s_id = $_POST['id_veiculo'];

  $result_array = [];

  $query = "SELECT * FROM veiculo where idveiculo='$s_id'";
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

// GET VEICULOS LIVRES
if(isset($_POST['veiculoslivres'])){
  
  if(isset($_POST['idveiculousado'])){
    $idveiculousado = $_POST['idveiculousado'];
    $query = "SELECT * FROM veiculo where status = 0 or idveiculo='$idveiculousado'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0){
      foreach($query_run as $row){
          $result_array[] = array(
            'id' => $row['idveiculo'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'placa' => $row['placa'],
            'ano' => $row['ano']
          );
      }
      header('Content-type: application/json');
      echo json_encode($result_array);
    }else{
      echo $return = "<h5> Sem veiculos Cadastrado</h5>";
    }
  }else{
    $query = "SELECT * FROM veiculo where status = 0";
    $query_run = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($query_run) > 0){
      foreach($query_run as $row){
          $result_array[] = array(
            'id' => $row['idveiculo'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'placa' => $row['placa'],
            'ano' => $row['ano']
          );
      }
      header('Content-type: application/json');
      echo json_encode($result_array);
    }else{
      echo $return = "<h5> Sem veiculos Cadastrado</h5>";
  }
  }
}


?>