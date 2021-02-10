<!doctype html>
<html lang="en">

<head>
  <title>CheckList</title>
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
          <li class="active">
            <a href="#">Checklist</a>
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
        <div class="container-fluid justify-content-center">LISTA DE CHECKLIST</div>
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
      <div class="modal fade" id="checklistmodal" tabindex="-1" aria-labelledby="checklistmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="checklistmodalLabel">Detalhes do CheckList</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <link rel="stylesheet" href="../css/style.css">

            <form action="#" method="POST">
              <div class="modal-body">

              <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="tipocheck">Tipo</label>
                    <input disabled type="text" id="tipocheck" name="tipocheck" class="form-control">
                  </div>
                  <div class="p-1">
                    <label for="">Data</label>
                    <input disabled type="text" id="data" name="data" class="form-control">
                  </div>
                </div>

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
                <div id="checkid">
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

          $query = "
          SELECT *
          FROM checklist AS cl
          INNER JOIN veiculo AS ve 
          ON cl.idveiculo = ve.idveiculo
          INNER JOIN usuario AS us 
          ON cl.idusuario = us.idusuario";

          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {

          ?>
              <tr>
                <td><a href="<?php echo $row['idchecklist']; ?>" class="detalhes_btn"><?php echo $row['idchecklist']; ?></a></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['tipochecklist']; ?></td>
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

        var id_checklist = $(this).attr("href")

        $.ajax({
          type: "POST",
          url: "../../backend/get_checklist.php",
          data: {
            'checking_checklist': true,
            'id_checklist': id_checklist
          },
          success: function(response) {
            console.log(response)
            var htmlchecklist = ''
            $.each(response, function(key, value) {
              $('#tipocheck').val(value['tipochecklist'])
              $('#data').val(value['data'])
              $('#nome').val(value['nome'])
              $('#cnh').val(value['cnh'])
              $('#categoria').val(value['categoria'])
              $('#modelo').val(value['modelo'])
              $('#marca').val(value['marca'])
              $('#placa').val(value['placa'])
              $('#ano').val(value['ano'])
              $('#cor').val(value['cor'])
              $('#roda').val(value['roda'])


              if(value['farois'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="">Farois</label>
                    <input disabled type="text" class="form-control text-success" value="${value['farois']}">
                  </div>
                  
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="">Farois</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['farois']}">
                  </div>
               
                  `
              }

              if(value['freio'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Freio</label>
                    <input disabled type="text" class="form-control text-success" value="${value['freio']}">
                  </div>
                  </div>  
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Freio</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['freio']}">
                  </div>
                  </div>  
                  `
              }
  

              if(value['freiodemao'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="">Freio de Mão</label>
                    <input disabled type="text" class="form-control text-success" value="${value['freiodemao']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex">
                  <div class="p-1">
                    <label for="">Freio de Mão</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['freiodemao']}">
                  </div>
                  `
              }

              if(value['lanternas'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Lanternas</label>
                    <input disabled type="text" class="form-control text-success" value="${value['lanternas']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Lanternas</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['lanternas']}">
                  </div>
                  </div>
                  `
              }

              if(value['lataria'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Lataria</label>
                    <input disabled type="text" class="form-control text-success" value="${value['lataria']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Lataria</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['lataria']}">
                  </div>
                  `
              }

              if(value['lparabrisa'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">luz de parabrisa</label>
                    <input disabled type="text" class="form-control text-success" value="${value['lparabrisa']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">luz de parabrisa</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['lparabrisa']}">
                  </div>
                  </div>
                  `
              }


              if(value['luzdere'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Luz de Ré</label>
                    <input disabled type="text" class="form-control text-success" value="${value['luzdere']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Luz de Ré</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['luzdere']}">
                  </div>
                  `
              }

              if(value['luzinterior'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Luz Interior</label>
                    <input disabled type="text" class="form-control text-success" value="${value['luzinterior']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Luz Interior</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['luzinterior']}">
                  </div>
                  </div>
                  `
              }


              if(value['painel'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Painel</label>
                    <input disabled type="text" class="form-control text-success" value="${value['painel']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Painel</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['painel']}">
                  </div>
                  `
              }

              if(value['pneus'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Pneus</label>
                    <input disabled type="text" class="form-control text-success" value="${value['pneus']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Pneus</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['pneus']}">
                  </div>
                  </div>
                  `
              }

              if(value['retrovisor'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Retrovisor</label>
                    <input disabled type="text" class="form-control text-success" value="${value['retrovisor']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Retrovisor</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['retrovisor']}">
                  </div>
                  `
              }

              if(value['setas'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Seta</label>
                    <input disabled type="text" class="form-control text-success" value="${value['setas']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Seta</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['setas']}">
                  </div>
                  </div>
                  `
              }


              if(value['volante'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Volante</label>
                    <input disabled type="text" class="form-control text-success" value="${value['volante']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Volante</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['volante']}">
                  </div>
                  `
              }

              if(value['vidroel'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Vidro Eletrico</label>
                    <input disabled type="text" class="form-control text-success" value="${value['vidroel']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Vidro Eletrico</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['vidroel']}">
                  </div>
                  </div>
                  `
              }


              if(value['alarme'] === "ok"){
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Alarme</label>
                    <input disabled type="text" class="form-control text-success" value="${value['alarme']}">
                  </div>
                  `
              }else{
                htmlchecklist += `
                <div class="form-group d-flex" >
                  <div class="p-1">
                    <label for="">Alarme</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['alarme']}">
                  </div>
                  `
              }

              if(value['buzina'] === "ok"){
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Buzina</label>
                    <input disabled type="text" class="form-control text-success" value="${value['buzina']}">
                  </div>
                  </div>
                  `
              }else{
                htmlchecklist += `
                  <div class="p-1">
                    <label for="">Buzina</label>
                    <input disabled type="text" class="form-control text-danger" value="${value['buzina']}">
                  </div>
                  </div>
                  `
              }
            
            });

            $('#checkid').html(htmlchecklist);

            $('#checklistmodal').modal('show')
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