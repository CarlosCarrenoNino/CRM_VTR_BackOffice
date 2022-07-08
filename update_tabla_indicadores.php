<?php
    include('conexion.php');
    date_default_timezone_set('America/Santiago');
    $fechaHoy1 = date('Y/m/d');
    $horaHoy = date('H');
    $minutoHoy = date('i');
    $HoraTotal = $horaHoy.':'.$minutoHoy;
    session_start();
    $asesores=$_SESSION['UsuarioIngreso'];
                                                
   if(isset($_GET['BAS_NID_ANDES'])){
        $idbase = $_GET['BAS_NID_ANDES'];
        $querybase = "EXEC [SPR_SELECT_IDBASE_CARGA] '".$idbase."'";
        $result= sqlsrv_query($conn, $querybase);

        if(sqlsrv_num_rows($result) ==1){

            $row = sqlsrv_fetch_array($result);
            $title = $row['BAS_CDETALLE1_ANDES'];
            /* $usario = $row['BAS_CDETALLE4_ANDES'];  */
            
        
        }
    } 


    if(@$_POST['BtnEliminar']){

        foreach($_POST['IdBase'] as $IdBaseAn){

            /* $idbase = $_POST['id_new']; */
           $title = $_POST['estado'];
            
        
            /* $query = "EXEC [SPR_UPDATE_CANCELAR_IDBASE] 'Cancelado','$asesores','$idbase'";  */
            $query = "UPDATE TBL_RBASE_CARGAR_ANDES SET BAS_CDETALLE1_ANDES ='".$title."', 
            BAS_CDETALLE6_ANDES ='".$asesores."', BAS_CDETALLE7_ANDES ='".$fechaHoy1."', 
            BAS_CDETALLE8_ANDES ='".$HoraTotal."'  WHERE BAS_NID_ANDES ='".$IdBaseAn."'";
            sqlsrv_query($conn, $query);
        
           
        }

        
        ?>
        <script>alert('Actualizado Cambio A Los Estados');window.location="TablaIndicadores.php";</script>

        <?php
    }


    /* if(isset($_POST['update'])){

        $idbase = $_POST['id_new'];
        $title = $_POST['estado'];
        
    
        $query = "EXEC [SPR_UPDATE_CANCELAR_IDBASE] 'Cancelado','$asesores','$idbase'"; 
        $query = "UPDATE TBL_RBASE_CARGAR_ANDES SET BAS_CDETALLE1_ANDES ='$title', BAS_CDETALLE6_ANDES ='$asesores', BAS_CDETALLE7_ANDES ='$fechaHoy1', BAS_CDETALLE8_ANDES ='$HoraTotal'  WHERE BAS_NID_ANDES ='$idbase'";
        sqlsrv_query($conn, $query);
    
        ?>
        <script>alert('Actualizado');window.location="TablaIndicadores.php";</script>
        <?php 
    } */

?>