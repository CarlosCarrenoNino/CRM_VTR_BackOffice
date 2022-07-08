<?php

    session_start();
    require('conexion.php');
    require('css/styles.css');
    date_default_timezone_set('America/Santiago');
    $fechaHoy = date('d/m/Y');
    $fechaHoy = date('Y/m/d');
    $horaHoy = date('H:i:s');
  
  
    $asesor= $_SESSION['UsuarioIngreso'];
    $Estado = $_POST['switche'];
    $Count;

    if($Estado=='SALIDA'){
        
        /* $query="EXEC [SPR_UPDATE_CONEXION_SALIDA] '".$fechaHoy."' , '".$horaHoy."' , 'Inactivo' , '".$asesor."' , '".$fechaHoy."' ";
        sqlsrv_query($conn,$query); */
        sqlsrv_query($conn,"UPDATE TBL_RCONEXION_BACK_OFFICE SET CON_CFECHA_SESSION='$fechaHoy', CON_CHORA_SESSION='$horaHoy', CON_CESTADO_SESSION='Inactivo' WHERE CON_CUSUARIO='$asesor' AND CON_CFECHA_REGISTRO = '$fechaHoy'");

    }







    /* if($Estado=='SESION'){

        $sql = sqlsrv_query($conn,"EXEC SPR_SELEC_RCONEXION '".$asesor."' ");
        
        $stmt=sqlsrv_fetch_array($sql);
        if($stmt['CON_CESTADO']==null || ['CON_CESTADO']==' ' || ['CON_CESTADO']=='Activo') {
        sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON '".$fechaHoy."' , '".$HoraTotal."', 'Inactivo' , '".$asesor."' ");
        }else{
            sqlsrv_query($conn,"EXEC SPR_UPDATE_ACTIVO_ASESOR_BOTON '".$fechaHoy."' , '".$HoraTotal."' , 'Activo' , '".$asesor."' ");
        }
    
     } */
    
    
    
    
    
?>

