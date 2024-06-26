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
	$cedula_usu=($_GET['id_vendedor']);
	//$id_vendedo=mysqli_real_escape_string($con,(strip_tags($_REQUEST['id_vendedor'], ENT_QUOTES)));
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
	$estado=mysqli_real_escape_string($con,(strip_tags($_REQUEST['estado_factura'], ENT_QUOTES)));
	$factura=($_GET['factura']);
	//$fechainicio=($_GET['fecha_inicio']);
	//$ruc_empresa_pro=($_GET['ruc_empresa_pro']);
   //	$fecha_inicial_cuota=($_GET['fecha_inicial_cuota']);

//$empresa_pro_serv=($_GET['empresa_pro_serv']);
			//$ruc=mysqli_real_escape_string($con,(strip_tags($_REQUEST['ruc'], ENT_QUOTES)));

		//$fechainicio=($_GET['fecha_inicio']);
			//$fechafin=($_GET['fecha_fin']);
				//	$fechaingreso=($_GET['fecha_ingreso']);

									//$empresa=($_GET['empresa']);

										$sql = "SELECT * FROM tbl_compras WHERE factura_com = '" . $factura . "';";
										$query_check_user_name = mysqli_query($con,$sql);
										$query_check_user=mysqli_num_rows($query_check_user_name);
										if ($query_check_user == 1) {
												//$errors[] = "Lo sentimos, el numero de factura que intenta ingresar ya está en uso.";


												echo "<script>alert('Lo sentimos, el numero de factura que intenta ingresar ya está en uso. ')</script>";
												echo "<script>window.close();</script>";
												exit;
										} else {


	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(numero_com) as last from tbl_compras order by numero_com desc  ");
	$rw=mysqli_fetch_array($sql);
	$numero_factura=$rw['last']+1;
    // get the HTML
//$detallefactura= $numero_factuta->insert_id;

     ob_start();
     include(dirname('__FILE__').'/res/factura_html_C.php');
    $content = ob_get_clean();


		echo "<script>alert('Datos de la factura agregados ')</script>";
		echo "<script>window.close();</script>";
		exit;

		//FIN DE LA VALIDACION DE LA FACTURA REPETIDA
		   }
			 //ARRIBA

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0, 0, 0));
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
