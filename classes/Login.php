<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object conexion a la base de datos
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // verifique las posibles acciones de inicio de sesión:
        // si el usuario intentó cerrar la sesión (sucede cuando el usuario hace clic en el botón de cierre de sesión)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // iniciar sesión a través de datos de publicación (si el usuario acaba de enviar un formulario de inicio de sesión)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['cedula'])) {
            $this->errors[] = "el campo de nombre del usuario esta vacio .";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "el campo de contraseña estaba vacio.";
        } /*elseif (empty($_POST['rol_usu'])) {
            $this->errors[] = "el campo del rol estaba vacio.";
        }*/


        elseif (!empty($_POST['cedula']) && !empty($_POST['user_password']) ) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['cedula']);
                  //$rol = $this->db_connection->real_escape_string($_POST['rol_usu']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT  ced_empleado, nombre_empleado, email_empleado, status_empleado, password_empleado
                        FROM tbl_empleados
                        WHERE ced_empleado = '".$user_name."'
                        ;";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1 ) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->password_empleado)) {
                        if ($result_row->status_empleado == 1) {
                        
                        // write user data into PHP SESSION (a file on your server)
                      //  $_SESSION['user_id'] = $result_row->user_id;
						            $_SESSION['cedula_usu'] = $result_row->ced_empleado;
                        $_SESSION['email_empleado'] = $result_row->email_empleado;
                        //$_SESSION['rol_usu'] = $result_row->rol_usu;
                        $_SESSION['status_empleado'] = $result_row->status_empleado;

                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Usuario inactivo. Contacte al administrador.";
                    }
                }
                    
                    
                    
                    else {
                        $this->errors[] = "Contraseña no coincide.";
                    }
                } else {
                    $this->errors[] = "Cedula y/o contraseña no coinciden.";
                }
            } else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "Has sido desconectado.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1
       ) {

            return true;
        }
        // default return
        return false;
    }
}
