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


	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$sql=mysqli_query($con, "select id_cuota from tbl_cuotas");
	$rw=mysqli_fetch_array($sql);

	$facturaR=$rw['id_cuota'];
		// get the HTML


    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/factura_htmlP.php');
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
