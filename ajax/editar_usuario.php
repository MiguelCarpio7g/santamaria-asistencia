<?php
include('is_logged.php');

// Verificar si el usuario está logueado
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on una versión menor a PHP 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("../libraries/password_compatibility_library.php");
}

require_once("../config/db.php");
require_once("../config/conexion.php");

// Obtener la hora de salida del formulario (asegúrate de validar y limpiar esta entrada)
$hora_salida = $_POST["hora_salida"];

// Obtener el ID del usuario logueado (suponiendo que se almacena en la sesión)
$user_id = $_SESSION['cedula_usu'];

// Obtener la fecha actual en el formato adecuado para MySQL
$fecha_actual = date('Y-m-d');

// Verificar si ya existe una entrada para la hora de salida para el usuario actual en la fecha actual
$sql_check = "SELECT * FROM tbl_registrodeasistencia WHERE ced_empleado = '$user_id' AND DATE(fecha_empleados) = '$fecha_actual'";
$query_check = mysqli_query($con, $sql_check);

if (mysqli_num_rows($query_check) > 0) {
    // Si ya existe una entrada para la fecha actual, actualizar la hora de salida
    $row = mysqli_fetch_assoc($query_check);
    if ($row['hora_salida'] == NULL) {
        // Si la hora de salida es NULL, actualiza la hora de salida
        $sql_update = "UPDATE tbl_registrodeasistencia SET hora_salida = '$hora_salida' WHERE ced_empleado = '$user_id' AND DATE(fecha_empleados) = '$fecha_actual'";
        $query_update = mysqli_query($con, $sql_update);

        // Comprobar si la actualización fue exitosa
        if ($query_update) {
            echo '<script language="javascript">alert("Hora de salida registrada exitosamente");window.location.href="usuarios.php"</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Lo sentimos, no se pudo registrar la hora de salida. Por favor, inténtelo de nuevo.</div>';
        }
    } else {
        // Si la hora de salida ya está registrada, mostrar un mensaje de error
        echo '<div class="alert alert-danger" role="alert">Ya has registrado una hora de salida para el día de hoy.</div>';
    }
} else {
    // Si no existe una entrada para la fecha actual, mostrar un mensaje de error
    echo '<div class="alert alert-danger" role="alert">Aún no has registrado una hora de entrada para el día de hoy.</div>';
}


?>

