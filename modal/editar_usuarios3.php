<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Datos del empleado</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
    <!---------->
		<!---------->
			 <div class="form-group">
			 <label for="mod_cedula" class="col-sm-3 control-label">Cédula</label>
			 <div class="col-sm-8">
				 <input type="text" class="form-control" id="mod_cedula"
				 minlength="10" maxlength="10"  required pattern="[0-9]{10}" name="mod_cedula" onkeypress="return validaNumericos(event)" readonly>
			 </div>
			 </div>
		 <!---------->


			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="firstname2" name="firstname2" placeholder="Nombres" required  onkeypress="return  validar(event)">
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
				 <!---------->
			  <div class="form-group">
				<label for="lastname2" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="Apellidos" required onkeypress="return  validar(event)">
				</div>
			  </div>
				<!---------->
				<div class="form-group">
				<label for="telefono_usu2" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="telefono_usu2" name="telefono_usu2" placeholder="telefono" required onkeypress="return validaNumericos(event)" pattern="[0-9]{10}"  minlength="10" maxlength="10">
				</div>
				</div>
				<!---------->
				<div class="form-group">
				<label for="email_usu2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email_usu2" name="email_usu2" placeholder="Correo electrónico" required>
				</div>
				</div>
				<!---------->
				<div class="form-group">
				<label for="direccion_usu2" class="col-sm-3 control-label">Direccion:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="direccion_usu2" name="direccion_usu2" placeholder="Correo electrónico" required>
				</div>
				</div>
				 <!---------->
				 <!---------->
				 <div class="form-group">
				 <label for="status_usu2" class="col-sm-3 control-label">Estado</label>
				 <div class="col-sm-8">
					<select class="form-control" id="status_usu2" name="status_usu2" required>
					 <option value="">-- Seleccione --</option>
					 <option value="1">Activo</option>
					 <option value="0">Inactivo</option>
					 </select>
				 </div>
				 </div>

       <!---------->
			 <div class="form-group">
			 <label for="rol2" class="col-sm-3 control-label">Rol</label>
			 <div class="col-sm-8">
			  <select class="form-control" id="rol2" name="rol2" required>
			 	<option value="">-- Seleccione --</option>
			 	<option value="2">Admin</option>
			 	<option value="3">Empleado</option>

			 	</select>
			 </div>
			 </div>


		  </div>
		  <div class="modal-footer">

			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
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


function Limpiar() {

	 document.getElementById("mod_cedula").value = "";
	document.getElementById("firstname2").value = "";
 document.getElementById("lastname2").value = "";
 document.getElementById("user_name2").value = "";
  document.getElementById("user_email2").value = "";
	  document.getElementById("rol2").value = "";
}
    </script>
