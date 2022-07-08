<?php
include 'conexion.php';
date_default_timezone_set('America/Bogota');
 $horaBogota = date('H');
date_default_timezone_set('America/Santiago');
 $fechaHoy2 = date('Y/m/d');
 $hora = date('H');
 $horaHoy = date('H:i:s');
 
 $HoraTotalDiff = $hora-$horaBogota;

 $campana='VTR';

if (isset($_POST['switch'])){$switch = $_POST['switch'];}
if (isset($_POST['IdGestion'])){$IdResultado = $_POST['IdGestion'];}
if (isset($_POST['UsuariosArray'])){$UsuariosArray = $_POST['UsuariosArray'];}
if (isset($_POST['EstadosArray'])){$EstadosArray = $_POST['EstadosArray'];}
    /* $switch=$_POST['switche']; */
    

if($switch=="consultaCronometro"){
    /* $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:00:00'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdBase'"; */
    /* $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:00:00'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdBase2'"; */
    $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:00:00'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdResultado'";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['TIP_CTIEMPO'];
        }
    }
    echo $resp;
}elseif($switch=="consultaCronometro2"){
    $ArraySalida = array();
    for($i = 0;$i < count($IdResultado);$i++){
            $IdBase2 = $IdResultado[$i];
            $UsuariosArray2 = $UsuariosArray[$i];
            $EstadosArray2 = $EstadosArray[$i];
            if ($EstadosArray2 == 'Bano' || $EstadosArray2 == 'Break') {
                $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, CON_CDETALLE1+' '+CON_CDETALLE2, SYSDATETIME()), '23:51:03'), 108) AS TIP_CTIEMPO 
                FROM TBL_RCONEXION_BACK_OFFICE WHERE CON_CESTADO = '$EstadosArray2' AND CON_CFECHA_REGISTRO = '$fechaHoy2' and CON_CUSUARIO = '$UsuariosArray2'"; 
                /* $SprSql = "EXEC [SPR_GET_TIME_ESTADOS]  '"$EstadosArray2"', '".$fechaHoy2."', '".$UsuariosArray2."'";  */
            }elseif($IdResultado[$i] == "0" || $IdResultado[$i] == 0){
                $SprSql = 'Nada';
                /* $resp = "00:00:00"; */
            }else{
                $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:51:03'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdBase2'";
                /* $SprSql = "EXEC [SPR_GET_TIME_GESTION]  '".$IdBase2."'"; */
            }
            if($SprSql == 'Nada'){
                array_push($ArraySalida, "00:00:00");
                //array_push($ArraySalida, $EstadosArray2);
            }else{
                $stmt = sqlsrv_query($conn, $SprSql);
                $resp = "00:00:00";
                if($stmt==false){
                    
                }else{
                    while ($fila = sqlsrv_fetch_array($stmt)) {
                        $resp = $fila['TIP_CTIEMPO'];
                    }
                }
                array_push($ArraySalida, $resp);
                //array_push($ArraySalida, $SprSql);
            }
    }
    /*$SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:00:00'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdBase'";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['TIP_CTIEMPO'];
        }
    }*/
    echo json_encode($ArraySalida);
}
/* elseif($switch=="consultaCronometro1"){
    $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, CON_CFECHA_SESSION+' '+CON_CHORA_SESSION, SYSDATETIME()), '00:00:00'), 108) AS CON_CTIEMPO 
    FROM TBL_RCONEXION_BACK_OFFICE WHERE CON_CESTADO = 'Bano' and CON_CFECHA_REGISTRO='$fechaHoy' and CON_CUSUARIO='$CON_CUSUARIO'";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['CON_CTIEMPO'];
        }
    }
    echo $resp;
}elseif($switch=="consultaCronometro3"){
    $ArraySalida = array();
    for($i = 0;$i < count($CON_CUSUARIO);$i++){
        if($CON_CUSUARIO[$i] == "0" || $CON_CUSUARIO[$i] == 0){
            array_push($ArraySalida, "00:00:00");
        }else{
            $CON_CUSUARIO2 = $CON_CUSUARIO[$i];
            $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, CON_CFECHA_SESSION+' '+CON_CHORA_SESSION, SYSDATETIME()), '00:00:00'), 108) AS CON_CTIEMPO 
            FROM TBL_RCONEXION_BACK_OFFICE WHERE CON_CESTADO = 'Bano' and CON_CFECHA_REGISTRO='$fechaHoy' and CON_CUSUARIO='$CON_CUSUARIO2'";
            $stmt = sqlsrv_query($conn, $SprSql);
            $resp = "00:00:00";
            if($stmt==false){
                
            }else{
                while ($fila = sqlsrv_fetch_array($stmt)) {
                    $resp = $fila['CON_CTIEMPO'];
                }
            }
            array_push($ArraySalida, $resp);
        }
    }
    $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:00:00'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 = '$IdBase'";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['TIP_CTIEMPO'];
        }
    }
    echo json_encode($ArraySalida);
} */