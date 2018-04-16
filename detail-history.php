<?php
  
  $host_db="localhost";
  $usuario_db="root";
  $pass_db="root";
  $db="saw";

  $conexion=new mysqli($host_db,$usuario_db, $pass_db);
  $conexion->set_charset("utf8");    
  mysqli_select_db($conexion, "saw");  

  session_start();
  if(@$_SESSION['username']){
  $nombre = $_SESSION['username'];
  $idUser = $_SESSION['userId'];

  $id = $_GET['id'];
  if(@$_GET['idSave']){
    $idSave = $_GET['idSave'];
    date_default_timezone_set('America/Monterrey');
    $date = date('Y-m-d', time());

  }
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
                <div class="col-lg-12">
                  <br>
                    <?php       
                    $valores = "SELECT * from sales WHERE id = ".$id.";";
                    $lecto = mysqli_query($conexion, $valores);
                    $saleRow = mysqli_fetch_array($lecto);

                    $valores = "SELECT * from shopping_cart WHERE id = ".$id.";";
                    $lector = mysqli_query($conexion, $valores);
                    $shoppingCartRow = mysqli_fetch_array($lector);

                    $valores = "SELECT * from clients WHERE id = ".$shoppingCartRow['idClient'].";";
                    $lectore = mysqli_query($conexion, $valores);
                    $clientRow = mysqli_fetch_array($lectore);
                  ?>
                  <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                           <strong><h4>Datos generales de la venta</h4></strong> 
                        </div>
                        <table width="100%" class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" width="30%">No. pedido</th>
                                    <th><?php echo $id; ?></th>
                                    
                                </tr>
                                <tr>
                                    <th scope="row" width="30%">Fecha</th>
                                    <td><?php echo $saleRow['date']; ?></td>
                                    
                                </tr>
                                <tr>
                                    <th scope="row" width="30%">Cliente</th>
                                    <td><?php echo $clientRow['username']; ?></td>
                                    
                                </tr>
                                <tr>
                                    <th scope="row" width="30%">Domicilio</th>
                                    <td><?php echo $clientRow['address']; ?></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <br>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Productos de la venta
                       </div>
                       <!-- /.panel-heading -->
                       <div class="panel-body">
                       <table width="100%" class="table table-striped table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th></th>
                                   <th>Producto</th>
                                   <th>Precio</th>
                                   <th>Cantidad</th>
                                   <th>Total</th>
                               </tr>
                           </thead>      
                           <tbody>
                             <?php
                                $total = 0;
                                foreach ($conexion->query('SELECT * from sales_details WHERE idSale = '.$id.';') as $row){    
                                  $valores = "SELECT * from products WHERE id = ".$row['idProduct'].";";
                                  $lectore = mysqli_query($conexion, $valores);
                                  $productRow = mysqli_fetch_array($lectore);
                                  $summary = $summary + $row['price'] * $row['quantity'];
                                  
                              ?>	
                  
                              <tr class="odd gradeX">
                                <td class="">
                                  <div class="cart-img-product b-rad-4 o-f-hidden text-center">
                                  <?php echo "<img src='../../saw-admin/images/products/".$productRow['image']."' style='width:100px' alt='100px'>";?> 
                                  </div>
                                </td>

                                <td class="">
                                  <span class="block2-id2" style="opacity: 0;"><?php echo $productRow['id']; ?></span>
                                  <?php echo $productRow['name']; ?>
                                </td>

                                <td class="">$<?php echo $row['price']; ?></td>

                                <td class="">
                                  <?php echo $row['quantity']; ?>
                                  <?php $total = $total + $row['price'] * $row['quantity']; ?> 
                                </td>                                

                                <td class="">$<?php echo $row['price'] * $row['quantity'];?></td>
                              </tr>
                              <tr>
                              </tr>
                              <?php } ?>                            
                            </tbody>                     
                          </table>
                          <div class="text-center">
                          <h4>Total $ <strong><?php echo $summary?></strong></h4>
                          <td class='text-center'><a href='sales-history.php' class='btn btn-success'>Regresar</a></td>
                          </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>          
        </div>

       <br>
        
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
    }
  ?> 