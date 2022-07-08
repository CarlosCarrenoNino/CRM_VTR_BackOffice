<?php

require('conexion.php');
// require('../actions/encript.php');
require ('PHPExcel.php');
//echo "<script>console.log('Ingreso');</script>";

$FECHA1 =  date('d/m/Y',strtotime($_POST['fecha-inicio_Basecarga'])) ;
$FECHA2 = date('d/m/Y',strtotime($_POST['fecha-fin_Basecarga'])) ;


if(isset($_POST['buttom_Basecarga'])){

$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$myparams['fecha_inicio'] = $FECHA1;
$myparams['fecha_fin'] = $FECHA2; 

 $procedure_params = array(
 array(&$myparams['fecha_inicio'], SQLSRV_PARAM_IN),
 array(&$myparams['fecha_fin'], SQLSRV_PARAM_IN)
); 
 
$sqlserver ="EXEC [SPR_SELECT_INFORME_CARGA] '".$FECHA1."','".$FECHA2."' ";

/* $sqlserver ="SELECT 

[BAS_CID_SS_ANDES]
,[BAS_CNUMERO_ORDEN_ANDES]
,[BAS_CLOGICA_ANDES]
,[BAS_CFECHA_ASIGNACION_ANDES]
,[BAS_CFECHA_COMPOMISO_ANDES]
,[BAS_CFRANJA_HORARIA_ANDES]
,[BAS_CRUT_CLIENTE_ANDES]
,[BAS_CCIUDAD_LOCALIDAD_ANDES]
,[BAS_CCNC_ANDES]
,[BAS_CPUESTO_TRABAJO_ANDES]
,[BAS_CPLATAFORMA_ANDES]
,[BAS_CDETALLE1_ANDES]
,[BAS_CDETALLE2_ANDES]
,[BAS_CDETALLE3_ANDES]
,[BAS_CDETALLE4_ANDES]
,[BAS_CDETALLE5_ANDES]
,[BAS_CDETALLE6_ANDES]
,[BAS_CDETALLE7_ANDES]
,[BAS_CDETALLE8_ANDES]


FROM TBL_RBASE_CARGAR_ANDES
WHERE BAS_CFECHA_COMPOMISO_ANDES BETWEEN '$FECHA1' AND '$FECHA2'
order by BAS_CFECHA_COMPOMISO_ANDES "; */

$stmt = sqlsrv_query($conn, $sqlserver);

  $fila = 2;

	$objPHPExcel = new PHPExcel ();
	$objPHPExcel->getProperties ()->setCreator("Descargue_Base_Carga")->setDescription("Descargue_Base_Carga");
	$objPHPExcel->setActiveSheetIndex (0);

		$objPHPExcel->getActiveSheet ()->setTitle ("Descargue_Base_Carga");       
		$objPHPExcel->getActiveSheet () -> setCellValue ('A1', 'ID_SS');
		$objPHPExcel->getActiveSheet () -> setCellValue ('B1', 'NUMERO SOLICITUD');
		$objPHPExcel->getActiveSheet () -> setCellValue ('C1', 'LOGICA');
		$objPHPExcel->getActiveSheet () -> setCellValue ('D1', 'FECHA REGISTRO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('E1', 'FECHA AGENDA');
		$objPHPExcel->getActiveSheet () -> setCellValue ('F1', 'HORA AGENDA');
		$objPHPExcel->getActiveSheet () -> setCellValue ('G1', 'RUT');
		$objPHPExcel->getActiveSheet () -> setCellValue ('H1', 'CIUDAD');
		$objPHPExcel->getActiveSheet () -> setCellValue ('I1', 'CNC');
		$objPHPExcel->getActiveSheet () -> setCellValue ('J1', 'PUESTO TRABAJO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('K1', 'PLATAFORMA');
		$objPHPExcel->getActiveSheet () -> setCellValue ('L1', 'ESTADO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('M1', 'FECHA ASIGNACION');
		$objPHPExcel->getActiveSheet () -> setCellValue ('N1', 'HORA ASIGNACION');
		$objPHPExcel->getActiveSheet () -> setCellValue ('O1', 'CANCELADO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('P1', 'FECHA CANCELADO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('Q1', 'HORA CANCELADO');


		
		$objPHPExcel->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_errors(),true));
			
			

		while($row=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

			
			$objPHPExcel->getActiveSheet () -> setCellValue ('A'.$fila, $row['BAS_CID_SS_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('B'.$fila, $row['BAS_CNUMERO_ORDEN_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('C'.$fila, $row['BAS_CLOGICA_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('D'.$fila, $row['BAS_CFECHA_ASIGNACION_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('E'.$fila, $row['BAS_CFECHA_COMPOMISO_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('F'.$fila, $row['BAS_CFRANJA_HORARIA_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('G'.$fila, $row['BAS_CRUT_CLIENTE_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('H'.$fila, $row['BAS_CCIUDAD_LOCALIDAD_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('I'.$fila, $row['BAS_CCNC_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('J'.$fila, $row['BAS_CPUESTO_TRABAJO_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('K'.$fila, $row['BAS_CPLATAFORMA_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('L'.$fila, $row['BAS_CDETALLE1_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('M'.$fila, $row['BAS_CDETALLE2_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('N'.$fila, $row['BAS_CDETALLE3_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('O'.$fila, $row['BAS_CDETALLE6_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('P'.$fila, $row['BAS_CDETALLE7_ANDES']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('Q'.$fila, $row['BAS_CDETALLE8_ANDES']); 


			
            

		$fila++;

		}
		
			// Save Excel 2007 file
		#echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Informe_Base_Cargadas.xlsx"');
		$objWriter->save('php://output');







}?>