<?php

require('conexion.php');

date_default_timezone_set('America/Santiago');
$fechaHoy = date('Y-m-d');

if(isset($_POST['ActualizarBase'])){

    $sqlsrv ="EXEC [SPR_UPDATE_BASE_CARGA] '".$fechaHoy."'";

    $result = sqlsrv_query($conn,$sqlsrv);

    if(!$result){

        die('Error al actualizar');
    }
    ?>
    <script>alert('Base Actualizada');window.location="TablaIndicadores_backoffice.php";</script>
    <?php

}

?>