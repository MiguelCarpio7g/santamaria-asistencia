<?php

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {

    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.


//echo '<script language="javascript">alert("Bienvenido: ");window.location.href="location: inicio.php"</script>';
   header("location: inicio.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Iniciar sesion</title>

    <!--mostrar password-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--fin del codigo-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/hospitalsant.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong>

						<?php
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div>
						<?php
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>
              <a><i  class='glyphicon glyphicon-user'></i></a><input class="form-control"   placeholder="Cédula" name="cedula" type="text" value="" autofocus="" onkeypress="return validaNumericos(event)"  minlength="10" maxlength="10"  required pattern="[0-9]{10}" required>

              <!--------------------------------------->
              <a><i  class='glyphicon glyphicon-lock'></i></a><input class="form-control" placeholder="Contraseña" name="user_password" type="password" ID="txtPassword" value="" autocomplete="off" required>
			
<div>
			  <input ID="ShowPassword" type="checkbox" onclick="mostrarPassword()" />
			  &nbsp;&nbsp;Mostrar Contraseña</div> </br>
              <!--------------------------------------->
    <!--------------------------------------->
              <!-- <select class="form-control" id="rol_usu" name="rol_usu"  required>
              	<option value=""> Seleccione Rol</option>
              	<option value="1">Admin</option>
              	<option value="2">Vendedor</option>


              </select><br> -->
    <!--------------------------------------->
      <!--------------------------------------->
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">Iniciar Sesión</button>
            </form><!-- /form -->

        </div><!-- /card-container -->
    </div><!-- /container -->
  </body>
</html>

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



function mostrarPassword(){
		var cambio = document.getElementById("txtPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});

</script>
