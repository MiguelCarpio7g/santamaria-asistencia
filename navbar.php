<?php
		if (isset($title))
		{

	?>

<nav class="navbar navbar-default ">
  <div class="">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--VENTANA DESPLEGABLE-->
  <ul class="nav navbar-nav">
<!--------------------------------------------->
  <li class="<?php echo $active_inicio;?>"><a href="inicio.php"><i class='glyphicon glyphicon-home'></i> Inicio</a></li>
<!--------------------------------------------->




</li>
	

<!--------------------------------------------->
	


<!--------------------------------------------->
 

<!--------------------------------------------->
	 <li class="<?php echo $active_usuarios;?>" id="UIN"><a href=""><i  class='glyphicon glyphicon-time'></i> Registro de Asistencias</a>
	 <ul class="noneUI">
<li><a href="usuarios.php">Registrar asistencia</a></li>

</ul>

	</li>
<!--------------------------------------------->
<li class="<?php echo $active_usuarios2;?>" id="UIN"><a href=""><i  class='glyphicon glyphicon-list-alt'></i> Empleados</a>
	 <ul class="noneUI">
<li><a href="usuarios2.php">Asistencia Empleados</a></li>
<li><a href="usuarios3.php">Registrar Empleados</a></li>

</ul>

	</li>

<!--------------------------------------------->


<!--------------------------------------------->
<!--------------------------------------------->


<!--------------------------------------------->


       </ul>
			 		<!--el usuario logueado-->

<?php

/* conectar a base de datos*/
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

//session_start();
if( !isset($_SESSION['cedula_usu'])){
	header("Location: login.php");
//	exit;
}

//if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
//			header("location: login.php");
//	exit;
	//		}
$cedula_usu= $_SESSION['cedula_usu'];

$sql="SELECT ced_empleado, nombre_empleado, apellido_empleado, rol_empleado FROM tbl_empleados
 where ced_empleado='$cedula_usu'";
 $resultado=$con->query($sql);
 $row= $resultado->fetch_assoc();
 $rol=$row['rol_empleado'];
 if ($rol=="2"){$rol_usu="Admin";}
 else {$rol_usu="Empleado";}
 ?>
   <ul class="nav navbar-nav navbar-right">
        
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
	  


	<ul class="SINTEXT">
 <li class="<?php ?>"><a href=""> <i  class=''></i> 	 <?php
		 echo "Bienvenid@: " . explode(' ', $row['nombre_empleado'])[0] . " " .
     explode(' ', $row['apellido_empleado'])[0] . " - " . $rol_usu; ?></a></li>
   
   </ul>
   
			<!--el usuario logueado-->

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
	<?php
		}

	?>
