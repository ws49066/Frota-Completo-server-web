<?php session_start() ?>
<!doctype html>
<html lang="en">

<head>
  <title>:: Usuários ::</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <style>
    .box {

      display: none;

    }
  </style>
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
          <li>
            <a href="./veiculos.php">Veiculos</a>
          </li>
          <li class="active">
            <a href="#">Usuarios</a>
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
          LISTA DE USUARIOS
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
        + Novo Usuario
      </button>
      <!-- Button trigger modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dados Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">
            <form action="../../backend/createUser.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input required type="text" name="nome" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Login</label>
                  <input type="text" name="usuario" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Senha</label>
                  <input required type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <label><input type="checkbox" name="colorCheckbox" value="true"> Motorista</label>
                </div>

                <div class="form-group">
                  <div class="true box">
                    <label for="">CNH</label>
                    <input type="number" name="cnh" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="true box">
                    <label for="">Categoria</label>
                    <select class="form-select" name="categoria">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="true box">
                    <label for="">Veiculo</label>
                    <select name="veiculosLivres" id="veiculosLivres" class="form-select input-lg">

                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="salvar_usuario">Salvar</button>
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

            <form action="../../backend/createUser.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" id="edit_name" name="nome" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Login</label>
                  <input type="text" id="edit_usuario" name="usuario" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Senha</label>
                  <input type="password" id="edit_senha" name="password" class="form-control">
                </div>
                <div id="editUsuario">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" name="update_usuario">Atualizar</button>
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
            <th scope="col">Nome</th>
            <th scope="col">Login</th>
            <th scope="col">Senha</th>
            <th scope="col">Categoria</th>
            <th scope="col">CNH</th>
            <th scope="col">Veiculo</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../../backend/conect.php';
          session_start();

          $conn = OpenCon();

          $query = "SELECT * from usuario";

          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
              $query_veiculo = "SELECT * from veiculo where idveiculo = '$row[idveiculo]'";
              $result_veiculo = mysqli_query($conn, $query_veiculo);
              if (mysqli_num_rows($result_veiculo)) {
                foreach ($result_veiculo as $modelo) {
                  $modelo_veiculo = $modelo['modelo'];
                }
              } else {
                $modelo_veiculo = "----------";
              }
          ?>
              <tr>
                <td class="usuario_id"><?php echo $row['idusuario']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['login']; ?></td>
                <td><?php echo $row['senha']; ?></td>
                <td><?php echo $row['categoria']; ?></td>
                <td><?php echo $row['cnh']; ?></td>
                <td><a href="<?php echo $row['idveiculo']; ?>" class="detalhes_btn"><?php echo $modelo_veiculo; ?></td>
                <td>
                  <a href="#" class="badge badge-info edit_btn">EDITAR</a>
                  <?php
                  if ($row['status']) {
                    echo '<a href="#" class="badge badge-danger desativar_btn">DESATIVAR</a>';
                  } else {
                    echo '<a href="#" class="badge badge-success ativar_btn">ATIVAR</a>';
                  }
                  ?>

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

      $('input[type="checkbox"]').click(function() {
        var inputValue = $(this).attr("value");
        var n = $('input[type="checkbox"]:checked').length;

        if (n) {
          $('input[name="cnh"]').prop('required', true);
          console.log('ligado')
        } else {
          $('input[name="cnh"]').prop('required', false);
          console.log('Desligado')
        }

        $("." + inputValue).toggle();
      });

      $('.edit_btn').click(function(e) {
        e.preventDefault()

        var usuario_id = $(this).closest('tr').find('.usuario_id').text();
        var id_veiculo = '---'
        var cnh = '---'
        var categoria = '---'

        $.ajax({
          type: "POST",
          url: "../../backend/createUser.php",
          data: {
            'checking_Editbtn': true,
            'usuario_id': usuario_id,
          },
          success: function(response) {
            console.log(response)
            $.each(response, function(key, value) {
              id_veiculo = value['idveiculo']
              cnh = value['cnh']
              categoriaUser = value['categoria']
              $('#edit_id').val(value['idusuario'])
              $('#edit_name').val(value['nome'])
              $('#edit_usuario').val(value['login'])
              $('#edit_senha').val(value['senha'])
            });

            if (id_veiculo === null) {
              var htmlReturn = ''

              $('#editUsuario').html(htmlReturn);


              $('#editarmodal').modal('show')
            } else {

              idtrue()
            }
          }
        })


        function idtrue() {
          $.ajax({
            type: "POST",
            url: "../../backend/veiculo.php",
            data: {
              'veiculoslivres': true,
              'idveiculousado': id_veiculo
            },
            success: function(response) {
              console.log(response)
              var htmlReturn = `
                  <input type="hidden" name="idveiculoOld" value="${id_veiculo}">
                  <div class="form-group">
                      <label for="">CNH</label>
                      <input type="number" name="cnh" class="form-control" value="${cnh}">
                  </div>`

              var categoria = ['A', 'B', 'AB', 'C', 'D', 'E']

              htmlReturn += `
                  <div class="form-group">
                      <label for="">Categoria</label>
                      <select class="form-select" name="categoria">`

              categoria.forEach(item => {
                if (item === categoriaUser) {
                  htmlReturn += '<option value="' + item + '" disabled selected>' + item + '</option>';
                } else {
                  htmlReturn += '<option value="' + item + '">' + item + '</option>';
                }

              })
              htmlReturn += `
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="">Veiculo</label>
                      <select name="veiculosLivres" id="veiculosLivres" class="form-select input-lg">
                     `

              for (var count = 0; count < response.length; count++) {
                if (response[count].id === id_veiculo) {
                  htmlReturn += '<option value="' + response[count].id + '" disabled selected>' + response[count].marca + ' - ' + response[count].modelo + ' - "' + response[count].placa + '" - ' + response[count].ano + '</option>';
                } else {
                  htmlReturn += '<option value="' + response[count].id + '">' + response[count].marca + ' - ' + response[count].modelo + ' - "' + response[count].placa + '" - ' + response[count].ano + '</option>';
                }
              }

              htmlReturn += `</select>
                  </div>`

              $('#editUsuario').html(htmlReturn);

              $('#editarmodal').modal('show')

            }
          })
        }

      })

      $('.ativar_btn').click(function(e) {
        e.preventDefault();

        var usuario_id = $(this).closest('tr').find('.usuario_id').text();

        $('#ativar_id').val(usuario_id)

        $('#ativarmodal').modal('show')

        console.log(usuario_id)
      })


      $('.novo_btn').click(function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "../../backend/veiculo.php",
          data: {
            'veiculoslivres': true
          },
          success: function(response) {
            var html = ''

            for (var count = 0; count < response.length; count++) {
              html += '<option value="' + response[count].id + '">' + response[count].marca + ' - ' + response[count].modelo + ' - "' + response[count].placa + '" - ' + response[count].ano + '</option>';
            }
            $('#veiculosLivres').html(html);


            $('#exampleModal').modal('show')
          }
        })
      })


      $('.desativar_btn').click(function(e) {
        e.preventDefault();

        var usuario_id = $(this).closest('tr').find('.usuario_id').text();

        $('#desativar_id').val(usuario_id)

        $('#desativarmodal').modal('show')

        console.log(usuario_id)
      })

      $('.detalhes_btn').click(function(e) {
        e.preventDefault();

        var id_veiculo = $(this).attr("href")

        $.ajax({
          type: "POST",
          url: "../../backend/veiculo.php",
          data: {
            'checking_veiculo': true,
            'id_veiculo': id_veiculo
          },
          success: function(response) {
            $.each(response, function(key, value) {
              $('#marca').val(value['marca'])
              $('#modelo').val(value['modelo'])
              $('#cor').val(value['cor'])
              $('#placa').val(value['placa'])
              $('#ano').val(value['ano'])
              $('#roda').val(value['roda'])
            });

            $('#veiculomodal').modal('show')
          }
        })
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