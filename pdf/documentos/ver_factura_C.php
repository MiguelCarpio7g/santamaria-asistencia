<?php
	/*-------------------------

	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Conectar a la base de datos*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$id_factura= ($_GET['id_factura']);
	$sql_count=mysqli_query($con,"select * from tbl_compras where numero_com='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Orden no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from tbl_compras where numero_com='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
		$factura_com=$rw_factura['factura_com'];
	$numero_factura=$rw_factura['numero_com'];
	$id_cliente=$rw_factura['cedula_pro'];
	$id_vendedor=$rw_factura['cedula_usu'];
	$fecha_factura=$rw_factura['fecha_com'];
	$condiciones=$rw_factura['condiciones_com'];
	$estado_factura=$rw_factura['status_com'];

	$fecha_inicio_cuo=$rw_factura['fecha_iniciocuota_com'];
	$fecha_fin_cuo=$rw_factura['fecha_fincuota_com'];
	$ingreso_factura=$rw_factura['fecha_ingreso_com'];

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/ver_factura_html_C.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Orden.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
