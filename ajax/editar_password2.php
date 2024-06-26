<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {

    require_once("../libraries/password_compatibility_library.php");
}
		if (empty($_POST['user_id_mod'])){
			$errors[] = "ID vacío";
		}  elseif (empty($_POST['user_password_new3']) || empty($_POST['user_password_repeat3'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['user_password_new3'] !== $_POST['user_password_repeat3']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        }  elseif (
			 !empty($_POST['user_id_mod'])
			&& !empty($_POST['user_password_new3'])
            && !empty($_POST['user_password_repeat3'])
            && ($_POST['user_password_new3'] === $_POST['user_password_repeat3'])
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

				$user_id=($_POST['user_id_mod']);
				$user_password = $_POST['user_password_new3'];


				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);


					//escribir datos de nuevos usuarios en la base de datos
                    $sql = "UPDATE tbl_empleados SET password_empleado='".$user_password_hash."' WHERE ced_empleado='".$user_id."'";
                    $query = mysqli_query($con,$sql);

                    // si el ususario ha sido agregado exitosamente
                    if ($query) {
                      //  $messages[] = "contraseña ha sido modificada con éxito.";
                        			echo '<script language="javascript">alert("contraseña ha sido modificada con éxito.");window.location.href="usuarios2.php"</script>';
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }


        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }

		if (isset($errors)){

			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong>
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){

				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>
