<?php

require('conexion.php');

require ('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


$FECHA1 =  date('Y-m-d',strtotime($_POST['fecha-inicio_andes'])) ;
$FECHA2 = date('Y-m-d',strtotime($_POST['fecha-fin_andes'])) ;


if(isset($_POST['buttom_andes'])){

$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$myparams['fecha_inicio'] = $FECHA1;
$myparams['fecha_fin'] = $FECHA2; 

 $procedure_params = array(
 array(&$myparams['fecha_inicio'], SQLSRV_PARAM_IN),
 array(&$myparams['fecha_fin'], SQLSRV_PARAM_IN)
);  
 

$sqlserver ="EXEC [SPR_SELECT_INFORME_ANDES] '".$FECHA1."','".$FECHA2."' ";


$stmt = sqlsrv_query($conn, $sqlserver);

  $fila = 2;

  	$spread = new Spreadsheet();
	$spread->getProperties ()->setCreator("Descargue_Base_Andes")->setDescription("Descargue_Base_Andes");
	$spread->setActiveSheetIndex (0);

		$spread->getActiveSheet ()->setTitle ("Descargue_Base_Andes");       
		$spread->getActiveSheet () -> setCellValue ('A1', 'ID_SS');
		$spread->getActiveSheet () -> setCellValue ('B1', 'NUMERO SOLICITUD');
		$spread->getActiveSheet () -> setCellValue ('C1', 'LOGICA');
		$spread->getActiveSheet () -> setCellValue ('D1', 'FECHA REGISTRO');
		/* $spread->getActiveSheet () -> setCellValue ('D1', 'HORA REGISTRO'); */
		$spread->getActiveSheet () -> setCellValue ('E1', 'FECHA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('F1', 'HORA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('G1', 'RUT');
		$spread->getActiveSheet () -> setCellValue ('H1', 'CIUDAD');
		$spread->getActiveSheet () -> setCellValue ('I1', 'CNC');
		$spread->getActiveSheet () -> setCellValue ('J1', 'PUESTO TRABAJO');
		$spread->getActiveSheet () -> setCellValue ('K1', 'PLATAFORMA');
		$spread->getActiveSheet () -> setCellValue ('L1', 'USUARIO');
		/* $spread->getActiveSheet () -> setCellValue ('M1', 'SOLICITUD SERVICIO'); */
		$spread->getActiveSheet () -> setCellValue ('M1', 'FECHA GESTION');
		/* $spread->getActiveSheet () -> setCellValue ('N1', 'HORA GESTION'); */
		$spread->getActiveSheet () -> setCellValue ('N1', 'TIPO ORDEN');
		$spread->getActiveSheet () -> setCellValue ('O1', 'SERVICIO');
		$spread->getActiveSheet () -> setCellValue ('P1', 'CASILLERO');
		$spread->getActiveSheet () -> setCellValue ('Q1', 'CASUISTICA');
		$spread->getActiveSheet () -> setCellValue ('R1', 'GESTION');
		$spread->getActiveSheet () -> setCellValue ('S1', 'REALIZAR PRUEBAS');
		$spread->getActiveSheet () -> setCellValue ('T1', 'COMO SOLUCIONA');
		$spread->getActiveSheet () -> setCellValue ('U1', 'NUEVA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('V1', 'FECHA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('W1', 'HORA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('X1', 'FECHA BLOQUE');
		$spread->getActiveSheet () -> setCellValue ('Y1', 'BLOQUE');
		$spread->getActiveSheet () -> setCellValue ('Z1', 'OBSERVACIONES');
		$spread->getActiveSheet () -> setCellValue ('AA1', 'ESTADO');
		$spread->getActiveSheet () -> setCellValue ('AB1', 'FECHA ASIGNACION');
		$spread->getActiveSheet () -> setCellValue ('AC1', 'HORA ASIGNACION');
		$spread->getActiveSheet () -> setCellValue ('AD1', 'HORA GESTION');
		$spread->getActiveSheet () -> setCellValue ('AE1', 'TMO SEGUNDOS');
		$spread->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_errors(),true));
			
			

		while($row=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

			$spread->getActiveSheet () -> setCellValue ('A'.$fila, $row['TIP_CID_SS']);
			$spread->getActiveSheet () -> setCellValue ('B'.$fila, $row['TIP_CNUMERO_SOLICITU']);
			$spread->getActiveSheet () -> setCellValue ('C'.$fila, $row['TIP_CLOGICA']);
			$spread->getActiveSheet () -> setCellValue ('D'.$fila, $row['TIP_CFECHA_REGISTRO']);
			/* $spread->getActiveSheet () -> setCellValue ('D'.$fila, $row['TIP_CHORA_REGISTRO']); */
			$spread->getActiveSheet () -> setCellValue ('E'.$fila, $row['TIP_CFECHA_AGENDA']);
			$spread->getActiveSheet () -> setCellValue ('F'.$fila, $row['TIP_CHORA']);
			$spread->getActiveSheet () -> setCellValue ('G'.$fila, $row['TIP_CRUT']);
			$spread->getActiveSheet () -> setCellValue ('H'.$fila, $row['TIP_CIUDAD']);
			$spread->getActiveSheet () -> setCellValue ('I'.$fila, $row['TIP_CCNC']);
			$spread->getActiveSheet () -> setCellValue ('J'.$fila, $row['TIP_CPUESTO_TRABAJO']);
			$spread->getActiveSheet () -> setCellValue ('K'.$fila, $row['TIP_CPLATAFORMA']);
			$spread->getActiveSheet () -> setCellValue ('L'.$fila, $row['TIP_CUSUARIO']);
			/* $spread->getActiveSheet () -> setCellValue ('M'.$fila, $row['TIP_CSOLICITUD_SERVICIO']); */
			$spread->getActiveSheet () -> setCellValue ('M'.$fila, $row['TIP_CFECHA_GESTION']);
			/* $spread->getActiveSheet () -> setCellValue ('N'.$fila, $row['TIP_CHORA_GESTION']); */
			$spread->getActiveSheet () -> setCellValue ('N'.$fila, $row['TIP_CTIPO_ORDEN']);
			$spread->getActiveSheet () -> setCellValue ('O'.$fila, $row['TIP_CSERVICIO']);
			$spread->getActiveSheet () -> setCellValue ('P'.$fila, $row['TIP_CASILLERO']);
			$spread->getActiveSheet () -> setCellValue ('Q'.$fila, $row['TIP_CCASUISTICA']);
			$spread->getActiveSheet () -> setCellValue ('R'.$fila, $row['TIP_CGESTION']);
			$spread->getActiveSheet () -> setCellValue ('S'.$fila, $row['TIP_CREALIZAR_PRUEBAS']);
			$spread->getActiveSheet () -> setCellValue ('T'.$fila, $row['TIP_CCOMO_SOLUCIONA']);
			$spread->getActiveSheet () -> setCellValue ('U'.$fila, $row['TIP_CREPROGRAMAR']);
			$spread->getActiveSheet () -> setCellValue ('V'.$fila, $row['TIP_CFECHA_REPROGRAMAR']);
			$spread->getActiveSheet () -> setCellValue ('W'.$fila, $row['TIP_CHORA_REPROGRAMAR']);
			$spread->getActiveSheet () -> setCellValue ('X'.$fila, $row['TIP_CFECHA_BLOQUE']);
			$spread->getActiveSheet () -> setCellValue ('Y'.$fila, $row['TIP_CBLOQUE']);
			$spread->getActiveSheet () -> setCellValue ('Z'.$fila, $row['TIP_COBSERVARCIONES']);
			$spread->getActiveSheet () -> setCellValue ('AA'.$fila, $row['TIP_CDETALLE1']);
			$spread->getActiveSheet () -> setCellValue ('AB'.$fila, $row['TIP_CDETALLE2']);
			$spread->getActiveSheet () -> setCellValue ('AC'.$fila, $row['TIP_CDETALLE3']);
			$spread->getActiveSheet () -> setCellValue ('AD'.$fila, $row['TIP_CDETALLE5']);
			$spread->getActiveSheet () -> setCellValue ('AE'.$fila, $row['TIP_CDETALLE6']);
					
            

		$fila++;

		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Informe_General_Tipificacion.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = IOFactory::createWriter($spread, 'Xlsx');
		$writer->save('php://output');


		




}?>