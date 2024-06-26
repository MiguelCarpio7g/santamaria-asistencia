<?php
// Conectar a la base de datos
require_once("../config/db.php"); // Contiene las variables de configuración para conectar a la base de datos
require_once("../config/conexion.php"); // Contiene la función que conecta a la base de datos
include('is_logged.php'); // Archivo verifica que el usuario que intenta acceder a la URL está logueado

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';



//CODIGO DE ELIMINAR//







//codigo eliminar fin








if ($action == 'ajax') {
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('ced_empleado'); // Columnas de búsqueda
    $sTable = "tbl_empleados, tbl_registrodeasistencia";
    $sWhere = " WHERE tbl_empleados.ced_empleado = tbl_registrodeasistencia.ced_empleado AND DATE(tbl_registrodeasistencia.fecha_empleados) = CURDATE()"; // Filtrar por usuario logueado
    
    if ($_GET['q'] != "") {
        $sWhere .= " AND (tbl_empleados.ced_empleado LIKE '%$q%' OR tbl_registrodeasistencia.ced_empleado LIKE '%$q%')";
    }
    
    $sWhere .= " ORDER BY tbl_empleados.ced_empleado DESC";
    include 'pagination.php'; // Incluye archivos de la paginación

    // Variables de paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5; // Cuántos registros quieres mostrar
    $adjacents = 4; // Espacio entre páginas después del número adyacente
    $offset = ($page - 1) * $per_page;

    // Cuenta el número total de las filas en la tabla
    $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './usuarios2.php';

    // Consulta principal para buscar los datos
    $sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset, $per_page";
    $query = mysqli_query($con, $sql);

    // Bucle a través de los datos obtenidos
    if ($numrows > 0) {
        ?>
        <div class="table-responsive">
            <table class="table">
                <tr class="info">
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Telefono</th>
                
                    <th>Direccion</th>
                    <th>Hora de entrada</th>
                    <th>Hora de salida</th>
                    <th>Status</th>
                    <th>Rol</th>
                    <th>Fecha</th>
                    <th><span class="pull-right">Acciones</span></th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    $user_id = $row['ced_empleado'];

                   // Dividir el nombre completo y tomar el primer nombre
$first_name_parts = explode(" ", $row['nombre_empleado']);
$first_name = $first_name_parts[0];

// Dividir el apellido completo y tomar el primer apellido
$last_name_parts = explode(" ", $row['apellido_empleado']);
$first_last_name = $last_name_parts[0];

// Concatenar el primer nombre y el primer apellido
$fullname = $first_name . " " . $first_last_name;
                    
                    $telefono = $row['telefono_empleado'];
                  
                    $direccion = $row['direccion_empleado'];
                    $horario_entrada = $row['hora_entrada'];
                    $horario_salida = $row['hora_salida'];
                    $status = $row['status_empleado'];
                    $status_empleado = ($status == "1") ? "Activo" : "Inactivo";
                    $rol = $row['rol_empleado'];
                    $rol_usu = ($rol == "2") ? "Administrador" : "Empleado";
                    $date_added = date('d/m/Y', strtotime($row['fecha_empleados']));
                    ?>
                    <input type="hidden" value="<?php echo $row['ced_empleado']; ?>" id="cedula_usu<?php echo $user_id; ?>">
                    <input type="hidden" value="<?php echo $row['nombre_empleado']; ?>" id="nombre_usu<?php echo $user_id; ?>">
                    <input type="hidden" value="<?php echo $row['apellido_empleado']; ?>" id="apellido_usu<?php echo $user_id; ?>">
                    <input type="hidden" value="<?php echo $row['telefono_empleado'];?>" id="telefono_usu<?php echo $user_id;?>">
                    <input type="hidden" value="<?php echo $row['email_empleado'];?>" id="email_usu<?php echo $user_id;?>">
                    <input type="hidden" value="<?php echo $row['direccion_empleado'];?>" id="direccion_usu<?php echo $user_id;?>">
                 
                    <input type="hidden" value="<?php echo $row['status_empleado']; ?>" id="status_usu<?php echo $user_id; ?>">
                    <input type="hidden" value="<?php echo $rol; ?>" id="rol_usu<?php echo $user_id; ?>">
                    <tr>
                        <td><?php echo $user_id; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $telefono; ?></td>
                        <td><?php echo $direccion; ?></td>
                        <td><?php echo $horario_entrada; ?></td>
                        <td><?php echo $horario_salida; ?></td>
                        <td><?php echo $status_empleado; ?></td>
                        <td><?php echo $rol_usu; ?></td>
                        <td><?php echo $date_added; ?></td>
                        <td><span class="pull-right">
                           
                            <a href="#" class='btn btn-default' title='Editar Datos' onclick="obtener_datos('<?php echo $user_id; ?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>

                            <a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $user_id; ?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>

                           
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan=9><span class="pull-right"><?php echo paginate($reload, $page, $total_pages, $adjacents); ?></span></td>
                </tr>
            </table>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> La cedula que digitó no se encuentra en la BD.
        </div>
        <?php
    }
}
?>
