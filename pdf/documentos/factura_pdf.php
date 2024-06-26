<?php
	/*-------------------------

	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }


	/* conectar a la base de datos*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tbl_tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados ')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	//Variables por GET
	$id_cliente=($_GET['id_cliente']);
	$id_vendedor=($_GET['id_vendedor']);
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));

//ESTE ES NUEVO
$estado=mysqli_real_escape_string($con,(strip_tags($_REQUEST['estado_factura'], ENT_QUOTES)));

//FIN DEL NUEVO
	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(numero_ven) as last
	 from tbl_ventas order by numero_ven desc  ");
	$rw=mysqli_fetch_array($sql);

	$numero_factura=$rw['last']+1;
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/factura_html.php');
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
