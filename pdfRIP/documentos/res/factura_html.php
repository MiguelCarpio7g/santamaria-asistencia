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
				Teléfono:<?php echo $telefono1;?><br>
				Email: <?php echo $email;?><br>
				Ruc: <?php echo $ruc;?>
            </td>

<?php }
 ?>

			<td style="width: 25%;text-align:right">

			Comprobante Nº <?php echo $facturaR;?>

			</td>

        </tr>
    </table>
    <br>



    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>COMPROBANTE DE ABONO</td>


		   <th style="width: 55%; text-align: right" class='midnight-blue'>FACTURA</th>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$cuota = $_POST['abono'];
			}
				$sql_cliente=mysqli_query($con,"select * from tbl_clientes, tbl_cuotas where tbl_clientes.cedula_cli=tbl_cuotas.cedula_cli and tbl_cuotas.numero_ven_cuo='$cuota'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
					echo "Cliente: ";
				echo $rw_cliente['nombre_cli']." ".$rw_cliente['apellido_cli'];
				echo "<br> Direccion: ";
				echo $rw_cliente['direccion_cli'];
				echo "<br> Teléfono: ";
				echo $rw_cliente['telefono_cli'];
				echo "<br> Email: ";
				echo $rw_cliente['email_cli'];
				echo "<br> Cedula: ";
				echo $rw_cliente['cedula_cli'];
			?>

		   </td>


		   <td style="width:55%; text-align: right" >
						<?php

						$sql=mysqli_query($con, "select * from tbl_cuotas, tbl_ventas where  tbl_cuotas.numero_ven_cuo=tbl_ventas.numero_ven AND tbl_ventas.numero_ven='$cuota'");
						while ($row=mysqli_fetch_array($sql))
							{
						$fet=$row['numero_ven'];
						
					echo  $fet;

						}

					?>
					 </td>





        </tr>


    </table>

       <br>
		<table cellspacing="0" style="width: 62%; text-align: left; font-size: 11pt;">
        <tr>

			<td style="width:25%;" class='midnight-blue'>USUARIO</td>
		  <td style="width:20%;" class='midnight-blue'>FECHA</td>
		   <td style="width:20%;" class='midnight-blue'>FORMA DE PAGO</td>
       <td style="width:20%;" class='midnight-blue'>ESTADO</td>
			 <td style="width:20%;" class='midnight-blue'>DEUDA</td>
			 	 <td style="width:20%;" class='midnight-blue'>DEUDA ACTUAL</td>
			 	 <td style="width:20%;" class='midnight-blue'>FECHA DE DEUDA</td>
        </tr>
		<tr>

			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$cuota = $_POST['abono'];
			}
				$sql_user=mysqli_query($con,"select * from tbl_usuarios, tbl_ventas, tbl_detallecuota where
			tbl_usuarios.cedula_usu=tbl_ventas.cedula_usu and tbl_ventas.numero_ven='$cuota'");
				$rw_user=mysqli_fetch_array($sql_user);
			//	echo $rw_user['nombre_usu']." ".$rw_user['apellido_usu'];

			?>


			 <td style="width:25%;">
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$cuota = $_POST['abono'];
	}

	$cedula_usu= $_SESSION['cedula_usu'];
		$sql_vendedor="select nombre_usu, apellido_usu from tbl_usuarios
		where cedula_usu='$cedula_usu'";
		$resultado=$con->query($sql_vendedor);
		$row= $resultado->fetch_assoc();

		echo $nombre_pro=$row['nombre_usu']." ".$row['apellido_usu'];


	?>
	 </td>


		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		   <td style="width:25%;" >
				<?php

				$condiciones = $rw_user['condiciones_ven'];

			  if ($condiciones==1){ $cond="Efectivo";}
				elseif ($condiciones==2){ $cond= "Cheque";}
				elseif ($condiciones==3){ $cond= "Transferencia bancaria";}
				elseif ($condiciones==4){ $cond="Crédito";}
					echo $cond;
				?>

		   </td>
			 <td style="width:25%;" >
				<?php
				 $estado= $rw_user['estado_ven'];
			if ($estado==1){$esta="Pagado";}
			elseif ($estado==2){$esta="Pendiente";}
       echo $esta;
				?>

			 </td>

			 <td style="width:30%;" >
				<?php
				$deuda=$rw_user['total_ven'];
				//$status_cliente=$row['status_cli'];
				//if ($status_cliente==1){$estado="Activo";}
				//else {$estado="Inactivo";}
				//$date_added= date('d/m/Y', strtotime($row['fecha_cli']));
			$total_deuda=number_format($deuda,2);
		$total_deuda_2=str_replace(",","",$total_deuda);//Reemplazo las comas
       //echo $rw_user['total_ven']." $";
			 echo "$".$total_deuda;
				?>
			 </td>

			 <td style="width:20%;" >
					<?php
					$sql2=mysqli_query($con, "select * from tbl_cuotas, tbl_ventas where  tbl_cuotas.numero_ven_cuo=tbl_ventas.numero_ven AND tbl_ventas.numero_ven='$cuota'");
					while ($row=mysqli_fetch_array($sql2))
						{

					 $cuodeuda=$row['deuda_cuo'];

				$total_deuda=number_format($cuodeuda,2);
			$total_deuda_2=str_replace(",","",$total_deuda);//Reemplazo las comas
				 echo "$".$total_deuda;
					}

				?>
				 </td>




       <td style="width:20%;" >
			 		<?php

					$sql=mysqli_query($con, "select * from tbl_cuotas, tbl_ventas where  tbl_cuotas.numero_ven_cuo=tbl_ventas.numero_ven AND tbl_ventas.numero_ven='$cuota'");
					while ($row=mysqli_fetch_array($sql))
						{
					$desde=$row['fecha_inicio_ven'];
				   $hasta=$row['fecha_fin_ven'];

        echo  $desde." ".$hasta;

          }

				?>
 		 		 </td>




        </tr>



    </table>
	<br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            
            <th style="width: 60%" class='midnight-blue'>ABONO</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>FECHA</th>
        </tr>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$cuota = $_POST['abono'];
}
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from tbl_cuotas, tbl_detallecuota, tbl_ventas where tbl_cuotas.numero_ven_cuo=tbl_detallecuota.numero_ven
and tbl_ventas.numero_ven=tbl_detallecuota.numero_ven
and tbl_detallecuota.numero_ven='".$cuota."'");

while ($row=mysqli_fetch_array($sql))
	{
//	$id_producto=$row["codigo_prod"];
	$numero_ven=$row['numero_ven'];
	$cuota=$row['cuota_cuo'];



	//$status_cliente=$row['status_cli'];
	//if ($status_cliente==1){$estado="Activo";}
	//else {$estado="Inactivo";}
	//$date_added= date('d/m/Y', strtotime($row['fecha_cli']));
$total_cuota=number_format($cuota,2);
$total_deuda_2=str_replace(",","",$total_cuota);//Reemplazo las comas
 //echo $rw_user['total_ven']." $";



	$fecha_det=$row['fecha_det'];



	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}

	?>

        <tr>
          
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left">$<?php echo $total_cuota;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $fecha_det;?></td>


        </tr>

	<?php
	$nums++;
	}
?>

        <tr>

        </tr>
		<tr>

        </tr><tr>

        </tr>
    </table>



	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias!</div>




</page>
<?php

 ?>
