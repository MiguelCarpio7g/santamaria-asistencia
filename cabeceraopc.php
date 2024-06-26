<?php
	/*-------------------------

	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Conectar a la base de datos*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_configuracion="active";
	$title="Configuraciones";


	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$cedula_usu= $_SESSION['cedula_usu'];

	$sql="SELECT cedula_usu, nombre_usu, rol_usu FROM tbl_usuarios
	 where cedula_usu='$cedula_usu'";
	 $resultado=$con->query($sql);
	 $row= $resultado->fetch_assoc();
	 $rol=$row['rol_usu'];
	 if ($rol=="2"){$rol_usu="Admin";}
	 else {$rol_usu="Vendedor";}

	 if ($rol=='3'){
  header("location: inicio.php");

	 }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
  <body>
	<?php
	include("navbar.php");
	?>
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
			<div class="btn-group pull-right">
									<!--	<a  href="nueva_factura_C.php" class="btn btn-info"><span class="" ></span> Realizar Compra de productos</a>-->
									</div>
									<!-------------------------------->
									<center>
		<div class="btn-group pull-center">
						<a  href="cabecera.php" class="btn btn-info"><span class="" ></span>Configurar cabecera de factura</a>
					</div>	</br>	</br>


		</center>

																		<!------------------->

			<!--<h4><i class='glyphicon glyphicon-tags'></i> Compras de productos Realizadas</h4> -->
			<form class="form-horizontal" role="form" id="datos_cotizacion">

					<div class="form-group row">
						<!--<label for="q" class="col-md-2 control-label">Cliente o # de factura</label>-->
						<div class="col-md-5">
						<!--	<input type="text" class="form-control" id="q" placeholder="Nombre del proveedor o # de factura" onkeyup='load(1);'> -->


						</div>

						<div class="col-md-3">
						<!--	<button type="button" class="btn btn-default" onclick='load(1);'>
								<span class="glyphicon glyphicon-search" ></span> Buscar</button> -->
							<span id="loader"></span>
						</div>

					</div>



		</form>
		</div>
			<div class="panel-body">

			<!--buscar por fecha-->
			<form method="post" class="form"  action="./reporte_comp.php">

						<div class="form-group row">

						<!--	<label  form= "fecha1" class="col-md-1 ">De:</label> -->
							<div class="col-md-2">
						<!--	<input type="date" name="fecha1"> -->
						</div>


						<!--<label  form= "fecha2" class="col-md-1">A:</label>-->
						<div class="col-md-2">
					<!--	<input type="date"  name="fecha2"> -->
							</div>
		 <div class="col-md-2">
		<!--<button type="submit" name="generar_reporte">
		<span class="glyphicon glyphicon-log-out"></span>Exportar a excel
	</button> -->
	</div>
	<!---->
	<div class="panel-heading">
	<div class="btn-group pull-right">
		<!--<a  href="compras.php" class="btn btn-info"><span class="glyphicon glyphicon-refresh" ></span>Refrescar pagina</a> -->
	</div>	</div>
			<!---->
		</div>
			</form>
				<!--fin-->
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<!--<script type="text/javascript" src="js/VentanaCentrada.js"></script>-->
<!--	<script type="text/javascript" src="js/compras.js"></script> -->
  </body>
</html>

<script>
$( "#guardar_cabecera" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_cabecera.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_cabecera.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})



	function obtener_datos(id){

			var ruc = $("#ruc"+id).val();
			var empresa = $("#empresa_cab"+id).val();
			var direccion = $("#direccion_cab"+id).val();
			var telefono1 = $("#telefono1_cab"+id).val();
			var telefono2 = $("#telefono2_cab"+id).val();
			var email = $("#email_cab"+id).val();
			var iva = $("#iva_cab"+id).val();




      $("#mod_id").val(id);
		  $("#mod_ruc").val(ruc);
			 $("#mod_empresa").val(empresa);
			$("#mod_direccion").val(direccion);
			$("#mod_telefono1").val(telefono1);
			$("#mod_telefono2").val(telefono2);
			$("#mod_email").val(email);
			$("#mod_iva").val(iva);

		}



</script>
