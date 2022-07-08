<?php

    session_start();
    require('conexion.php');
    require_once('PHPExcel/IOFactory.php');
      
    if(isset($_POST['upload-base_tango']))
    { 

        date_default_timezone_set('America/Santiago');
        $fechaHoy = date('Y-m-d');
        $horaHoy = date('H');
        $minutoHoy = date('i');

        $nameEXCEL = $_FILES['upload-base_tango1']['name'];
        $tmpEXCEL = $_FILES['upload-base_tango1']['tmp_name'];
        $extEXCEL = pathinfo($nameEXCEL);
        $urlnueva = 'cargue/Cargar_Tango.xls';

        if (is_uploaded_file($tmpEXCEL)){
            copy($tmpEXCEL, $urlnueva);
            $objPHPExcel = PHPExcel_IOFactory::load('cargue/Cargar_Tango.xls');
            $nomRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            for ($i = 2; $i <= $nomRows; $i++){
                
                $NUMERO_ORDEN= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                $LOGICA=$objPHPExcel->getActiveSheet()->getCell('B' .$i)->getFormattedValue();
                $FECHA_ASIGNACION= $objPHPExcel->getActiveSheet()->getCell('C' .$i)->getFormattedValue();
                $FECHA_COMPROMISO= $objPHPExcel->getActiveSheet()->getCell('D' .$i)->getFormattedValue();
                $HORA= $objPHPExcel->getActiveSheet()->getCell('E' .$i)->getFormattedValue();
                $RUT= $objPHPExcel->getActiveSheet()->getCell('F' .$i)->getFormattedValue();
                $CIUDAD_LOCALIDAD= $objPHPExcel->getActiveSheet()->getCell('G' .$i)->getCalculatedValue();
                $CNC= $objPHPExcel->getActiveSheet()->getCell('H' .$i)->getFormattedValue();
                $PUESTO_TABAJO= $objPHPExcel->getActiveSheet()->getCell('I' .$i)->getCalculatedValue();
                $PLATAFORMA= $objPHPExcel->getActiveSheet()->getCell('J' .$i)->getCalculatedValue();
                             

                $myparams['NUMERO_ORDEN'] = $NUMERO_ORDEN;
                $myparams['LOGICA'] = $LOGICA;
                $myparams['FECHA_ASIGNACION'] = $FECHA_ASIGNACION;
                $myparams['FECHA_COMPROMISO'] = $FECHA_COMPROMISO;
                $myparams['HORA'] = $HORA;
                $myparams['RUT'] = $RUT;
                $myparams['CIUDAD_LOCALIDAD'] = $CIUDAD_LOCALIDAD;
                $myparams['CNC'] = $CNC;
                $myparams['PUESTO_TABAJO'] = $PUESTO_TABAJO;
                $myparams['PLATAFORMA'] = $PLATAFORMA;
                $myparams['DETALLE1'] = 'Pendiente';
                $myparams['DETALLE4'] = $fechaHoy;
                

                $procedure_params = array(
                    array(&$myparams['NUMERO_ORDEN'], SQLSRV_PARAM_IN),
                    array(&$myparams['LOGICA'], SQLSRV_PARAM_IN),
                    array(&$myparams['FECHA_ASIGNACION'], SQLSRV_PARAM_IN),
                    array(&$myparams['FECHA_COMPROMISO'], SQLSRV_PARAM_IN),
                    array(&$myparams['HORA'], SQLSRV_PARAM_IN),
                    array(&$myparams['RUT'], SQLSRV_PARAM_IN),
                    array(&$myparams['CIUDAD_LOCALIDAD'], SQLSRV_PARAM_IN),
                    array(&$myparams['CNC'], SQLSRV_PARAM_IN),
                    array(&$myparams['PUESTO_TABAJO'], SQLSRV_PARAM_IN),
                    array(&$myparams['PLATAFORMA'], SQLSRV_PARAM_IN),
                    array(&$myparams['DETALLE1'], SQLSRV_PARAM_IN),
                    array(&$myparams['DETALLE4'], SQLSRV_PARAM_IN),

                    
                );

                $SprSql = "EXEC [SPR_INSERT_BASE_TANGO] 
                    
                    @NUMERO_ORDEN=?,
                    @LOGICA=?,
                    @FECHA_ASIGNACION=?,
                    @FECHA_COMPROMISO=?,
                    @HORA=?,
                    @RUT=?,
                    @CIUDAD_LOCALIDAD=?,
                    @CNC=?,
                    @PUESTO_TABAJO=?,
                    @PLATAFORMA=?,
                    @DETALLE1=?,
                    @DETALLE4=?";
                    

                $stmt = sqlsrv_query($conn, $SprSql, $procedure_params);
            }
            if ($stmt==false){
                echo '<script> alert("Error Al Cargar La Base.");</script>';
                
            }else{
                echo '<script> alert("Base Cargada Correctamente.");</script>';
                echo '<script> window.location="base.php"; </script>';
            }
        } 
    }

?> 