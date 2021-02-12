<!doctype html>
<html lang="en">

<head>
    <title>:: Relatórios ::</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        /* Hide horizontal scrollbar */
        background-color: #FAFAFA;
    }
    </style>
</head>

<body>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Motorista</th>
                <th>Tipo</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        <?php
include '../../backend/conect.php';
session_start();

$conn = OpenCon();


$query = "select a.idabastece,a.data,a.tipocombustivel,a.nrequisicao,a.kmatual,a.idveiculo,a.idusuario,u.idusuario,u.nome,u.cnh,u.categoria,v.tipo,v.idveiculo,v.marca,v.modelo,v.ano,v.cor,v.roda,v.placa from abastece as a
inner join usuario as u
on a.idusuario=u.idusuario
inner join veiculo as v
on a.idveiculo=v.idveiculo";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)){
    $id = $row["idabastece"];
    $data = $row["data"];
    $tipocombustivel = $row["tipocombustivel"];
    $marca = $row["marca"];
    $nome = $row["nome"];
    $modelo =  $row["modelo"];
    echo "
        <tr>
        <td>".$id."</td>
        <td>".$marca."</td>
        <td>".$modelo."</td>
        <td>".$nome."</td>
        <td>".$tipocombustivel."</td>
        <td>".$data."</td>
        </tr>
    ";
}
?>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Motorista</th>
              <th>Tipo</th>
              <th>Data</th>
            </tr>
          </tfoot>
        </table>
      </main>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#example').DataTable();
      });
    </script>  
  </div>
  <script src="../js/main.js"></script>
 
</body>

</html>