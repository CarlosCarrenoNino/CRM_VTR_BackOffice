<?php

require('conexion.php');


date_default_timezone_set('America/Santiago');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H:i:s');
$minutoHoy = date('i');

/*  if(isset($_POST['enviar'])){
    $fechaGestion = trim($_POST['fechaGestion']);
    $orden = trim($_POST['orden']);
    $servicio = trim($_POST['servicio']);
    $casillero = trim($_POST['casillero']);
    $casuistica = trim($_POST['casuistica']);
    $gestion= trim($_POST['gestion']);
    $prueba=trim($_POST['prueba']);   */
    /* $solucion=trim($_POST['solucion']); */
    /* $reprogramar=trim($_POST['reprogramar']);
    $fechareprogramar=trim($_POST['fechareprogramar']);
    $horarepro=trim($_POST['horarepro']); */
    /* $obervaciones=trim($_POST['observaciones']); */
   
    /* date_default_timezone_set('America/Bogota');

    $fechaHoy = date('Y-m-d');
    $horaHoy = date('H:i:s');

    $date1=strtotime($hora_inicial);
    $date2=strtotime($horaHoy);

    $TMO=round($date2-$date1);

    

    $date3=strtotime($hora_inicial);
    $date4=strtotime($hora_inactivo);

    $TMO_Inactivo=round($date3-$date4); */

   /* $query= "EXEC SPR_INSERT_TIPIFICACION
    @fechaGestion=?,
    @orden=?,
    @servicio=?,
    @casillero=?,
    @casuistica=?,
    @gestion=?,
    @prueba=?,
    @obervaciones=?
    ";

  

    $resultado = sqlsrv_query($conn, $query);

    if(!$resultado){

       die("Query fallido");
    }

    
    header("location: asesor.php"); 

    
    

}  */

$myparams['fechaGestion']=$_POST['fechaGestion'];
$myparams['horaGestion']=$_POST['horaGestion'];
$myparams['orden']=$_POST['orden'];
$myparams['servicio']=$_POST['servicio'];
$myparams['casillero']=$_POST['casillero'];
$myparams['casuistica']=$_POST['casuistica'];
$myparams['gestion']=$_POST['gestion'];
$myparams['prueba']=$_POST['prueba'];
$myparams['solucion']=$_POST['solucion'];
$myparams['reprogramar']=$_POST['reprogramar'];
$myparams['fechareprogramar']=$_POST['fechareprogramar'];
$myparams['horarepro']=$_POST['horarepro'];
$myparams['fechabloque']=$_POST['fechabloque'];
$myparams['bloque']=$_POST['bloque'];
$myparams['bloque2']= '';
if(isset($_POST['bloque2'])){
    $myparams['bloque2'] = $myparams['bloque'];
    $myparams['bloque'] = trim($_POST['bloque2']);
}
$myparams['obervaciones']=$_POST['observaciones'];
$myparams['estado']='Finalizado';
$myparams['fechaupdate']=$fechaHoy;
$myparams['horaupdate']=$horaHoy;
$myparams['id_base_principal']=$_POST['id_base_principal'];

if($_POST['id_base_principal']==0){
    echo '<script> alert("No tiene nigún caso Asignado.");</script>'; 
    header("location: asesor.php"); 
}

$procedure_params = array(

    array(&$myparams['fechaGestion'], SQLSRV_PARAM_IN),
    array(&$myparams['horaGestion'], SQLSRV_PARAM_IN),
    array(&$myparams['orden'], SQLSRV_PARAM_IN),
    array(&$myparams['servicio'], SQLSRV_PARAM_IN),
    array(&$myparams['casillero'], SQLSRV_PARAM_IN),
    array(&$myparams['casuistica'], SQLSRV_PARAM_IN),
    array(&$myparams['gestion'], SQLSRV_PARAM_IN),
    array(&$myparams['prueba'], SQLSRV_PARAM_IN),
    array(&$myparams['solucion'], SQLSRV_PARAM_IN),
    array(&$myparams['reprogramar'], SQLSRV_PARAM_IN),
    array(&$myparams['fechareprogramar'], SQLSRV_PARAM_IN),
    array(&$myparams['horarepro'], SQLSRV_PARAM_IN),
    array(&$myparams['fechabloque'], SQLSRV_PARAM_IN),
    array(&$myparams['bloque'], SQLSRV_PARAM_IN),
    array(&$myparams['obervaciones'], SQLSRV_PARAM_IN),
    array(&$myparams['estado'], SQLSRV_PARAM_IN),
    array(&$myparams['fechaupdate'], SQLSRV_PARAM_IN),
    array(&$myparams['horaupdate'], SQLSRV_PARAM_IN),
    array(&$myparams['id_base_principal'], SQLSRV_PARAM_IN),


);

    $query= "EXEC SPR_INSERT_TIPIFICACION_FINAL
    @fechaGestion=?,
    @horaGestion=?,
    @orden=?,
    @servicio=?,
    @casillero=?,
    @casuistica=?,
    @gestion=?,
    @prueba=?,
    @solucion=?,
    @reprogramar=?,
    @fechareprogramar=?,
    @horarepro=?,
    @fechabloque=?,
    @bloque=?,
    @obervaciones=?,
    @estado=?,
    @fechaupdate=?,
    @horaupdate=?,
    @id_base=?";

    $resultado = sqlsrv_query($conn, $query, $procedure_params);

    if(!$resultado){

       die("Query fallido");
    }
 
    if($_POST['gestion'] == "LLAMADO POSTERIOR"){
        //Consulta Tabla Principal, dependiendo del ID_BASE
        $id_base_carga=$_POST['id_base_principal'];
        $sqlquery="EXEC SPR_SELECT_TIPIFICACION_ANDES '$id_base_carga'";
        $row=sqlsrv_query($conn, $sqlquery);

         

        while ($nuevaCarga=sqlsrv_fetch_array($row, SQLSRV_FETCH_ASSOC)) {
            
            $BAS_NID_ANDES=$nuevaCarga['BAS_NID_ANDES'];
            $BAS_CID_SS_ANDES=$nuevaCarga['BAS_CID_SS_ANDES'];
            $BAS_CNUMERO_ORDEN_ANDES=$nuevaCarga['BAS_CNUMERO_ORDEN_ANDES'];
            $BAS_CLOGICA_ANDES=$nuevaCarga['BAS_CLOGICA_ANDES'];
            $BAS_CFECHA_ASIGNACION_ANDES=$nuevaCarga['BAS_CFECHA_ASIGNACION_ANDES'];
            $BAS_CFECHA_COMPOMISO_ANDES=$nuevaCarga['BAS_CFECHA_COMPOMISO_ANDES'];
            $BAS_CFRANJA_HORARIA_ANDES=$nuevaCarga['BAS_CFRANJA_HORARIA_ANDES'];
            $BAS_CRUT_CLIENTE_ANDES=$nuevaCarga['BAS_CRUT_CLIENTE_ANDES'];
            $BAS_CCIUDAD_LOCALIDAD_ANDES=$nuevaCarga['BAS_CCIUDAD_LOCALIDAD_ANDES'];
            $BAS_CCNC_ANDES=$nuevaCarga['BAS_CCNC_ANDES'];
            $BAS_CPUESTO_TRABAJO_ANDES=$nuevaCarga['BAS_CPUESTO_TRABAJO_ANDES'];
            $BAS_CPLATAFORMA_ANDES=$nuevaCarga['BAS_CPLATAFORMA_ANDES'];
           /*  $BAS_CDETALLE1_ANDES=$nuevaCarga['BAS_CDETALLE1_ANDES']; */


           /*  echo $BAS_CCIUDAD_LOCALIDAD_ANDES; */

            $gestion=$_POST['gestion'];    
            $fecharepro=date('d/m/Y',strtotime($_POST['fechareprogramar']));
            $horare=$_POST['horarepro'];
            $fechablo=$_POST['fechabloque'];
            $horablo=$_POST['bloque'];
            $horablo2 = '';
            if(isset($_POST['bloque2'])){
                $horablo2 = $horablo;
                $horablo = trim($_POST['bloque2']);
            }
            if ($id_base_carga==$BAS_NID_ANDES) {
            
                $queryserver=("EXEC SPR_INSERT_TIPIFICACION_ANDES 
                
                @ID_SS_NEW='$BAS_CID_SS_ANDES',
                @NUMERO_ORDEN_NEW='$BAS_CNUMERO_ORDEN_ANDES',
                @LOGICA_NEW='$gestion',
                @FECHA_ASIGNACION_NEW='$BAS_CFECHA_ASIGNACION_ANDES',
                @FECHA_COMPROMISO_NEW='$fecharepro',
                @HORA_NEW='$horare',
                @RUT_NEW='$BAS_CRUT_CLIENTE_ANDES',
                @CIUDAD_LOCALIDAD_NEW='$BAS_CCIUDAD_LOCALIDAD_ANDES',
                @CNC_NEW='$BAS_CCNC_ANDES',
                @PUESTO_TABAJO_NEW='$BAS_CPUESTO_TRABAJO_ANDES',
                @PLATAFORMA_NEW='$BAS_CPLATAFORMA_ANDES',
                @DETALLE1_NEW='Pendiente',
                @DETALLE4_NEW='$fechablo',
                @DETALLE5_NEW='$horablo'
                
                ");
    
                $resul=sqlsrv_query($conn,$queryserver);
                /* die(print_r(sqlsrv_errors(),true)); */
                
                
            }
    
            if(!$resul){
    
                die("Query fallido");
             }
                
        }


     
        //Leee Los Datos
        //Y Los Inserta Con Los Datos Nuevos, Fecga Agendamiento agenda., e inserta los de reprograma la llamda

        header("location:asesor.php"); 

    } 
    elseif($_POST['gestion'] == "SIN CONTACTO CON EL CLIENTE"){
        //Consulta Tabla Principal, dependiendo del ID_BASE
        
        $id_base_carga=$_POST['id_base_principal'];
        $sqlquery="EXEC SPR_SELECT_TIPIFICACION_ANDES '$id_base_carga'";
        $row=sqlsrv_query($conn, $sqlquery);

         

        while ($nuevaCarga=sqlsrv_fetch_array($row, SQLSRV_FETCH_ASSOC)) {
            
            $BAS_NID_ANDES=$nuevaCarga['BAS_NID_ANDES'];
            $BAS_CID_SS_ANDES=$nuevaCarga['BAS_CID_SS_ANDES'];
            $BAS_CNUMERO_ORDEN_ANDES=$nuevaCarga['BAS_CNUMERO_ORDEN_ANDES'];
            $BAS_CLOGICA_ANDES=$nuevaCarga['BAS_CLOGICA_ANDES'];
            $BAS_CFECHA_ASIGNACION_ANDES=$nuevaCarga['BAS_CFECHA_ASIGNACION_ANDES'];
            $BAS_CFECHA_COMPOMISO_ANDES=$nuevaCarga['BAS_CFECHA_COMPOMISO_ANDES'];
            $BAS_CFRANJA_HORARIA_ANDES=$nuevaCarga['BAS_CFRANJA_HORARIA_ANDES'];
            $BAS_CRUT_CLIENTE_ANDES=$nuevaCarga['BAS_CRUT_CLIENTE_ANDES'];
            $BAS_CCIUDAD_LOCALIDAD_ANDES=$nuevaCarga['BAS_CCIUDAD_LOCALIDAD_ANDES'];
            $BAS_CCNC_ANDES=$nuevaCarga['BAS_CCNC_ANDES'];
            $BAS_CPUESTO_TRABAJO_ANDES=$nuevaCarga['BAS_CPUESTO_TRABAJO_ANDES'];
            $BAS_CPLATAFORMA_ANDES=$nuevaCarga['BAS_CPLATAFORMA_ANDES'];
            /* $BAS_CDETALLE6_ANDES=$nuevaCarga['BAS_CDETALLE6_ANDES']; */


           /*  echo $BAS_CCIUDAD_LOCALIDAD_ANDES; */

            $OrdenContacto=$BAS_CNUMERO_ORDEN_ANDES;
            $sqlquery="SELECT COUNT(BAS_CNUMERO_ORDEN_ANDES) as Orden from TBL_RBASE_CARGAR_ANDES 
            where BAS_CNUMERO_ORDEN_ANDES = '$OrdenContacto' 
            AND BAS_CDETALLE6_ANDES = 'SIN CONTACTO CON EL CLIENTE'";
            $row2=sqlsrv_query($conn, $sqlquery);
            
            while($Contacto = sqlsrv_fetch_array($row2, SQLSRV_FETCH_ASSOC)){

                $ConClien = intval($Contacto['Orden']);

                /* echo $ConClien; */

                if($ConClien < 2){

                   
                    $gestion=$_POST['gestion'];
                    date_default_timezone_set('America/Bogota');    
                    $fechaHoy1 = date('Y-m-d');
                    $horaNew = new DateTime();
                    $horaNew2 = new DateTime();
                    $horaNew->modify('+1 hours');
                    $horaNew2->modify('+2hours');
                    $horaNewFinal = $horaNew->format('H:00:00').'-'.$horaNew2->format('H:00:00');
    
                    if ($id_base_carga==$BAS_NID_ANDES) {
                    
                       

                        $queryserver=("EXEC SPR_INSERT_TIPIFICACION_ANDES_SINCONTACTO 
                        
                        @ID_SS_NEWS_CONTACTO='$BAS_CID_SS_ANDES',
                        @NUMERO_ORDEN_NEWS_CONTACTO='$BAS_CNUMERO_ORDEN_ANDES',
                        @LOGICA_NEWS_CONTACTO='$BAS_CLOGICA_ANDES',
                        @FECHA_ASIGNACION_NEWS_CONTACTO='$BAS_CFECHA_ASIGNACION_ANDES',
                        @FECHA_COMPROMISO_NEWS_CONTACTO='$BAS_CFECHA_COMPOMISO_ANDES',
                        @HORA_NEWS_CONTACTO='$BAS_CFRANJA_HORARIA_ANDES',
                        @RUT_NEWS_CONTACTO='$BAS_CRUT_CLIENTE_ANDES',
                        @CIUDAD_LOCALIDAD_NEWS_CONTACTO='$BAS_CCIUDAD_LOCALIDAD_ANDES',
                        @CNC_NEWS_CONTACTO='$BAS_CCNC_ANDES',
                        @PUESTO_TABAJO_NEWS_CONTACTO='$BAS_CPUESTO_TRABAJO_ANDES',
                        @PLATAFORMA_NEWS_CONTACTO='$BAS_CPLATAFORMA_ANDES',
                        @DETALLE1_NEWS_CONTACTO='Pendiente',
                        @DETALLE4_NEWS_CONTACTO='$fechaHoy1',
                        @DETALLE5_NEWS_CONTACTO='$horaNewFinal',
                        @DETALLE6_NEWS_CONTACTO='$gestion'
                        ");  
            
                        $resul=sqlsrv_query($conn,$queryserver);
                        /* die(print_r(sqlsrv_errors(),true)); */
                        
                        
                    }
        
                    if(!$resul){
                        die( print_r( sqlsrv_errors(), true));
                       /*  die("Query fallido"); */
                    }
               }
    


            }


          
                
        }

        //Leee Los Datos
        //Y Los Inserta Con Los Datos Nuevos, Fecga Agendamiento agenda., e inserta los de reprograma la llamda

       header("location:asesor.php"); 

    } 
    

    
   header("location:asesor.php"); 
    


?>