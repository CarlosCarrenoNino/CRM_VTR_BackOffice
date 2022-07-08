<?php
include 'conexion.php';
date_default_timezone_set('America/Santiago');
 $fechaHoy = date('Y/m/d');
 $hora = date('H');
 $horaHoy = date('H:i:s');

 $campana='VTR';

if (isset($_POST['switche'])) $switch=$_POST['switche'];


if ($switch=="Obtener_Fecha_Inicial") {
    //echo ["fechaHoy"=>$fechaHoy,"horaHoy"=>$horaHoy];
    $resp = ['mens'=>$fechaHoy,
    'datos'=>$horaHoy];
    echo json_encode($resp);
}