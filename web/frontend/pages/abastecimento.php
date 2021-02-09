<!doctype html>
<html lang="en">

<head>
  <title>Abastecimento</title>
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
          <li class="active">
            <a href="#">Abastecimento</a>
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
        <div class="container-fluid justify-content-center">LISTA DE ABASTECIMENTO</div>
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

      <!-- Modal Veiculo-->
      <div class="modal fade" id="abastecemodal" tabindex="-1" aria-labelledby="abastecemodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="abastecemodalLabel">Detalhes do Abastecimento</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="#" method="POST">
              <div class="modal-body">
          
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="nome">Nome</label>
                    <input disabled type="text" id="nome" name="nome" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">CNH</label>
                    <input disabled type="text" id="cnh" name="cnh" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Categoria</label>
                    <input disabled type="text" id="categoria" name="categoria" class="form-control">
                  </div>
                </div>
                <div style="border-bottom: 1px solid gray;">
                </div>

                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="nome">Modelo</label>
                    <input disabled type="text" id="modelo" name="modelo" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Marca</label>
                    <input disabled type="text" id="marca" name="marca" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Placa</label>
                    <input disabled type="text" class="form-control" id="placa">
                  </div>
                </div>
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="nome">Ano</label>
                    <input disabled type="text" id="ano" name="ano" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Cor</label>
                    <input disabled type="text" id="cor" name="cor" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Roda</label>
                    <input disabled type="text" class="form-control" id="roda">
                  </div>
                </div>
                <div style="border-bottom: 1px solid gray;">
                </div>
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="nome">N.Requisição</label>
                    <input disabled type="text" id="nrequisicao" name="nrequisicao" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Tipo Combustivel</label>
                    <input disabled type="text" id="tipocombustivel" name="tipocombustivel" class="form-control">
                  </div>
                </div>
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="nome">KM ATUAL</label>
                    <input disabled type="text" id="kmatual" name="kmatual" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">DATA</label>
                    <input disabled type="text" id="data" name="data" class="form-control">
                  </div>
                </div>
                <div class="form-group d-flex" id="fotos">
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
            <th scope="col">Motorista</th>
            <th scope="col">Tipo</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../../backend/conect.php';
          session_start();

          $conn = OpenCon();

          $query = "select a.idabastece,a.data,a.tipocombustivel,a.nrequisicao,a.kmatual,a.idveiculo,a.idusuario,
          u.idusuario,u.nome,u.cnh,u.categoria,
          v.tipo,v.idveiculo,v.marca,v.modelo,v.ano,v.cor,v.roda,v.placa 
          from abastece as a
          inner join usuario as u
          on a.idusuario=u.idusuario
          inner join veiculo as v
          on a.idveiculo=v.idveiculo";

          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {

          ?>
              <tr>
                <td><a href="<?php echo $row['idabastece']; ?>" class="detalhes_btn"><?php echo $row['idabastece']; ?></a></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['tipocombustivel']; ?></td>
                <td><?php echo $row['data']; ?></td>
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

      $('.detalhes_btn').click(function(e) {
        e.preventDefault();

        var id_abastece = $(this).attr("href")

        $.ajax({
          type: "POST",
          url: "../../backend/get_abastece.php",
          data: {
            'checking_abastece': true,
            'id_abastece': id_abastece
          },
          success: function(response) {
            console.log(response)
            $.each(response, function(key, value) {
              $('#nome').val(value['nome'])
              $('#cnh').val(value['cnh'])
              $('#categoria').val(value['categoria'])
              $('#modelo').val(value['modelo'])
              $('#marca').val(value['marca'])
              $('#placa').val(value['placa'])
              $('#ano').val(value['ano'])
              $('#cor').val(value['cor'])
              $('#roda').val(value['roda'])
              $('#nrequisicao').val(value['nrequisicao'])
              $('#tipocombustivel').val(value['tipocombustivel'])
              $('#kmatual').val(value['kmatual'])
              $('#data').val(value['data'])
            });

            idtrue()

          }
        })


        function idtrue() {
          $.ajax({
            type: "POST",
            url: "../../backend/get_abastece.php",
            data: {
              'checking_abastece_fotos': true,
              'id_abastece': id_abastece
            },
            success: function(response) {
              console.log(response)
              var htmlFotos = ''

              for (var count = 0; count < response.length; count++) {
                  htmlFotos += `
                  <div class="p-1">
                  <a href="http://177.91.234.230:8888/frota/src/img/abastecimento/${response[count].path}" target="_blank">
                    <img src="http://177.91.234.230:8888/frota/src/img/abastecimento/${response[count].path}" width="100" height="100">
                  </a>
                  </div>
                  `
              }

              console.log('fotos ='+htmlFotos)

              $('#fotos').html(htmlFotos);
         
              $('#abastecemodal').modal('show')

            }
          })
        }

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