<?php
include('is_logged.php');//Archivo verifica que el usuario que intenta acceder a la URL está logueado

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on una versión menor a PHP 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("../libraries/password_compatibility_library.php");
}

require_once ("../config/db.php"); // Contiene las variables de configuración para conectar a la base de datos
require_once ("../config/conexion.php"); // Contiene función que conecta a la base de datos

// Obtener la hora de entrada desde el formulario
$hora_entrada = $_POST["Horade_entrada"];

// Obtener el ID del usuario logueado (suponiendo que se almacena en la sesión)
$user_id = $_SESSION['cedula_usu'];

// Obtener la fecha actual en el formato adecuado para MySQL
$fecha_actual = date('Y-m-d');

// Comprobar si ya existe una hora de entrada para el usuario en la fecha actual
$sql_check = "SELECT * FROM tbl_registrodeasistencia WHERE ced_empleado = '$user_id' AND DATE(fecha_empleados) = '$fecha_actual'";
$query_check = mysqli_query($con, $sql_check);

if (mysqli_num_rows($query_check) > 0) {
    // Si ya existe una entrada para la fecha actual, mostrar un mensaje de error
    echo '<div class="alert alert-danger" role="alert">Ya has registrado una hora de entrada para el día de hoy.</div>';
} else {
    // Si no existe una entrada para la fecha actual, insertar la nueva hora de entrada
    $sql_insert = "INSERT INTO tbl_registrodeasistencia (ced_empleado, hora_entrada, fecha_empleados) VALUES ('$user_id', '$hora_entrada', '$fecha_actual')";
    $query_insert = mysqli_query($con, $sql_insert);

    // Comprobar si la inserción fue exitosa
    if ($query_insert) {
        echo '<script language="javascript">alert("Hora de entrada registrada exitosamente");window.location.href="usuarios.php"</script>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Lo sentimos, no se pudo registrar la hora de entrada. Por favor, inténtelo de nuevo.</div>';
    }
}

?>
