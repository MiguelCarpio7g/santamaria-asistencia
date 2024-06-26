<?php
	//Incluimos librería y archivo de conexión
	require 'classes/PHPExcel.php';
	require 'config/db.php';//Contiene las variables de configuracion para conectar a la base de datos
	require 'config/conexion.php';//Contiene funcion que conecta a la base de datos
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		

		$fecha1 = $_POST['fecha1'];
		$fecha2 = $_POST['fecha2'];
		

		$verfecha1 = date('d/m/Y', strtotime($fecha1));
			$verfecha2 = date('d/m/Y', strtotime($fecha2));
			

	}
	if (empty($_POST['fecha1'])) {

echo '<script language="javascript">alert("Fecha inicial vacia");window.location.href="usuarios.php"</script>';

	}
  // 	header('Location: ventas.php' );
		elseif (empty($_POST['fecha2'])) {
	echo '<script language="javascript">alert("Fecha secundaria vacia");window.location.href="usuarios.php"</script>';
		}

	elseif(isset($_POST['generar_reporte']))
	{
	
	//Consulta
	$sql = "SELECT * FROM  tbl_empleados WHERE fecha_empleado BETWEEN '$fecha1' AND '$fecha2' ";
	$resultado = $con->query($sql);
	$fila = 7; //Establecemos en que fila inciara a imprimir los datos



	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();

	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Marko robles")->setDescription("Reporte de Asistencia de empleados");

	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Empleados");

	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');

	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(100);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$estiloTituloReporte = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>13,


	'color' => array(
	'rgb' => 'FFFFFF'
	)




    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID,

		'color' => array('rgb' => 'f44336')
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_NONE
	)
    ),
    'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

	$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10,
	'color' => array(
	'rgb' => 'FFFFFF'
	)
    ),
    'fill' => array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'color' => array('rgb' => '538DD5')
    ),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    'font' => array(
	'name'  => 'Arial',
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
	'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	));

	$objPHPExcel->getActiveSheet()->getStyle('A1:I5')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($estiloTituloColumnas);

	$objPHPExcel->getActiveSheet()->setCellValue('C3', 'REPORTE DE EMPLEADO');

			$objPHPExcel->getActiveSheet()->setCellValue('C4'," Desde ".$verfecha1." Hasta ". $verfecha2);
	$objPHPExcel->getActiveSheet()->mergeCells('C3:F3');
		$objPHPExcel->getActiveSheet()->mergeCells('C4:F4');

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'CEDULA');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'NOMBRE');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'APELLIDO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'TELEFONO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'CORREO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'DIRECCION');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('G6', 'STATUS');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('H6', 'ROL');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setCellValue('I6', 'AGREGADO');
	
	


	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultado->fetch_assoc()){






		$user_id=$rows['ced_empleado'];
		//$cedula=$row['cedula_usu'];
		$fullname=$rows['nombre_empleado'];
		$apellido=$rows["apellido_empleado"];
	//	$user_name=$row['us'];
	$telefono=$rows['telefono_empleado'];
		$email=$rows['email_empleado'];
		$direccion=$rows['direccion_empleado'];
			
		$status=$rows['status_empleado'];
		//--------------
		if ($status=="1"){$estado="Activo";}
		else {$estado="Inactivo";}

		$rol=$rows['rol_empleado'];

		if ($rol=="2"){$rol_usu="Administrador";}
		else {$rol_usu="Empleado";}
	
    $fecha= date($rows['fecha_empleado']);

		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $user_id);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $fullname);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $apellido);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $telefono);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $email);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $direccion);
	
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $estado);
		
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rol_usu);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $fecha);






		$fila++; //Sumamos 1 para pasar a la siguiente fila
	}

	$fila = $fila-1;

	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:I".$fila);

	$filaGrafica = $fila+2;

	// definir origen de los valores
	$values = new PHPExcel_Chart_DataSeriesValues('Number', 'Productos!$D$7:$D$'.$fila);

	// definir origen de los rotulos
	$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Productos!$B$7:$B$'.$fila);

	// definir  gráfico
	$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART, // tipo de gráfico
	PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
	array(0),
	array(),
	array($categories), // rótulos das columnas
	array($values) // valores
	);
	$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

	// inicializar gráfico
	$layout = new PHPExcel_Chart_Layout();
	$plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));



	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	// incluir gráfico
	$writer->setIncludeCharts(TRUE);

	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Reporte_Empleados.xlsx"');
	header('Cache-Control: max-age=0');

	$writer->save('php://output');
}
?>
