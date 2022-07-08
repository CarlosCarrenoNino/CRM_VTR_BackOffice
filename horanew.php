<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

require('conexion.php');

date_default_timezone_set('America/Bogota');
$fechaHoy1 = date('Y-m-d');
$horaNew = new DateTime();
$horaNew2 = new DateTime();
$horaNew->modify('+1 hours');
$horaNew2->modify('+2hours');

$horaNewFinal = $horaNew->format('H:00:00').'-'.$horaNew2->format('H:00:00');

echo $horaNewFinal;

echo "<br>";

$sqlquery="SELECT COUNT(BAS_CNUMERO_ORDEN_ANDES) as Orden from TBL_RBASE_CARGAR_ANDES 
where BAS_CNUMERO_ORDEN_ANDES = '1-188123561824' AND BAS_CDETALLE6_ANDES = 'SIN CONTACTO CON EL CLIENTE'";
$row2=sqlsrv_query($conn, $sqlquery);


while($Contacto = sqlsrv_fetch_array($row2))
{

    $Cliente = intval($Contacto['Orden']);


    echo $Cliente;
    
}



?>
    
</body>
</html>