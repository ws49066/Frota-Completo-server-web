<?php
include 'conect.php';
session_start();

$conn = OpenCon();


// Criar USUARIO
if (isset($_POST['salvar_usuario'])) {

  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  $nome = $_POST['nome'];
  $check = $_POST['colorCheckbox'];
  $cnh = $_POST['cnh'];
  $categoria = $_POST['categoria'];
  $veiculosLivres = $_POST['veiculosLivres'];


  if (isset($check)) {
    $query = "INSERT INTO usuario (login,senha,nome,status,cnh,categoria,idveiculo) VALUES('$usuario','$password','$nome',1,'$cnh','$categoria','$veiculosLivres')";
    $query_run = mysqli_query($conn, $query);

    $queryUpdateVeiculo = "UPDATE veiculo SET status=1 WHERE idveiculo='$veiculosLivres'";
    $query_runner = mysqli_query($conn, $queryUpdateVeiculo);


    if ($query_run) {
      $_SESSION["status"] = "Usuario Cadastrado com Sucesso";
      header("location: ../frontend/pages/usuarios.php");
    } else {
      $_SESSION["status"] = "Erro ao cadastra Usuario";
      header("location: ../frontend/pages/usuarios.php");
    }
  } else {
    $query = "INSERT INTO usuario (login,senha,nome,status) VALUES('$usuario','$password','$nome',1)";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
      $_SESSION["status"] = "Usuario Cadastrado com Sucesso";
      header("location: ../frontend/pages/usuarios.php");
    } else {
      $_SESSION["status"] = "Erro ao cadastra Usuario";
      header("location: ../frontend/pages/usuarios.php");
    }
  }
}

// Editar Usuario
if (isset($_POST['checking_Editbtn'])) {
  $s_id = $_POST['usuario_id'];

  $result_array = [];

  $query = "SELECT * FROM usuario where idusuario='$s_id'";
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
if (isset($_POST['update_usuario'])) {
  $id_usuario = $_POST['edit_id'];
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  $nome = $_POST['nome'];

  if (isset($_POST['idveiculoOld'])) {
    $cnh = $_POST['cnh'];
    $veiculoOld = $_POST['idveiculoOld'];
    $categoria = $_POST['categoria'];
    $veiculosLivres = $_POST['veiculosLivres'];

    if($veiculosLivres == $veiculoOld || $veiculosLivres == ''|| empty($veiculosLivres)){
      $query = "UPDATE usuario SET nome ='$nome',senha = '$password', login='$usuario', cnh='$cnh',
      categoria = '$categoria' WHERE idusuario='$id_usuario'";

      $query_run = mysqli_query($conn, $query);

      if ($query_run) {
        $_SESSION["status"] = "Usuario Atualizado com Sucesso";
        header("location: ../frontend/pages/usuarios.php");
      } else {
        $_SESSION["status"] = "Erro ao Atualizar Usuario";
        header("location: ../frontend/pages/usuarios.php");
      }

    }else{
      $query = "UPDATE usuario SET nome ='$nome',senha = '$password', login='$usuario', cnh='$cnh',
      categoria = '$categoria', idveiculo='$veiculosLivres' 
      WHERE idusuario='$id_usuario'";

      $queryVeiculoMudaLivre = "UPDATE veiculo SET status=0 WHERE idveiculo = '$veiculoOld'";
      $queryVeiculoMudaOcupado = "UPDATE veiculo SET status=1 WHERE idveiculo ='$veiculosLivres'";

      $query_run = mysqli_query($conn, $query);
      $query_run2 = mysqli_query($conn, $queryVeiculoMudaLivre);
      $query_run3 = mysqli_query($conn, $queryVeiculoMudaOcupado);

      if ($query_run && $query_run2 && $query_run3) {
        $_SESSION["status"] = "Usuario Atualizado com Sucesso";
        header("location: ../frontend/pages/usuarios.php");
      } else {
        $_SESSION["status"] = "Erro ao atualizar Usuario";
        header("location: ../frontend/pages/usuarios.php");
      }
    } 

  } else {

    $query = "UPDATE usuario SET nome ='$nome',senha = '$password', login='$usuario' WHERE idusuario='$id_usuario'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
      $_SESSION["status"] = "Usuario Atualizado com Sucesso";
      header("location: ../frontend/pages/usuarios.php");
    } else {
      $_SESSION["status"] = "Erro ao cadastra Usuario";
      header("location: ../frontend/pages/usuarios.php");
    }
  }
}

// Ativar Usuario
if (isset($_POST['ativar_usuario'])) {
  $id_usuario = $_POST['ativar_id'];

  $query = "UPDATE usuario SET status = 1 WHERE idusuario='$id_usuario'";

  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    $_SESSION["status"] = "Usuario Ativado com Sucesso";
    header("location: ../frontend/pages/usuarios.php");
  } else {
    $_SESSION["status"] = "Erro";
    header("location: ../frontend/pages/usuarios.php");
  }
}

// Desativar Usuario
if (isset($_POST['desativar_usuario'])) {
  $id_usuario = $_POST['desativar_id'];

  $query = "UPDATE usuario SET status = 0 WHERE idusuario='$id_usuario'";

  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    $_SESSION["status"] = "Usuario Desativado com Sucesso";
    header("location: ../frontend/pages/usuarios.php");
  } else {
    $_SESSION["status"] = "Erro";
    header("location: ../frontend/pages/usuarios.php");
  }
}
