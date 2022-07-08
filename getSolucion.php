<?php
 require('conexion.php');

 $id_servicio = $_POST['servicio'];

 $queryM = "exec [SPR_SELECT_SOLUCION] '".$id_servicio."'";
 $resultadoM = sqlsrv_query($conn, $queryM);
 $html= "<option value=''>Seleccione...</option>";

 while($rowM = sqlsrv_fetch_array($resultadoM))
 {
     $html.= "<option value='".$rowM['SOL_CSOLUCION']."'>".$rowM['SOL_CSOLUCION']."</option>";
 }

 echo $html;

?>