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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registro hora de entrada</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario" autocomplete="off">
			<div id="resultados_ajax"></div>

			<!---------->
			
		 <!---------->



			
				<!---------->
			 
				<!---------->
				<!---------->
				<div class="form-group">
    <label for="Horade_entrada" class="col-sm-3 control-label">Hora de Entrada:</label>
    <div class="col-sm-8">
        <input type="time" class="form-control" id="Horade_entrada" name="Horade_entrada" readonly required>
    </div>
</div>


				<!---------->
			 
				<!---------->
				
				<!---------->

				<!---------->
			
				<!---------->

				<!---------->
					<!---------->
			 
				<!---------->
			


<!---------->

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

function updateTime() {
    var now = new Date();
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');
    var seconds = String(now.getSeconds()).padStart(2, '0');
    
    var timeString = hours + ':' + minutes;
    document.getElementById('Horade_entrada').value = timeString;
}

// Actualizar la hora cada segundo
setInterval(updateTime, 1000);

// Establecer la hora actual al cargar la página
updateTime();

    </script>
  
 