<!--
* Copyright 2018 Jhonatan cardona

//Chiphysi programación suscribete
//V 0.1 original
//Autor: Chiphysi  Autor: Jhonatan Cardona
//Derechos de autor(Suscribete)


-->

<?php
	session_start();

	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
				// load the login class
				require_once("classes/Login.php");


				/* Conectar a la base de datos*/
				require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
				require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	
	$active_usuarios="";
	$active_inicio="active";
	$title="Inicio";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>

<style>



body {

	background-image: url("img/pasillo.jpg");
	background-repeat: no-repeat;
	background-size: cover;
}

</style>


  <body  >

	<?php
	include("navbar.php");
	?>
    <div class="container">

<center>

	<br>
		<br>
			<br>
				<br>
					<br>

<center>
	<h3>Bienvenidos al Sistema de Registro de Asistencia</h3>
		<h2>Del Hospital Santamaria</h2>
		<p></p>
		<!------------------------------------>
	 
					 <center>
			 				<?php
			 			
							?>
			 		</center>


			<img src="" width="200">
</button>


<!------------------------------------>

	<!-- <a href="ventas.php"><button class="btn btn"><font size="3"
		  face="Cambrian" color="black">VENTAS</font> -->

		 <center>
 				<?php
 			/*	$query=mysqli_query($con, "select SUM(total_ven) from tbl_ventas where estado_ven= '1'");
 				$count=mysqli_fetch_assoc($query);
 				//echo  $count['total_ven'];
				print "En caja  " . "$     " . array_sum($count);
 				//background= "img/granja.jpg"
 				?>
				<br>
				<?php
				$query=mysqli_query($con, "select SUM(total_ven) from tbl_ventas where estado_ven= '2'");
				$count=mysqli_fetch_assoc($query);
				//echo  $count['total_ven'];
				print "Pendiente  " . "$     " . array_sum($count);
				//background= "img/granja.jpg"  */
				?>
 		</center>



		 <img src="" width="200"></button>

<!------------------------------------>
	<!--	<a href="inventario.php"><button class="btn btn"><font size="3"
			 face="Cambrian" color="black">PRODUCTOS</font> -->
			<center>
 		 			<?php
 		 		/*	$query=mysqli_query($con, "select COUNT(*) as nombre_prod from tbl_productos ");
 		 			$count=mysqli_fetch_assoc($query);
 		 			echo  $count['nombre_prod'];
 		 			//background= "img/granja.jpg" */
 		 			?>
 		 	</center>
			<img src="" width="200"></button>


<!------------------------------------>

	<!--	<a href="clientes.php"><button class="btn btn">
			<font size="3" face="Cambrian" color="black">CLIENTES</font> -->
			<center>
					<?php
					/*$query=mysqli_query($con, "select COUNT(*) as nombre_cli from tbl_clientes ");
					$count=mysqli_fetch_assoc($query);
					echo  $count['nombre_cli']; */
					//background= "img/granja.jpg"
					?>
			</center>

			<img src="" width="200">
		</button>
<!------------------------------------>

<!------------------------------------>

		<br><br>
<!------------------------------------>


</center>


<center>

		<!------------------------------------>
	<!--  <a href="animales.php"><button class="btn btn"><font size="3"
			 face="Cambrian" color="black">ANIMALES</font>  -->
					 <center>
			 				<?php
			 			/*	$query=mysqli_query($con, "select COUNT(*) as nombre_ani from tbl_animales ");
			 				$count=mysqli_fetch_assoc($query);
			 				echo  $count['nombre_ani']; */
							//print "$     " . array_sum($count);
			 				//background= "img/granja.jpg"
			 				?>
			 		</center>


			<img src="" width="200">
</button>


<!------------------------------------>

	 <!--<a href="usuarios.php"><button class="btn btn"><font size="3"
		  face="Cambrian" color="black">USUARIOS</font> -->

		 <center>
 				<?php
 			/*	$query=mysqli_query($con, "select COUNT(*) as nombre_usu from tbl_usuarios ");
 				$count=mysqli_fetch_assoc($query);
 				echo  $count['nombre_usu']; */
			//	print "$     " . array_sum($count);
 				//background= "img/granja.jpg"
 				?>
 		</center>



		 <img src="" width="200"></button>

<!------------------------------------>
		<!--<a href="proveedores.php"><button class="btn btn"><font size="3"
			 face="Cambrian" color="black">PROVEEDORES</font> -->
			<center>
 		 			<?php
 		 		/*	$query=mysqli_query($con, "select COUNT(*) as nombre_pro from tbl_proveedores ");
 		 			$count=mysqli_fetch_assoc($query);
 		 			echo  $count['nombre_pro']; */
 		 			//background= "img/granja.jpg"
 		 			?>
 		 	</center>
			<img src="" width="200"></button>


<!------------------------------------>

<!------------------------------------>




</center>

	</div>

	<?php
	include("footer.php");

	?>

  </body>
</html>
