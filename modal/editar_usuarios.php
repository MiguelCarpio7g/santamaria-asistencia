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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registrar Salida</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
    <!---------->
		<!---------->
		 <!---------->

				 <!---------->
			 
				<!---------->
				<div class="form-group">
				<label for="hora_salida" class="col-sm-3 control-label">Registrar Salida</label>
				<div class="col-sm-8">
					<input type="time" class="form-control" id="hora_salida" name="hora_salida" readonly required>
				</div>
				</div>
				<!---------->
				
				<!---------->
				
				 <!---------->
				 <!---------->
				

       <!---------->
		


		  </div>
		  <div class="modal-footer">

			<button type="submit" class="btn btn-primary" id="actualizar_datos">Registrar salida</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	<script type="text/javascript">






function updateTime() {
    var now = new Date();
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');
    var seconds = String(now.getSeconds()).padStart(2, '0');
    
    var timeString = hours + ':' + minutes;
    document.getElementById('hora_salida').value = timeString;
}

// Actualizar la hora cada segundo
setInterval(updateTime, 1000);

// Establecer la hora actual al cargar la página
updateTime();
    </script>
