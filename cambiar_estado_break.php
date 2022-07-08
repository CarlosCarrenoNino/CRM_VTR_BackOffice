<?php

    session_start();
    require('conexion.php');
    require('css/styles.css');
    date_default_timezone_set('America/Bogota');
   /*  $fechaHoy = date('d/m/Y'); */
    $fechaHoy = date('Y/m/d');
    $horaHoy = date('H:i:s');


    $asesor= $_SESSION['UsuarioIngreso'];
    $Estado = $_POST['switche'];
    $Count;

    if($Estado=='BREAK'){

        $params=array();
        $options=array("Scrollable"=>SQLSRV_CURSOR_KEYSET);
        $sql = sqlsrv_query($conn, "EXEC SPR_SELEC_RCONEXION '".$asesor."' , '".$fechaHoy."' ",$params,$options);

        $stmt=sqlsrv_fetch_array($sql);

        
        if ($stmt['CON_CESTADO']=='Activo') {
            sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON_DES '".$fechaHoy."' , '".$horaHoy."' , 'Break' , '".$asesor."' ");
            
            

        }elseif($stmt['CON_CESTADO']=='Inactivo'){
            sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON_DES '".$fechaHoy."' , '".$horaHoy."' , 'Break' , '".$asesor."' ");
   
        }elseif($stmt['CON_CESTADO']=='Bano'){
            sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON_DES '".$fechaHoy."' , '".$horaHoy."' , 'Break' , '".$asesor."' ");
   
        }elseif($stmt['CON_CESTADO']==null){
            sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON_DES '".$fechaHoy."' , '".$horaHoy."' , 'Break' , '".$asesor."' ");
 
        }

        
    

    }

    
?>