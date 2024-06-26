<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

//inicio validacion de cedula

  $cedula= $_POST["mod_cedula"];
  //$cedula= validarCI($_GET["cedula"]);


  function validarCI($cedula)
  {

  if(is_null($cedula) || empty($cedula)){//compruebo si que el numero enviado es vacio o null
  echo "Por Favor Ingrese la Cedula";
  }else{//caso contrario sigo el proceso
  if(is_numeric($cedula)){
  $total_caracteres=strlen($cedula);// se suma el total de caracteres
  if($total_caracteres==10){//compruebo que tenga 10 digitos la cedula
  $nro_region=substr($cedula, 0,2);//extraigo los dos primeros caracteres de izq a der
  if($nro_region>=1 && $nro_region<=24){// compruebo a que region pertenece esta cedula//
  $ult_digito=substr($cedula, -1,1);//extraigo el ultimo digito de la cedula
  //extraigo los valores pares//
  $valor2=substr($cedula, 1, 1);
  $valor4=substr($cedula, 3, 1);
  $valor6=substr($cedula, 5, 1);
  $valor8=substr($cedula, 7, 1);
  $suma_pares=($valor2 + $valor4 + $valor6 + $valor8);
  //extraigo los valores impares//
  $valor1=substr($cedula, 0, 1);
  $valor1=($valor1 * 2);
  if($valor1>9){ $valor1=($valor1 - 9); }else{ }
  $valor3=substr($cedula, 2, 1);
  $valor3=($valor3 * 2);
  if($valor3>9){ $valor3=($valor3 - 9); }else{ }
  $valor5=substr($cedula, 4, 1);
  $valor5=($valor5 * 2);
  if($valor5>9){ $valor5=($valor5 - 9); }else{ }
  $valor7=substr($cedula, 6, 1);
  $valor7=($valor7 * 2);
  if($valor7>9){ $valor7=($valor7 - 9); }else{ }
  $valor9=substr($cedula, 8, 1);
  $valor9=($valor9 * 2);
  if($valor9>9){ $valor9=($valor9 - 9); }else{ }

  $suma_impares=($valor1 + $valor3 + $valor5 + $valor7 + $valor9);
  $suma=($suma_pares + $suma_impares);
  $dis=substr($suma, 0,1);//extraigo el primer numero de la suma
  $dis=(($dis + 1)* 10);//luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
  $digito=($dis - $suma);
  if($digito==10){ $digito='0'; }else{ }//si la suma nos resulta 10, el decimo digito es cero
  if ($digito==$ult_digito){//comparo los digitos final y ultimo



  //validacion de cedula


if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {

    require_once("../libraries/password_compatibility_library.php");
}
		if (empty($_POST['firstname2'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['lastname2'])){
			$errors[] = "Apellidos vacíos";
		}    elseif (empty($_POST['email_usu2'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['email_usu2']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['email_usu2'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (

			 !empty($_POST['firstname2'])
			&& !empty($_POST['lastname2'])


            && !empty($_POST['email_usu2'])
            && strlen($_POST['email_usu2']) <= 64
            && filter_var($_POST['email_usu2'], FILTER_VALIDATE_EMAIL)
          )
         {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


                $firstname = ucwords($_POST["firstname2"]);
				$lastname = ucwords($_POST["lastname2"]);
        	$telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono_usu2"],ENT_QUOTES)));
          	$email = mysqli_real_escape_string($con,(strip_tags($_POST["email_usu2"],ENT_QUOTES)));

			//	$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name2"],ENT_QUOTES)));
                $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion_usu2"],ENT_QUOTES)));
  $status = mysqli_real_escape_string($con,(strip_tags($_POST["status_usu2"],ENT_QUOTES)));
  $rol = mysqli_real_escape_string($con,(strip_tags($_POST["rol2"],ENT_QUOTES)));
  $date_added=date("Y-m-d");
				$user_id=intval($_POST['mod_id']);


					// escribir datos de nuevos usuarios en la base de datos
                    $sql = "UPDATE tbl_empleados SET ced_empleado='".$cedula."', nombre_empleado='".$firstname."', apellido_empleado='".$lastname."', telefono_empleado='".$telefono."', email_empleado='".$email."',
                        direccion_empleado='".$direccion."',  status_empleado='".$status."', rol_empleado='".$rol."'   WHERE ced_empleado='".$cedula."';";
                    $query_update = mysqli_query($con,$sql);

                    // si el usuario a sido agregado exitosamente
                    if ($query_update) {
                      //  $messages[] = "El usuario ha sido modificada con éxito.";
                        	echo '<script language="javascript">alert("El usuario ha sido modificada con éxito");window.location.href="usuarios2.php"</script>';
                    }
                    else {
                        $errors[] = "Lo sentimos , el registro falló. Regrese y vuelva a intentarlo. ¡No se admite rol duplicado!";
                    }


        }  else {
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



      //Cedula
      }else{

      echo
      "<div class='alert alert-danger mt-4' role='alert'><h3>Cedula incorrecta.</h3> </div>
                  ";
      }
      }else{

      echo"<div class='alert alert-danger mt-4' role='alert'><h3>Cedula incorrecta.</h3> </div>
      ";

      }


      }else{

      echo "<div class='alert alert-danger mt-4' role='alert'><h3>Cedula incorrecta.</h3> </div>
      ";

      }
      }else{
      echo "<div class='alert alert-danger mt-4' role='alert'><h3>Cedula incorrecta.</h3> </div>
      ";

            }
      }
      }



      $accion=$_POST["mod_cedula"];
      $cedula=validarCI($_POST["mod_cedula"]);

      if($accion=="mod_cedula"){

      echo $cedula;

      }else{
      echo "";
      }
      //fin cedula

?>