<?php
include 'conexion.php';
date_default_timezone_set('America/Bogota');
 $horaBogota = date('H');
date_default_timezone_set('America/Santiago');
 $fechaHoy = date('Y/m/d');
 $hora = date('H');
 $horaHoy = date('H:i:s');
 
 $HoraTotalDiff = $hora-$horaBogota; 
 //echo $hora-$horaBogota;

 $campana='VTR';

if (isset($_POST['switch'])){$switch = $_POST['switch'];}
if (isset($_POST['IdGestion'])){$BAS_NID_ANDES = $_POST['IdGestion'];}
    /* $switch=$_POST['switche']; */
    

if($switch=="consultaCronometro"){
    $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, TIP_CDETALLE2+' '+TIP_CDETALLE3, SYSDATETIME()), '00:51:03'), 108) AS TIP_CTIEMPO FROM TBL_RTIPIFICACION_BACK_OFFICE WHERE TIP_CDETALLE7 =$BAS_NID_ANDES";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['TIP_CTIEMPO'];
        }
    }
    echo $resp;
}





