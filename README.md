### Aplicación web básica para gestionar la asistencia del personal utilizando MySQL, PHP y JavaScript
<p>
Requerimientos
</p>

- xampp que es un gestor de base de datos MYSQL que se requiere para este proyecto 
- La version a utilizar  5.6.15 en el siguiente enlace lo podran encontrar https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/

<p>
Codigo de conexion a la base de datos dentro de la carpeta config/db.php
</p>
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');//Usuario de tu base de datos
define('DB_PASS', '');//Contraseña del usuario de la base de datos
define('DB_NAME', 'santamaria');//Nombre de la base de datos
?>
<p>
Nos permite saber si nos conectamos correctamente a la base de datos
carpeta config/conexion.php
</p>
<?php

    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>

- El empleado solo puede loguearse para ingresar su hora de entrada y salida siempre y cuando el ADMIN(que tiene acceso total al sistema) registre los datos en el modulo de empleados, El sistema no le permite al empleado navegar por otros modulos.
- el admin solo prodra visualizar la asistencia de los empleados que ingresen su hora entrada ese mismo dia ( mas no de dias anteriores )y posteriormente descargar esos datos al final del dia para llevar su reporte.
- Si el  admin requiere los registros de asistencia de un  empleado de un tiempo determinado, solo el empleado puede acceder a esos datos ingresando al sistema y descargarlos.
- el empleado podra descargar su registro de asistencia ya sea de una semana o como el requiera para tener constancia de ello, o cuando su superior quiera llevar un registro de ello.
- el sistema se puede visualizar maximo en una tablet de 853 x 1280
- admin: ced:0950664334 pass:efrain
- empleado: 0916106727 pass:efrain
