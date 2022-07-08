<?php

include 'conexion.php';
date_default_timezone_set('America/Bogota');
$horaBogota = date('H');
 $minutoBogota=date('i');
 $segundosBogota=date('s');
 $Bogotahora = new DateTime();
 $Bogotahora->modify('+0 hours');
 $Bogotaminuto = new DateTime();
 $Bogotaminuto->modify('+1 minute');
 $Bogotasegundo = new DateTime();
 $Bogotasegundo->modify('+37 second');
/* echo $Bogotaminuto->format('H:i:s');  */
date_default_timezone_set('America/Santiago');
 $fechaHoy = date('Y/m/d');
 $hora = date('H');
 $minuto=date('i');
 $segundos=date('s');

 /* $horaHoy = date('H:i:s');
 $timeda=date('01:58:33'); */
 
 $HoraTotalDiff = $hora-$horaBogota;
 /* $Horatotal = $HoraTotalDiff-$timeda;*/
 $MinutTotalDiff= $minuto-$minutoBogota;
 $SegunTotlaDiff= $segundos-$segundosBogota;

/*  echo $hora-$horaBogota; */
/*     echo $minuto-$minutoBogota; */

 session_start();
 $asesor= $_SESSION['UsuarioIngreso'];

 $campana='VTR';

if (isset($_POST['switch'])){$switch = $_POST['switch'];}
if (isset($_POST['IdGestion'])){$EstadoConexion = $_POST['IdGestion'];}
    /* $switch=$_POST['switche']; */
    

if($switch=="ConsultarCronometroBano"){
    $SprSql = "SELECT CONVERT(char(8), DATEADD(SECOND, DATEDIFF(SECOND, CON_CDETALLE1+' '+CON_CDETALLE2, SYSDATETIME()), '23:51:03'), 108) AS CON_CTIEMPO 
    FROM TBL_RCONEXION_BACK_OFFICE WHERE CON_CESTADO = '$EstadoConexion' AND CON_CFECHA_REGISTRO = '$fechaHoy' and CON_CUSUARIO='$asesor'";
    $stmt = sqlsrv_query($conn, $SprSql);
    $resp = "00:00:00";
    if($stmt==false){
        
    }else{
        while ($fila = sqlsrv_fetch_array($stmt)) {
            $resp = $fila['CON_CTIEMPO'];
        }
    }
    echo $resp;
}
