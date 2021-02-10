<?php
include 'conect.php';
session_start();

$conn = OpenCon();


// Criar VEICULO
if (isset($_POST['salvar_veiculo'])) {

  $tipo = $_POST['tipo'];
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $ano = $_POST['ano'];
  $cor = $_POST['cor'];
  $roda = $_POST['roda'];
  $placa = $_POST['placa'];
  $status = 0;

    $query = "INSERT INTO veiculo (tipo,marca,modelo,ano,cor,roda,placa,status) 
    VALUES('$tipo','$marca','$modelo',$ano,'$cor','$roda','$placa',$status)";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
      $_SESSION["status"] = "Veículo Cadastrado com Sucesso";
      header("location: ../frontend/pages/veiculos.php");
    } else {
      $_SESSION["status"] = "Erro ao cadastra Veículo";
      header("location: ../frontend/pages/veiculos.php");
    }
}

//Editar VEICULO
if (isset($_POST['checking_Editbtn'])) {
   $s_id = $_POST['veiculo_id'];

   $result_array = [];

   $query = "SELECT * FROM veiculo where idveiculo='$s_id'";
   $query_run = mysqli_query($conn, $query);

   if (mysqli_num_rows($query_run) > 0) {
     foreach ($query_run as $row) {
       array_push($result_array, $row);
       header('Content-type: application/json');
       echo json_encode($result_array);
     }
   } else {
     echo $return = "<h5> Não encontrado</h5>";
   }
 }

// Atualizar Usuario
 if (isset($_POST['update_veiculo'])) {
   $id_veiculo = $_POST['edit_id'];
   $tipo = $_POST['edit_tipo'];
   $marca = $_POST['edit_marca'];
   $modelo = $_POST['edit_modelo'];
   $ano = $_POST['edit_ano'];
   $cor = $_POST['edit_cor'];
   $roda = $_POST['edit_roda'];
   $placa = $_POST['edit_placa'];

   $query = "UPDATE veiculo SET tipo ='$tipo',marca = '$marca', modelo='$modelo', ano='$ano',
   cor='$cor', roda='$roda', placa='$placa', status=1 WHERE idveiculo='$id_veiculo'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    $_SESSION["status"] = "Veículo Atualizado com Sucesso";
    header("location: ../frontend/pages/veiculos.php");
  } else {
    $_SESSION["status"] = "Erro ao cadastra Veículo";
    header("location: ../frontend/pages/veiculos.php");
  }
}

//   if (isset($_POST['idveiculoOld'])) {
//     $cnh = $_POST['cnh'];
//     $veiculoOld = $_POST['idveiculoOld'];
//     $categoria = $_POST['categoria'];
//     $veiculosLivres = $_POST['veiculosLivres'];

//     if($veiculosLivres == $veiculoOld || $veiculosLivres == ''|| empty($veiculosLivres)){
//       $query = "UPDATE usuario SET nome ='$nome',senha = '$password', login='$usuario', cnh='$cnh',
//       categoria = '$categoria' WHERE idusuario='$id_usuario'";

//       $query_run = mysqli_query($conn, $query);

//       if ($query_run) {
//         $_SESSION["status"] = "Usuario Atualizado com Sucesso";
//         header("location: ../frontend/pages/usuarios.php");
//       } else {
//         $_SESSION["status"] = "Erro ao Atualizar Usuario";
//         header("location: ../frontend/pages/usuarios.php");
//       }

//     }else{
//       $query = "UPDATE usuario SET nome ='$nome',senha = '$password', login='$usuario', cnh='$cnh',
//       categoria = '$categoria', idveiculo='$veiculosLivres' 
//       WHERE idusuario='$id_usuario'";

//       $queryVeiculoMudaLivre = "UPDATE veiculo SET status=0 WHERE idveiculo = '$veiculoOld'";
//       $queryVeiculoMudaOcupado = "UPDATE veiculo SET status=1 WHERE idveiculo ='$veiculosLivres'";

//       $query_run = mysqli_query($conn, $query);
//       $query_run2 = mysqli_query($conn, $queryVeiculoMudaLivre);
//       $query_run3 = mysqli_query($conn, $queryVeiculoMudaOcupado);

//       if ($query_run && $query_run2 && $query_run3) {
//         $_SESSION["status"] = "Usuario Atualizado com Sucesso";
//         header("location: ../frontend/pages/usuarios.php");
//       } else {
//         $_SESSION["status"] = "Erro ao atualizar Usuario";
//         header("location: ../frontend/pages/usuarios.php");
//       }
//     } 

//   } else {


// }

// // Ativar Usuario
// if (isset($_POST['ativar_usuario'])) {
//   $id_usuario = $_POST['ativar_id'];

//   $query = "UPDATE usuario SET status = 1 WHERE idusuario='$id_usuario'";

//   $query_run = mysqli_query($conn, $query);

//   if ($query_run) {
//     $_SESSION["status"] = "Usuario Ativado com Sucesso";
//     header("location: ../frontend/pages/usuarios.php");
//   } else {
//     $_SESSION["status"] = "Erro";
//     header("location: ../frontend/pages/usuarios.php");
//   }
// }

// // Desativar Usuario
// if (isset($_POST['desativar_usuario'])) {
//   $id_usuario = $_POST['desativar_id'];

//   $query = "UPDATE usuario SET status = 0 WHERE idusuario='$id_usuario'";

//   $query_run = mysqli_query($conn, $query);

//   if ($query_run) {
//     $_SESSION["status"] = "Usuario Desativado com Sucesso";
//     header("location: ../frontend/pages/usuarios.php");
//   } else {
//     $_SESSION["status"] = "Erro";
//     header("location: ../frontend/pages/usuarios.php");
//   }
// }
