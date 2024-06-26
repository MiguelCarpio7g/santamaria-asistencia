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
	
	$active_usuarios="active";
	$title="Usuarios";


	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$cedula_usu= $_SESSION['cedula_usu'];

	$sql="SELECT ced_empleado, nombre_empleado, rol_empleado FROM tbl_empleados
	 where ced_empleado='$cedula_usu'";
	 $resultado=$con->query($sql);
	 $row= $resultado->fetch_assoc();
	 $rol=$row['rol_empleado'];
	 if ($rol=="2"){$rol_usu="Admin";}
	 else {$rol_usu="Empleado";}

	 if ($rol=='4'){
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
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="" ></span>Agregar Entrada laboral</button>
			</div>
<!---Cabecera------------>
				
<br><br>
			<!--------------------->
			<h4><i class='glyphicon glyphicon-search'></i> Buscar </h4>
			<form class="form-horizontal" role="form" id="datos_cotizacion">

						<div class="form-group row">
							<!--<label for="q" class="col-md-2 control-label">Nombre:</label>-->
							
							<div class="col-md-5">
								<input type="text" class="form-control" id="q"  onkeyup='load(1);' placeholder="AÑO-MES-DIA" oninput="formatDate(this)">
							</div>

							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
						</div>
			</form>
		</div>
			<div class="panel-body">
			<?php
			include("modal/registro_usuarios.php");
			include("modal/editar_usuarios.php");
			include("modal/cambiar_password.php");

			
			?>

			<!--buscar por fecha-->
			<form method="post" class="form"  action="./reporte_empl2.php">
			<div class="col-md-2">
						  <input type="text" name="cedula1" id="cedula1" value="<?php echo  $cedula_usu; ?>" readonly>
						</div>

						<div class="form-group row">

							<label  form= "fecha1" class="col-md-1 ">De:</label>
							<div class="col-md-2">
						  <input type="date" name="fecha1">
						</div>


            <label  form= "fecha2" class="col-md-1">A:</label>
						<div class="col-md-2">
						<input type="date"  name="fecha2">
							</div>
     <div class="col-md-2">
		<button type="submit" name="generar_reporte">
		<span class="glyphicon glyphicon-log-out"></span>Exportar a excel
	</button>
	</div>
	<!---->
	
	<div class="panel-heading">
	<div class="btn-group pull-right">
		<a  href="usuarios.php" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refrescar pagina</a>
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
	<script type="text/javascript" src="js/usuarios.js"></script>

  </body>
</html>
<script>
$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_usuario.php",
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


//------permiso de usuarios------


//---------------



$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_usuario.php",
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

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})
	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var cedula = $("#cedula_usu"+id).val();
			var nombres = $("#nombre_usu"+id).val();
			var apellidos = $("#apellido_usu"+id).val();
			var telefono = $("#telefono_usu"+id).val();
			var email = $("#email_usu"+id).val();
			var direccion = $("#direccion_usu"+id).val();
			var status_usu = $("#status_usu"+id).val();
      var rol = $("#rol_usu"+id).val();



			$("#mod_id").val(id);
		  $("#mod_cedula").val(cedula);
			$("#firstname2").val(nombres);
			$("#lastname2").val(apellidos);
			$("#telefono_usu2").val(telefono);
			$("#email_usu2").val(email);
			$("#direccion_usu2").val(direccion);
			$("#status_usu2").val(status_usu);
			$("#rol2").val(rol);

		}

		function formatDate(input) {
            // Permitir solo números y guiones
            let value = input.value.replace(/[^0-9-]/g, '');
            
            // Eliminar cualquier guion extra o mal posicionado
            value = value.replace(/-{2,}/g, '-').replace(/(^-|-$)/g, '');
            
            // Autoformatear mientras se escribe
            if (value.length > 4 && value[4] !== '-') {
                value = value.slice(0, 4) + '-' + value.slice(4);
            }
            if (value.length > 7 && value[7] !== '-') {
                value = value.slice(0, 7) + '-' + value.slice(7);
            }
            input.value = value;
        }
    
</script>
