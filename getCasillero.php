<?php
 require('conexion.php');

 $id_servicio = $_POST['servicio'];

 $queryM = "exec [SPR_SELECT_CASILLERO] '".$id_servicio."'";
 $resultadoM = sqlsrv_query($conn, $queryM);
 $html= "<option value=''>Seleccione una opción...</option>";

 while($rowM = sqlsrv_fetch_array($resultadoM))
 {
     $html.= "<option value='".$rowM['CAS_CCASILLERO']."'>".$rowM['CAS_CCASILLERO']."</option>";
 }

 echo $html;

?>