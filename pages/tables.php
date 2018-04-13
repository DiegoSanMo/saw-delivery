<?php
  
  $host_db="localhost";
  $usuario_db="root";
  //Contrasenia Karin
  //$pass_db="Bankai123";
  //Contrasenia Diego
  $pass_db="root";
  $db="saw";

  $conexion=new mysqli($host_db,$usuario_db, $pass_db);
  $conexion->set_charset("utf8");    
  mysqli_select_db($conexion, "saw");  

  session_start();
  if(@$_SESSION['username']){
  $nombre = $_SESSION['username'];
  $id = $_SESSION['userId'];
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../assets/images/letras.png" alt="" style="width: 150px"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">                
                <!-- /.dropdown -->
                <li><?php echo $nombre; ?></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                        </li>                        
                        <li>
                            <a href="tables.php"><i class="fa fa-table fa-fw"></i> Pedidos</a>
                        </li>     
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-header">Consulta de pedidos a entregar</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Número de venta</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Dirección</th>
                                        <th>Ver venta</th>
                                        <th>Generar entrega de pedido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($conexion->query('SELECT * from sales WHERE `status` = 0 ;') as $row){    
                                        $valores = "SELECT * from shopping_cart WHERE id = ".$row['idShoppingCart'].";";
                                        $lector = mysqli_query($conexion, $valores);
                                        $shoppingCartRow = mysqli_fetch_array($lector);

                                        $valores = "SELECT * from clients WHERE id = ".$shoppingCartRow['idClient'].";";
                                        $lectore = mysqli_query($conexion, $valores);
                                        $clientRow = mysqli_fetch_array($lectore);
                                    ?>	

                                        <tr class="odd gradeX">
                                            <td id="id"><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td class="center"><?php echo $clientRow['address']; ?></td>
                                            <td class="text-center"><a href="" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" id="idSale">Ver venta</a></td>
                                            <td class='text-center'><a href='sale.php?id=<?php echo $row['id'];?>' class='btn btn-success' name='buttons'>Generar entrega</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><h2 class="text-center">Detalle de venta</h2></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <script> 
                                            var final;
                                            $('.btn-info').each(function(){
                                                var id = $(this).parent().parent().find('#id').html();      
                                                    $(this).on('click', function(){       
                                                        console.log(id)  
                                                        final = id
                                                        
                                                    });
                                            });
                                        </script> -->
                                        <?php
                                            $variablePHP;
                                            echo $variablePHP;
                                            foreach ($conexion->query("SELECT `idSale`, `name`, `quantity`, `price` FROM `sales_details` INNER JOIN `products` ON products.id = sales_details.idProduct WHERE idSale= ".$variablePHP.";") as $row){    
                                            $total = $total + $row['price'];

                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['name']; ?></th>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>    
                                <div class="text-center">Total de venta: $<strong> <?php echo "$total" ?></strong></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

<?php } 
else {
  echo "<script>window.history.pushState('', '', '../login.php');</script>";  
  echo "<script>location.reload();</script>"; 
}?>
