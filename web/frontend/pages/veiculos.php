<?php session_start() ?>
<!doctype html>
<html lang="en">

<head>
  <title>:: Veículos ::</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <a href="#" class="img logo" style="background-image: url(../images/frotalogoint.png);"></a>
        <ul class="list-unstyled components mb-5 mt-5">
          <li>
            <a href="./abastecimento.php">Abastecimento</a>
          </li>
          <li>
            <a href="./manutencao.php">Manutenção</a>
          </li>
          <li>
            <a href="./checklist.php">Checklist</a>
          </li>
          <li class="active">
            <a href="#">Veiculos</a>
          </li>
          <li>
            <a href="./usuarios.php">Usuarios</a>
          </li>
          <li>
            <a href="./relatorios.php">Relatorios</a>
          </li>
          <li>
            <a href="./sair.html">Sair</a>
          </li>
        </ul>
        <div class="footer d-flex justify-content-center">
          <p>powered by | NBS</p>
        </div>

      </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid justify-content-center">
          LISTA DE VEICULOS
        </div>
      </nav>


      <?php
      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>
            <?php echo $_SESSION['status'] ?>
          </strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
        unset($_SESSION['status']);
      }
      ?>

      <button type="button" class="btn btn-primary float-right ml-5 novo_btn">
        + Novo Veiculo
      </button>
      <!-- Button trigger modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dados Veículo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="../../backend/createVei.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nome">Tipo</label>
                  <select name="tipo" id="tipo" class="form-control">
                  <option value="Caminhao">Caminhão</option>
                  <option value="Caminhonete">Caminhonete</option>
                  <option value="Onibus">Ônibus</option>
                  <option value="Carro">Carro</option>
                  <option value="Moto">Moto</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Marca</label>
                  <input type="text" name="marca" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Modelo</label>
                  <input type="text" name="modelo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="cor">Cor</label>
                  <select name="cor" id="cor" class="form-control">
                  <option value="Amarelo">Amarela</option>
                  <option value="Azul">Azul</option>
                  <option value="Branca">Branca</option>
                  <option value="Prata">Prata</option>
                  <option value="Preta">Preta</option>
                  <option value="Verde">Verde</option>
                  <option value="Vermelha">Vermelha</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Ano</label>
                  <input type="text" name="ano" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Roda</label>
                  <input type="text" name="roda" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Placa</label>
                  <input type="text" name="placa" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="salvar_veiculo">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal EDITAR-->
      <div class="modal fade" id="editarmodal" tabindex="-1" aria-labelledby="editarmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editarmodalLabel">Dados Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="../../backend/createVei.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="form-group">
                  <label for="nome">Tipo</label>
                  <input type="text" id="edit_tipo" name="edit_tipo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Marca</label>
                  <input type="text" id="edit_marca" name="edit_marca" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Modelo</label>
                  <input type="text" id="edit_modelo" name="edit_modelo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Ano</label>
                  <input type="text" id="edit_ano" name="edit_ano" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Cor</label>
                  <input type="text" id="edit_cor" name="edit_cor"class="form-control" >
                </div>
                <div class="form-group">
                  <label for="">Roda</label>
                  <input type="text" id="edit_roda" name="edit_roda"class="form-control" >
                </div>
                <div class="form-group">
                  <label for="">Placa</label>
                  <input type="text" id="edit_placa" name="edit_placa"class="form-control" >
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="update_veiculo">Atualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Ativar-->
      <div class="modal fade" id="ativarmodal" tabindex="-1" aria-labelledby="ativarmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="../../backend/createUser.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="ativar_id" id="ativar_id">
                <h4>Deseja ativar o usuario?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="ativar_usuario">Ativar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Desativar-->
      <div class="modal fade" id="desativarmodal" tabindex="-1" aria-labelledby="desativarmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="desativarmodalLabel">Desativar Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="../../backend/createUser.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="desativar_id" id="desativar_id">
                <h4>Deseja Desativar o usuario?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="desativar_usuario">Desativar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Veiculo-->
      <div class="modal fade" id="veiculomodal" tabindex="-1" aria-labelledby="veiculomodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="veiculomodalLabel">Detalhes do Veiculo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="#" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nome">Marca</label>
                  <input disabled type="text" id="marca" name="marca" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Modelo</label>
                  <input disabled type="text" id="modelo" name="modelo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Cor</label>
                  <input disabled type="password" id="cor" name="cor" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Placa</label>
                  <input disabled type="text" class="form-control" id="placa">
                </div>
                <div class="form-group">
                  <label for="">Ano</label>
                  <input disabled type="text" class="form-control" id="ano">
                </div>
                <div class="form-group">
                  <label for="">Roda</label>
                  <input disabled type="text" class="form-control" id="roda">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              </div>
            </form>

          </div>
        </div>
      </div>


      <table class="table" id="example">

        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Placa</th>
            <th scope="col">Ano</th>
            <th scope="col">Cor</th>
            <th scope="col">Roda</th>
            <th scope="col">Status</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../../backend/conect.php';
          session_start();

          $conn = OpenCon();

          $query = "SELECT * from veiculo";

          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
          ?>
              <tr>
                <td class="veiculo_id"><?php echo $row['idveiculo']; ?></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['placa']; ?></td>
                <td><?php echo $row['ano']; ?></td>
                <td><?php echo $row['cor']; ?></td>
                <td><?php echo $row['roda']; ?></td>
                <?php
                if ($row['status']) {
                  $status =   $row['cnh'];
                  echo '<td class="text-danger"> OCUPADO </td>';
                } else {
                  echo '<td class="text-success"> LIVRE </td>';
                }
                ?>
                <td>
                  <a href="#" class="badge badge-info edit_btn">EDITAR</a>
                </td>
              </tr>
          <?php


            }
          } else {
            echo "Não foi encontrado";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>

  <script src="../js/main.js"></script>
  <script>
    $(document).ready(function() {

      $('.edit_btn').click(function(e) {
        e.preventDefault();

        var veiculo_id = $(this).closest('tr').find('.veiculo_id').text();

        $.ajax({
          type: "POST",
          url: "../../backend/createVei.php",
          data: {
            'checking_Editbtn': true,
            'veiculo_id': veiculo_id,
          },
          success: function(response) {
            console.log(response)
            $.each(response, function(key, value) {
              $('#edit_id').val(value['idveiculo'])
              $('#edit_tipo').val(value['tipo'])
              $('#edit_marca').val(value['marca'])
              $('#edit_modelo').val(value['modelo'])
              $('#edit_ano').val(value['ano'])
              $('#edit_cor').val(value['cor'])
              $('#edit_roda').val(value['roda'])
              $('#edit_placa').val(value['placa'])
            });

            $('#editarmodal').modal('show')
          }
        })
      })

      // $('.ativar_btn').click(function(e) {
      //   e.preventDefault();

      //   var usuario_id = $(this).closest('tr').find('.usuario_id').text();

      //   $('#ativar_id').val(usuario_id)

      //   $('#ativarmodal').modal('show')

      //   console.log(usuario_id)
      // })


      $('.novo_btn').click(function(e) {
        e.preventDefault();


        $('#exampleModal').modal('show')


      })
    })
  </script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>