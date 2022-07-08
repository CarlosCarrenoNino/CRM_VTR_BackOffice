<?php

require('conexion.php');
// require('../actions/encript.php');
require ('PHPExcel.php');
//echo "<script>console.log('Ingreso');</script>";

$FECHA1 =  date('Y-m-d',strtotime($_POST['fecha-inicio_tipificacion'])) ;
$FECHA2 = date('Y-m-d',strtotime($_POST['fecha-fin_tipificacion'])) ;


if(isset($_POST['buttom_tipificacion'])){

$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$myparams['fecha_inicio'] = $FECHA1;
$myparams['fecha_fin'] = $FECHA2; 

 $procedure_params = array(
 array(&$myparams['fecha_inicio'], SQLSRV_PARAM_IN),
 array(&$myparams['fecha_fin'], SQLSRV_PARAM_IN)
); 
 
$sqlserver ="EXEC [SPR_SELECT_INFORME_TIPIFICACION] '".$FECHA1."','".$FECHA2."' ";

$stmt = sqlsrv_query($conn, $sqlserver);

  $fila = 2;

	$objPHPExcel = new PHPExcel ();
	$objPHPExcel->getProperties ()->setCreator("Descargue_General_Tipificacion")->setDescription("Descargue_General_Tipificacion");
	$objPHPExcel->setActiveSheetIndex (0);

	$objPHPExcel->getActiveSheet ()->setTitle ("Descargue_General_Tipificacion");
    $objPHPExcel->getActiveSheet () -> setCellValue ('A1', 'NUMERO GESTION');
    $objPHPExcel->getActiveSheet () -> setCellValue ('B1', 'ID_SS');
    $objPHPExcel->getActiveSheet () -> setCellValue ('C1', 'NUMERO SOLICITUD');
    $objPHPExcel->getActiveSheet () -> setCellValue ('D1', 'LOGICA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('E1', 'FECHA REGISTRO');
    /* $objPHPExcel->getActiveSheet () -> setCellValue ('D1', 'HORA REGISTRO'); */
    $objPHPExcel->getActiveSheet () -> setCellValue ('F1', 'FECHA AGENDA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('G1', 'HORA AGENDA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('H1', 'RUT');
    $objPHPExcel->getActiveSheet () -> setCellValue ('I1', 'CIUDAD');
    $objPHPExcel->getActiveSheet () -> setCellValue ('J1', 'CNC');
    $objPHPExcel->getActiveSheet () -> setCellValue ('K1', 'PUESTO TRABAJO');
    $objPHPExcel->getActiveSheet () -> setCellValue ('L1', 'PLATAFORMA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('M1', 'USUARIO');
    /* $objPHPExcel->getActiveSheet () -> setCellValue ('M1', 'SOLICITUD SERVICIO'); */
    $objPHPExcel->getActiveSheet () -> setCellValue ('N1', 'FECHA GESTION');
    /* $objPHPExcel->getActiveSheet () -> setCellValue ('N1', 'HORA GESTION'); */
    $objPHPExcel->getActiveSheet () -> setCellValue ('O1', 'TIPO ORDEN');
    $objPHPExcel->getActiveSheet () -> setCellValue ('P1', 'SERVICIO');
    $objPHPExcel->getActiveSheet () -> setCellValue ('Q1', 'CASILLERO');
    $objPHPExcel->getActiveSheet () -> setCellValue ('R1', 'CASUISTICA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('S1', 'GESTION');
    $objPHPExcel->getActiveSheet () -> setCellValue ('T1', 'REALIZAR PRUEBAS');
    $objPHPExcel->getActiveSheet () -> setCellValue ('U1', 'COMO SOLUCIONA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('V1', 'NUEVA AGENDA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('W1', 'FECHA AGENDA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('X1', 'HORA AGENDA');
    $objPHPExcel->getActiveSheet () -> setCellValue ('Y1', 'FECHA BLOQUE');
    $objPHPExcel->getActiveSheet () -> setCellValue ('Z1', 'BLOQUE');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AA1', 'OBSERVACIONES');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AB1', 'ESTADO');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AC1', 'FECHA ASIGNACION');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AD1', 'HORA ASIGNACION');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AE1', 'HORA GESTION');
    $objPHPExcel->getActiveSheet () -> setCellValue ('AF1', 'TMO SEGUNDOS');
    $objPHPExcel->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_errors(),true));

		
		$objPHPExcel->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_errors(),true));
			
			

		while($row=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

            $objPHPExcel->getActiveSheet () -> setCellValue ('A'.$fila, $row['TIP_NID']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('B'.$fila, $row['TIP_CID_SS']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('C'.$fila, $row['TIP_CNUMERO_SOLICITU']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('D'.$fila, $row['TIP_CLOGICA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('E'.$fila, $row['TIP_CFECHA_REGISTRO']);
			/* $objPHPExcel->getActiveSheet () -> setCellValue ('D'.$fila, $row['TIP_CHORA_REGISTRO']); */
			$objPHPExcel->getActiveSheet () -> setCellValue ('F'.$fila, $row['TIP_CFECHA_AGENDA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('G'.$fila, $row['TIP_CHORA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('H'.$fila, $row['TIP_CRUT']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('I'.$fila, $row['TIP_CIUDAD']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('J'.$fila, $row['TIP_CCNC']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('K'.$fila, $row['TIP_CPUESTO_TRABAJO']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('L'.$fila, $row['TIP_CPLATAFORMA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('M'.$fila, $row['TIP_CUSUARIO']);
			/* $objPHPExcel->getActiveSheet () -> setCellValue ('M'.$fila, $row['TIP_CSOLICITUD_SERVICIO']); */
			$objPHPExcel->getActiveSheet () -> setCellValue ('N'.$fila, $row['TIP_CFECHA_GESTION']);
			/* $objPHPExcel->getActiveSheet () -> setCellValue ('N'.$fila, $row['TIP_CHORA_GESTION']); */
			$objPHPExcel->getActiveSheet () -> setCellValue ('O'.$fila, $row['TIP_CTIPO_ORDEN']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('P'.$fila, $row['TIP_CSERVICIO']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('Q'.$fila, $row['TIP_CASILLERO']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('R'.$fila, $row['TIP_CCASUISTICA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('S'.$fila, $row['TIP_CGESTION']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('T'.$fila, $row['TIP_CREALIZAR_PRUEBAS']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('U'.$fila, $row['TIP_CCOMO_SOLUCIONA']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('V'.$fila, $row['TIP_CREPROGRAMAR']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('W'.$fila, $row['TIP_CFECHA_REPROGRAMAR']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('X'.$fila, $row['TIP_CHORA_REPROGRAMAR']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('Y'.$fila, $row['TIP_CFECHA_BLOQUE']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('Z'.$fila, $row['TIP_CBLOQUE']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AA'.$fila, $row['TIP_COBSERVARCIONES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AB'.$fila, $row['TIP_CDETALLE1']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AC'.$fila, $row['TIP_CDETALLE2']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AD'.$fila, $row['TIP_CDETALLE3']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AE'.$fila, $row['TIP_CDETALLE5']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('AF'.$fila, $row['TIP_CDETALLE6']);


			
            

		$fila++;

		}
		
			// Save Excel 2007 file
		#echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Informe_General_Tipificacion.xlsx"');
		$objWriter->save('php://output');







}?>