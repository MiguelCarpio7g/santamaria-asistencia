<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Datos del nuevo Empleado</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario" autocomplete="off">
			<div id="resultados_ajax"></div>

			<!---------->
			 <div class="form-group">
			 <label for="cedula" class="col-sm-3 control-label">Cédula:</label>
			 <div class="col-sm-8">
				 <input type="text" class="form-control" id="cedula"
				 minlength="10" maxlength="10" onpaste="return false;" required pattern="[0-9]{10}" name="cedula" onkeypress="return validaNumericos(event)" placeholder="Cedula" required>
			 </div>
			 </div>
		 <!---------->



			  <div class="form-group">
				<label for="nombre_usu" class="col-sm-3 control-label">Nombres:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" onpaste="return false;" id="nombre_usu" name="nombre_usu" placeholder="Nombres"   onkeypress="return validar(event)" required>
				</div>
			  </div>
				<!---------->
			  <div class="form-group">
				<label for="apellido_usu" class="col-sm-3 control-label">Apellidos:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellido_usu" name="apellido_usu" placeholder="Apellidos"   onkeypress="return validar(event)" required>
				</div>
			  </div>
				<!---------->
				<!---------->
				<div class="form-group">
				<label for="telefono_usu" class="col-sm-3 control-label">Telefono:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="telefono_usu" name="telefono_usu" placeholder="telefono" required onkeypress="return validaNumericos(event)" pattern="[0-9]{10}"  minlength="10" maxlength="10">
				</div>
				</div>

				<!---------->
			  <div class="form-group">
				<label for="email_usu" class="col-sm-3 control-label">Email:</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Correo electrónico" required>
				</div>
			  </div>
				<!---------->
				<div class="form-group">
				<label for="direccion_usu" class="col-sm-3 control-label">Direccion:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="direccion_usu" name="direccion_usu" placeholder="Correo electrónico" required>
				</div>
				</div>
				<!---------->

				<!---------->
				<div class="form-group">
				<label for="status_usu" class="col-sm-3 control-label">Estado:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="status_usu" name="status_usu" required>
					<option value="">-- Seleccione --</option>
					<option value="1">Activo</option>
					<option value="0">Inactivo</option>
					</select>
				</div>
				</div>
				<!---------->

				<!---------->
					<!---------->
			  <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">Contraseña:</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
				<!---------->
			  <div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Repite contraseña:</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>


<!---------->
<div class="form-group">
<label for="rol_usu" class="col-sm-3 control-label">Rol:</label>
<div class="col-sm-8">
 <select class="form-control" id="rol_usu" name="rol_usu" required>
	<option value="">-- Seleccione --</option>
	<option value="2">Admin</option>
	<option value="3">Empleado</option>

	</select>
</div>
</div>
	<!-----foto----->
	
			

<!-----foto----->

		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary"  id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	<script type="text/javascript">
function validar(event) {
    if((event.charCode >= 65 && event.charCode <= 90)||(event.charCode >= 97 && event.charCode <= 122)||event.charCode == 32){
      return true;
     }
     return false;
}


function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}


//function Limpiar() {
//var t = document.getElementById("guardar_usuario").getElementsByTagName("input");
//for (var i=0; i<t.length; i++) {
  //  t[i].value = "";
   // }
//}
function Limpiar() {
    document.getElementById("cedula").val = "";
    document.getElementById("nombre_usu").val = "";
    document.getElementById("apellido_usu").val = "";
    document.getElementById("telefono_usu").val = "";
    document.getElementById("email_usu").val = "";
    document.getElementById("direccion_usu").val = "";
    document.getElementById("status_usu").val = "";
    document.getElementById("user_password_new").val = "";
    document.getElementById("user_password_repeat").val = "";
    document.getElementById("rol_usu").val = "";
}
      

    </script>
	

  
  