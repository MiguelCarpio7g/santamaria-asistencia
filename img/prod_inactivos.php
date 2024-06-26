<?php
	//Incluimos librería y archivo de conexión
	require '../classes/PHPExcel.php';
	require '../config/db.php';//Contiene las variables de configuracion para conectar a la base de datos
	require '../config/conexion.php';//Contiene funcion que conecta a la base de datos



	if(isset($_POST['generar_reporte']))
	{
	//Consulta
	$sql = "SELECT * FROM tbl_productos WHERE status_prod = '0' ";
	$resultado = $con->query($sql);
	$fila = 7; //Establecemos en que fila inciara a imprimir los datos



	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();

	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Marko robles")->setDescription("Reporte de P_I");

	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Reporte de P_I");

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
	'size' =>13
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
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

	$objPHPExcel->getActiveSheet()->getStyle('A1:F5')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($estiloTituloColumnas);

	$objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE PRODUCTOS INACTIVOS');
	$objPHPExcel->getActiveSheet()->mergeCells('B3:D3');

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'CODIGO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'PRODUCTO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'STATUS');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'CANTIDAD');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'PRECIO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'PRECIOV');



	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultado->fetch_assoc()){

		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['codigo_prod']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['nombre_prod']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['status_prod']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['stock_prod']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['precio_prod']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['pventa_prod']);


		$fila++; //Sumamos 1 para pasar a la siguiente fila
	}

	$fila = $fila-1;

	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:F".$fila);

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
	header('Content-Disposition: attachment;filename="Reporte de P_I.xlsx"');
	header('Cache-Control: max-age=0');

	$writer->save('php://output');
}
?>
