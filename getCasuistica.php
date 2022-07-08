<?php
 require('conexion.php');

 $id_casuistica = $_POST['casillero'];

 $queryM = "EXEC [SPR_SELECT_CASUISTICA] '".$id_casuistica."'";
 $resultadoM = sqlsrv_query($conn, $queryM);
 $html= "<option value=''>Seleccione una opción...</option>";

 while($rowM = sqlsrv_fetch_array($resultadoM))
 {
     $html.= "<option value='".$rowM['CAS_CCASUISTICA']."'>".$rowM['CAS_CCASUISTICA']."</option>";
 }

 echo $html;

?>