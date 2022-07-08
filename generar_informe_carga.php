<?php

require('conexion.php');
require ('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;



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


$stmt = sqlsrv_query($conn, $sqlserver);

  $fila = 2;

  	$spread = new Spreadsheet();
	$spread->getProperties ()->setCreator("Descargue_Base_Carga")->setDescription("Descargue_Base_Carga");
	$spread->setActiveSheetIndex (0);

		$spread->getActiveSheet ()->setTitle ("Descargue_Base_Carga");       
		$spread->getActiveSheet () -> setCellValue ('A1', 'ID_SS');
		$spread->getActiveSheet () -> setCellValue ('B1', 'NUMERO SOLICITUD');
		$spread->getActiveSheet () -> setCellValue ('C1', 'LOGICA');
		$spread->getActiveSheet () -> setCellValue ('D1', 'FECHA REGISTRO');
		$spread->getActiveSheet () -> setCellValue ('E1', 'FECHA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('F1', 'HORA AGENDA');
		$spread->getActiveSheet () -> setCellValue ('G1', 'RUT');
		$spread->getActiveSheet () -> setCellValue ('H1', 'CIUDAD');
		$spread->getActiveSheet () -> setCellValue ('I1', 'CNC');
		$spread->getActiveSheet () -> setCellValue ('J1', 'PUESTO TRABAJO');
		$spread->getActiveSheet () -> setCellValue ('K1', 'PLATAFORMA');
		$spread->getActiveSheet () -> setCellValue ('L1', 'ESTADO');
		$spread->getActiveSheet () -> setCellValue ('M1', 'FECHA ASIGNACION');
		$spread->getActiveSheet () -> setCellValue ('N1', 'HORA ASIGNACION');
		
		$spread->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_errors(),true));
			
			

		while($row=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

			$spread->getActiveSheet () -> setCellValue ('A'.$fila, $row['BAS_CID_SS_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('B'.$fila, $row['BAS_CNUMERO_ORDEN_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('C'.$fila, $row['BAS_CLOGICA_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('D'.$fila, $row['BAS_CFECHA_ASIGNACION_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('E'.$fila, $row['BAS_CFECHA_COMPOMISO_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('F'.$fila, $row['BAS_CFRANJA_HORARIA_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('G'.$fila, $row['BAS_CRUT_CLIENTE_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('H'.$fila, $row['BAS_CCIUDAD_LOCALIDAD_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('I'.$fila, $row['BAS_CCNC_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('J'.$fila, $row['BAS_CPUESTO_TRABAJO_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('K'.$fila, $row['BAS_CPLATAFORMA_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('L'.$fila, $row['BAS_CDETALLE1_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('M'.$fila, $row['BAS_CDETALLE2_ANDES']);
			$spread->getActiveSheet () -> setCellValue ('N'.$fila, $row['BAS_CDETALLE3_ANDES']);
			
					
            

		$fila++;

		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Informe_General_Tipificacion.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = IOFactory::createWriter($spread, 'Xlsx');
		$writer->save('php://output');


		




}?>