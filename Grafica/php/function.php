


<?php
/* Conectar a la base de datos*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
class MySQL
{





    public function getVendidos()
    {
        $vendidos = 0;
        try {
            $strQuery = "SELECT SUM(total_ven) as vendidos FROM tbl_ventas";
            if ($this->conBDPDO()) {
                $pQuery = $this->con->prepare($strQuery);
                $pQuery->execute();
                $vendidos = $pQuery->fetchColumn();
            }
        } catch (PDOException $e) {
            echo "MySQL.getVendidos: " . $e->getMessage() . "\n";
            return -1;
        }
        return $vendidos;

    }

    /*public function getAlmacen()
    {
        $almacen = 0;
        try {
            $strQuery = "SELECT SUM(en_almacen) as enAlmacen FROM resumen_productos";
            if ($this->conBDPDO()) {
                $pQuery = $this->oConBD->prepare($strQuery);
                $pQuery->execute();
                $almacen = $pQuery->fetchColumn();
            }
        } catch (PDOException $e) {
            echo "MySQL.getAlmacen: " . $e->getMessage() . "\n";
            return -1;
        }
        return $almacen;
    } */


  /*  public function getIngresos()
    {
        $ingreso = 0;
        try {
            $strQuery = "SELECT (SUM(precio) * SUM(cantidad_vendidos))/100000 as ingresos FROM resumen_productos";
            if ($this->conBDPDO()) {
                $pQuery = $this->oConBD->prepare($strQuery);
                $pQuery->execute();
                $ingreso = $pQuery->fetchColumn();
            }
        } catch (PDOException $e) {
            echo "MySQL.getIngresos: " . $e->getMessage() . "\n";
            return -1;
        }
        return $ingreso;
    } */

    public function getDatosGrafica()
    {
        $jDatos = '';
        $rawdata = array();
        $i = 0;
        try {
            $strQuery = "SELECT sum(total_ven) as tPrecio
            ,DATE_FORMAT(fecha_ven, '%Y-%m-%d') as fecha FROM tbl_ventas GROUP BY DATE_FORMAT(fecha_ven, '%Y-%m-%d')";

            if ($this->conBDPDO()) {
                $pQuery = $this->con->prepare($strQuery);
                $pQuery->execute();
                $pQuery->setFetchMode(PDO::FETCH_ASSOC);
                while($producto = $pQuery->fetch()) {
                    $oGrafica = new Grafica();
                    $oGrafica->totalVendidos = $producto['total_ven'];
                  //  $oGrafica->totalVendidos = $producto['tVendidos'];
                    $oGrafica->fechaVenta = $producto['fecha_ven'];
                    $rawdata[$i] = $oGrafica;
                    $i++;
                }
                $jDatos = json_encode( $rawdata);
            }
        } catch (PDOException $e) {
            echo "MySQL.getDatosGrafica: " . $e->getMessage() . "\n";
            return -1;
        }
        return $jDatos;
    }

}
class Grafica{
    public $totalVendidos = 0;
    public $totalPrecio = 0;
    public $fechaVenta = 0;
}

 ?>
