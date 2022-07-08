<?php
session_start();
include('conexion.php');

date_default_timezone_set('America/Santiago');
$fechaHoy = date('Y/m/d');
$fechanueva = date('Y-m-d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

if(isset($_SESSION['UsuarioIngreso'])) {
    $sUsario0 = $_SESSION['UsuarioIngreso'];
    $SprSql = "EXEC SPR_SELECT_CONEXION_ACTIVIDAD_USER '".$sUsario0."', '".$fechaHoy."', 'Activo'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query($conn, $SprSql, $params, $options);
    if($stmt==false){
        //echo 'Error';
    }else{
        $fila4 = sqlsrv_fetch_array($stmt);
        $USE_NCOUNT = $fila4['USE_NCOUNT'];
        if($USE_NCOUNT>= 1){
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); 
            $slqsrv="SELECT COUNT(BAS_CFECHA_COMPOMISO_ANDES) FROM TBL_RBASE_CARGAR_ANDES WHERE BAS_CDETALLE1_ANDES = 'Pendiente' GROUP BY BAS_CFECHA_COMPOMISO_ANDES ORDER BY CONVERT(DATE, BAS_CFECHA_COMPOMISO_ANDES, 103) ";
            $stmt = sqlsrv_query($conn, $slqsrv, $params, $options);
                    
            $fechaAgenga = sqlsrv_num_rows($stmt);
            $SprSql = "EXEC SPR_SELECT_BASE_CARGA '$sUsario0', 'Pendiente','$fechanueva','$fechaAgenga'";

            /* $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); */
            $stmt = sqlsrv_query($conn, $SprSql);
            $NumeroDeFilas = sqlsrv_num_rows($stmt);
            if($stmt== false){
                //echo 'Error';
            }else{
                if($NumeroDeFilas>=1){
                    echo "HayCasos";
                }
            }
        }
    }
}else{

}

?>