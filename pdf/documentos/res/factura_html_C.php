<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;

}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "mecg.pw "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">

            </td>

						<?php
						 $cabecera=mysqli_query($con, "select * from tbl_cabecera");

						 while ($row=mysqli_fetch_array($cabecera))
							 {
		$ruc=$row['ruc'];
							 $empresa=$row['empresa_cab'];
						 $cod=$row['direccion_cab'];
							 $email=$row['email_cab'];
							 $telefono1=$row['telefono1_cab']."- ".$row['telefono2_cab'];
							 	 $iva=$row['iva_cab'];
						 //	$row=['direccion_cab'];
							 //$row=['empresa_cab'];
							 //$row=['telefono1_cab'];
							 //$row=['email_cab'];
							 // code...
							?>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo $empresa;?></span>
				<br><?php echo $cod;?><br>
				Teléfono: <?php echo $telefono1;?><br>
				Email: <?php echo $email;?><br>
				Ruc: <?php echo $ruc;?>
				<?php }
				 ?>
            </td>
			<td style="width: 25%;text-align:right">
			Factura Nº <?php echo $factura//$numero_factura;?>
			</td>

        </tr>
    </table>
    <br>



    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>FACTURADO A</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php
				$sql_cliente=mysqli_query($con,"select * from tbl_proveedores where cedula_pro='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo " Proveedor: ";
				echo $rw_cliente['nombre_pro']." ".$rw_cliente['apellido_pro'];
				echo "<br> Direccion: ";
				echo $rw_cliente['direccion_pro'];
				echo "<br> Teléfono: ";
				echo $rw_cliente['telefono_pro'];
				echo "<br> Email: ";
				echo $rw_cliente['email_pro'];
				echo "<br> Cédula: ";
				echo $rw_cliente['cedula_pro'];
				echo "<br> Ruc: ";
				echo $rw_cliente['ruc_pro'];
				echo "<br> Empresa: ";
				echo $rw_cliente['empresa_pro'];
			?>

		   </td>
        </tr>


    </table>

/*--------------nuevo meses------------*/

<br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:25%;" class='midnight-blue'>Detalle de cuota</td>
					  <td style="width:25%;" class='midnight-blue'>	Meses</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php
			$fecha_inicial_cuota=mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_inicial_cuota'])));

			$fecha_fin_cuota=mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_fin_cuota'])));

				echo "fecha inicio cuota: ";
				echo $fecha_inicial_cuota;
				echo "<br> fecha fin cuota: ";
				echo 	$fecha_fin_cuota;

			  //echo $rw_cuotas['meses_cuota_ven'];
			?>
		   </td>

			 <td style="width:50%;" >
	<?php

	$meses_cuota_com =mysqli_real_escape_string($con,(strip_tags($_REQUEST['meses_cuota_com'])));
		echo "  ";
		echo 	$meses_cuota_com;


		//echo $rw_cuotas['meses_cuota_ven'];
	?>
	 </td>




        </tr>
    </table>

/*------------------------------------*/







       <br>
		<table cellspacing="0" style="width: 72%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>COMPRADOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
			  <td style="width:40%;" class='midnight-blue'>ESTADO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php
        	$cedula_usu= $_SESSION['cedula_usu'];
				$sql_user=mysqli_query($con,"select * from tbl_usuarios where cedula_usu='$cedula_usu'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['nombre_usu']." ".$rw_user['apellido_usu'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		   <td style="width:40%;" >
				<?php
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia bancaria";}
				elseif ($condiciones==4){echo "Crédito";}
				?>

		   </td>
			 <td style="width:40%;" >
				<?php
				if ($estado==1){echo "Pagado";}
				elseif ($estado==2){echo "Pendiente";}
				?>

			 </td>

        </tr>



    </table>
	<br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>

        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from tbl_productos, tbl_tmp where tbl_productos.codigo_prod=tbl_tmp.codigo_prod and tbl_tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	//$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_prod'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_prod'];

	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>

        </tr>

	<?php

 $factura=mysqli_real_escape_string($con,(strip_tags($_REQUEST['factura'])));

	//Insert en la tabla detalle_cotizacion


	$insert_detail=mysqli_query($con, "INSERT INTO tbldetalle_compra (numero_com, codigo_prod, cantidad, precio_com)
		 VALUES ('$numero_factura','$codigo_producto','$cantidad','$precio_venta_r')");



//suma de los animales adquiridos
	$update=mysqli_query($con,"UPDATE tbl_productos set stock_prod = stock_prod + '$cantidad' where codigo_prod='".$codigo_producto."'");

	//FIN DE LA CODIFICACION
	$nums++;
	}

	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * $iva )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;



?>

        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo $iva; ?>)% &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr><tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>



	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold"></div>

</page>

<?php
$date=date("Y-m-d");
//$factura=mysqli_real_escape_string($con,(strip_tags($_REQUEST['factura'])));
	//$fecha_inicial_cuota=date($_GET['fecha_inicial_cuota']);
	$fecha_inicial_cuota=mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_inicial_cuota'])));

	$fecha_fin_cuota=mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_fin_cuota'])));

		$fecha_ingreso_factura=mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_ingreso_factura'])));

		$meses_cuota_com =mysqli_real_escape_string($con,(strip_tags($_REQUEST['meses_cuota_com'])));

		

		//$empresa_pro_serv=mysqli_real_escape_string($con,(strip_tags($_REQUEST['empresa_pro_serv'])));
//$fechafin=date($_GET['fecha_fin']);
//$fechaingreso=date($_GET['fecha_ingreso']);
//$ruc_empresa_pro=mysqli_real_escape_string($con,(strip_tags($_REQUEST['ruc_empresa_pro'])));
//$empresa=mysqli_real_escape_string($con,(strip_tags($_REQUEST['empresa'])));
//---------------------------------------------------------------

//VALIDACION DE FACTURA REPETIDAS
$sql = "SELECT * FROM tbl_compras WHERE factura_com = '" . $factura . "';";
$query_check_user_name = mysqli_query($con,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);
if ($query_check_user == 1) {
		$errors[] = "Lo sentimos, el numero de factura que intenta ingresar ya está en uso.";
} else {






$insert=mysqli_query($con,"INSERT INTO tbl_compras VALUES ('$numero_factura','$date','$id_cliente','$cedula_usu','$condiciones','$total_factura','$estado','1','$factura',
'$fecha_inicial_cuota','$fecha_fin_cuota','$fecha_ingreso_factura','$iva','$meses_cuota_com')");





$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from tbl_productos, tbl_tmp where tbl_productos.codigo_prod=tbl_tmp.codigo_prod and tbl_tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	//$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_prod'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_prod'];

	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}

$insert_detail=mysqli_query($con, "INSERT INTO tbldetalle_compra (numero_com, codigo_prod, cantidad, precio_com)
	 VALUES ('$numero_factura','$codigo_producto','$cantidad','$precio_venta_r')");

	$nums++; 	}

	//----------------------------------------------------------------
	if($condiciones=='4'){
	$insert2=mysqli_query($con,"INSERT INTO tbl_cuotas(numero_com_cuo, condiciones_com_cuo, cedula_pro, fecha_cuo, status_cuo, deuda_cuo,
	tipo_cuo, fechai_cuo, fechaf_cuo )  VALUES
	('$numero_factura', '$condiciones', '$id_cliente', '$date', '2','$total_factura','1','$fecha_inicial_cuota','$fecha_fin_cuota' )");
	}
	//----------------------------------------------------------------
//$update=mysqli_query($con,"UPDATE tbl_animales set stock_ani = stock_ani + '$cantidad' where codigo_ani='".$codigo_producto."'");
//-----------------------------

//fin de la factura repetida
}
//AQUI ESTA XD

$delete=mysqli_query($con,"DELETE FROM tbl_tmp WHERE session_id='".$session_id."'");



?>
