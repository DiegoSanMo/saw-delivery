<?php
  
  $host_db="localhost";
  $usuario_db="root";
  $pass_db="Bankai123";
  $db="saw";

  $conexion=new mysqli($host_db,$usuario_db, $pass_db);
  $conexion->set_charset("utf8");    
  mysqli_select_db($conexion, "saw");  

  session_start();
  if(@$_SESSION['username']){
  $nombre = $_SESSION['username'];
  $id = $_SESSION['userId'];

  $valores = "SELECT COUNT(*) from sales WHERE `status` = 0";
  $lector = mysqli_query($conexion, $valores);
  $shoppingCartRow = mysqli_fetch_array($lector);

  $valores = "SELECT COUNT(*) from delivery_order WHERE idDeliveryMan = $id";
  $lectore = mysqli_query($conexion, $valores);
  $saleRow = mysqli_fetch_array($lectore);
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

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

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
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> salir</a>
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
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <!-- /.row -->
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-lg-5 col-md-5">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $shoppingCartRow[0]; ?></div>
                                    <div>Pedidos pendientes!</div>
                                </div>
                            </div>
                        </div>
                        <a href="tables.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver pedidos</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $saleRow[0]; ?></div>
                                    <div>Pedidos entregados!</div>
                                </div>
                            </div>
                        </div>
                        <a href="sales-history.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver pedidos</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- /.row -->
            <div class="container">                
                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Pedidos urgentes por entregar!
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
                                  foreach ($conexion->query('SELECT * from sales WHERE `status` = 0  ORDER BY id ASC LIMIT 0,7;') as $row){    
                                    $valores = "SELECT * from shopping_cart WHERE id = ".$row['idShoppingCart'].";";
                                    $lector = mysqli_query($conexion, $valores);
                                    $shoppingCartRow = mysqli_fetch_array($lector);

                                    $valores = "SELECT * from clients WHERE id = ".$shoppingCartRow['idClient'].";";
                                    $lectore = mysqli_query($conexion, $valores);
                                    $clientRow = mysqli_fetch_array($lectore);
                                ?>	

                                    <tr class="odd gradeX">
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td class="center"><?php echo $clientRow['address']; ?></td>
                                        <td class="text-center"><a href='detail.php?id=<?php echo $row['id'];?>' class="btn btn-info">Ver venta</a></td>
                                        <td class='text-center'><a href='sale.php?id=<?php echo $row['id'];?>' class='btn btn-success'>Generar entrega</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.list-group -->
                            <!-- <a href="tables.php" class="btn btn-default btn-block">Ver todos los pedidos</a> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
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

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php } 
else {
  echo "<script>window.history.pushState('', '', '../login.php');</script>";  
  echo "<script>location.reload();</script>"; 
}?>
