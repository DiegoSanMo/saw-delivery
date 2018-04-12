<?php
    $host_db="localhost";
    $usuario_db="root";
    //Contrasenia Karin
    $pass_db="Bankai123";
    //Contrasenia Diego
    //$pass_db="root";
    $db="saw";

    $conexion=new mysqli($host_db,$usuario_db, $pass_db);
    $conexion->set_charset("utf8");    

    mysqli_select_db($conexion, "saw");
    session_start();
    session_destroy(); 
    if(@$_POST['name']){
        $nombre = $_POST['name'];
        $contrasenia = $_POST['pass'];      
        
        
        $consultaSQL= "SELECT * FROM `delivery_man` WHERE `name` ='".$nombre."' AND `password` = '".$contrasenia."';";
        $resultados=mysqli_query($conexion, $consultaSQL);
        $row = mysqli_fetch_array($resultados);
        if($row['name'] == $nombre){
          session_start();
          $_SESSION['username']  = $nombre;
          $_SESSION['userId']  = $row['id'];
            echo "<script>window.history.pushState('', '', 'index.html');</script>";
            echo "<script>location.reload();</script>";
            //session_start(); //Star session
        }
        else{
            echo "<script>alert('usuario no regristrado');</script>";
           
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="bg-light mb-3" style="padding: 8rem;">
    <div class="container">
        <form action="login.php" method="POST">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card text-center">
                            <div class="card-header" style="background:#2E4052">
                                <h2 style="color:#FFFFFF">Login <span>Repartidores</span></h2>
                            </div>
                        </div>
                        <div class="card-body" style="background:#FFC857">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre: </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del repartidor">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contraseña: </label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>
                            <br>
                            <button type="submit" name="submit" class="btn btn-danger">Ingresar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>