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
			FACTURA Nº <?php echo 	$factura_com?>
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
				$rw_proveedor=mysqli_fetch_array($sql_cliente);
					echo "Proveedor: ";
				echo $rw_proveedor['nombre_pro']." ".$rw_proveedor['apellido_pro'];
				echo "<br> Direccion: ";
				echo $rw_proveedor['direccion_pro'];
				echo "<br> Teléfono: ";
				echo $rw_proveedor['telefono_pro'];
				echo "<br> Email: ";
				echo $rw_proveedor['email_pro'];
				echo "<br> Cédula: ";
				echo $rw_proveedor['cedula_pro'];
				echo "<br> Ruc: ";
				echo $rw_proveedor['ruc_pro'];
				echo "<br> Empresa: ";
				echo $rw_proveedor['empresa_pro'];
			?>

		   </td>
        </tr>


    </table>




		<br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
				<tr>
					 <td style="width:25%;" class='midnight-blue'>Detalle de cuota</td>
						<td style="width:25%;" class='midnight-blue'>Fecha de compra</td>
				</tr>
		<tr>
					 <td style="width:50%;" >
			<?php


				echo "fecha inicio cuota: ";
				echo $fecha_inicio_cuo;
				echo "<br> fecha fin cuota: ";
				echo 	$fecha_fin_cuo;

				//echo $rw_cuotas['meses_cuota_ven'];
			?>
			 </td>

			 <td style="width:50%;" >
		<?php


		echo "  ";
		echo 	$ingreso_factura;


		//echo $rw_cuotas['meses_cuota_ven'];
		?>
		</td>




				</tr>
		</table>










       <br>
		<table cellspacing="0" style="width: 72%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>COMPRADOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:20%;" class='midnight-blue'>FORMA DE PAGO</td>
       <td style="width:20%;" class='midnight-blue'>ESTADO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php
				$sql_user=mysqli_query($con,"select * from tbl_usuarios where cedula_usu='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['nombre_usu']." ".$rw_user['apellido_usu'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y", strtotime($fecha_factura));?></td>
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
				if ($estado_factura==1){echo "Pagado";}
				elseif ($estado_factura==2){echo "Pendiente";}
				elseif ($estado_factura==3){echo "Anulado";}

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
$sql=mysqli_query($con, "select * from tbl_productos, tbldetalle_compra, tbl_compras where tbl_productos.codigo_prod=tbldetalle_compra.codigo_prod and tbldetalle_compra.numero_com=tbl_compras.numero_com and tbl_compras.numero_com='".$id_factura."'");

while ($row=mysqli_fetch_array($sql))
	{
//	$id_producto=$row["codigo_prod"];
	$codigo_producto=$row['codigo_prod'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_prod'];

	$iva_comp=$row['iva_comp'];


	$precio_venta=$row['precio_com'];
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


	$nums++;
	}
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * $iva_comp)/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;
?>

        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo $iva_comp; ?>)% &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr><tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>



	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por sus articulos!</div>




</page>
