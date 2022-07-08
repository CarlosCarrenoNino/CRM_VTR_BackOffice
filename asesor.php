<?php
date_default_timezone_set('America/Santiago');
$fechaHoy = date('d/m/Y');
$fechaHoy1 = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i');
$HoraTotal = $horaHoy.':'.$minutoHoy;

/* echo($HoraTotal); */

session_start();

require('conexion.php');


$asesor= $_SESSION['UsuarioIngreso'];

if(isset($_SESSION['UsuarioIngreso'])) {
    $Privilegio = $_SESSION["PrivilegioUsuario"];
    if ($Privilegio == "1" or $Privilegio == "22" or $Privilegio == "21"){

    }else{
        echo '<script> window.location="logout.php"; </script>';
    }
}else{
    echo '<script> window.location="logout.php"; </script>';
}
                
        $params=array();
        $options=array("Scrollable"=>SQLSRV_CURSOR_KEYSET);
        $sql = sqlsrv_query($conn, "EXEC SPR_SELEC_RCONEXION '".$asesor."' , '".$fechaHoy1."' ",$params,$options);
        

        $CuentaTotal = sqlsrv_num_rows($sql);
        $EstadoConexion = 'Inactivo';
        while($filaCone = sqlsrv_fetch_array($sql)){
            $EstadoConexion = $filaCone['CON_CESTADO'];
        }
        if ($CuentaTotal > 0) {
            sqlsrv_query($conn,"EXEC SPR_UPDATE_CONEXION_ASESOR '".$fechaHoy1."' , '".$HoraTotal."' , 'Activo' , '".$asesor."' ");
        } else {
            sqlsrv_query($conn,"EXEC SPR_INSERT_CONEXION_ASESOR '".$asesor."' , '".$fechaHoy1."' , '".$HoraTotal."' , 'Activo' ");
        }

?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>VTR | BACK-OFFICE </title>
        <link rel="icon" href="vtricono.ico" type="image/x-ico">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        

        <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">

        
        <!-- <link rel="stylesheet" href="../assets/vendor/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="../assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
        <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css"> 
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/color_skins.css"> -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/Chart.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        <script src ="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        <script>
                function ejecutar() {

                    var switche = 'SALIDA'
                    console.log('SE EJECUTA LA FUNCION "ejecutar"');
                    $.ajax({
                        type: 'POST',
                        url: 'conexion_asesor.php',
                        data: {
                            'switche': switche
                        },
                    })
                    sleep(5000)
                }
                window.addEventListener("beforeunload", function(e) {
                    ejecutar();
                    (e || window.event).returnValue = null;
                    return null;
                });
        </script>

            <script language="JavaScript">
                var salir=true;

                /* alert("Para salir del WEB desactiva y cierra sesion."); */
                function cambiarvalor()
                {
                salir=false;
                
                }
                
                function antesdecerrar()
                {
                if (salir==true)
                {
                return 'Esta accion perdera los cambios hechos a la pagina si no guardas!!!!!';
                }
                
                }
            </script>


           <!-- <script>
               tragar ( {
                title : " ¿Estás seguro? " , 
                texto : " Una vez eliminado, ¡no podrás recuperar este archivo imaginario! " , 
                icono : " advertencia " , 
                botones : cierto , 
                dangerMode : verdadero , 
                } )
                . entonces ( ( willDelete ) =>  { 
                if ( willDelete ) {  
                    swal ( " ¡ Puf ! ¡Tu archivo imaginario ha sido eliminado! " , { 
                    icono : " éxito " , 
                    } ) ;
                } más {  
                    swal ( "¡ Tu archivo imaginario está seguro! " ) ;
                }
                } ) ;
           </script>     
 -->
<!--  topmargin="0" marginheight="0" onBeforeUnload="return antesdecerrar()" -->
    </head>
    <body class="sb-nav-fixed" >
    <!-- <p><a href="asesor.php" onclick="cambiarvalor()" ></a></p> -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            <!-- Navbar Brand-->
            <img src="" alt=""><a class="navbar-brand ps-3" href="asesor.php"><b>VTR Back-Office</b> </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar--> 
            <!-- <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Cerrar Sesión</a></li>
                    </ul> 
                </li>
            </ul> -->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MENÚ</div>
                            <div style="text-align:center;padding:0px;"> <h5><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/city/3871336"></a></h5> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FSantiago" width="100%" height="90" frameborder="0" seamless></iframe> </div>
                            <a class="nav-link" href="asesor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Asesor <?php echo $_SESSION["UsuarioIngreso"] ?>
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaces</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Usuario
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse1" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- <a class="nav-link" href="index.php">Supervisor</a> -->
                                    <a href="javascript:void(0);" Style="text-decoration:none;">
                                                                        
                                        <form id="Cambiar_estados_boton">
                                                <div class="bd-example">
                                                    <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                                        <input type="radio" class="btn-check" name="radio1" id="vbtn-radio1" value="Activo" onclick="estadoActivo(); location.reload();" >
                                                        <label class="btn btn-outline-danger" for="vbtn-radio1">ACTIVAR</label>
                                                        <input type="radio" class="btn-check" name="radio2" id="vbtn-radio2" value="Inactivo" onclick="estadoInactivo(); location.reload();">
                                                        <label class="btn btn-outline-danger" for="vbtn-radio2">DESACTIVAR</label>
                                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" onclick="estadoBano(); location.reload();">
                                                        <label class="btn btn-outline-danger" for="vbtn-radio3">BAÑO</label>
                                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4" onclick="estadoBreak(); location.reload();">
                                                        <label class="btn btn-outline-danger" for="vbtn-radio4">BREAK</label>
                                                        <?php
                                                        if($EstadoConexion == "Activo"){
                                                            echo "<script>document.getElementById('vbtn-radio1').checked=true;</script>";
                                                        }elseif($EstadoConexion == "Bano"){
                                                            echo "<script>document.getElementById('vbtn-radio3').checked=true;</script>";
                                                        }elseif($EstadoConexion == "Break"){
                                                            echo "<script>document.getElementById('vbtn-radio4').checked=true;</script>";
                                                        }else{
                                                            echo "<script>document.getElementById('vbtn-radio2').checked=true;</script>";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                        </form>
                                    </a>
                                    <a class="nav-link" href="login.php">Cerrar Sesión</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed1" href="#" data-bs-toggle="collapse1" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                
                            </a>
                        
                            
                            <!-- <div class="sb-sidenav-menu-heading">Skill</div>
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Asignar Skill
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> 
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#asignarSkill" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                       Asesores
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="">Modal</a>
                                            
                                        </nav>
                                    </div> 
                                    
                                </nav>
                            </div> -->
                            <!-- <div class="sb-sidenav-menu-heading">Informes</div>
                            <a class="nav-link" href="base.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Bases
                            </a> -->
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                        Conectado a: <br>
                        VTR Back-Office
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Visual | Efectividad</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Supervisor</li>
                        </ol> -->
                        <br>
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                    
                                       <!--  <h4>Descargar Informes</h4> -->
                                        <table border="2" class="table m-b-0 table-hover" id="">
                                            <thead>
                                                <tr>
                                                    <th><b>NUMERO DE ORDEN</b></th>
                                                    <th><b>RUT</b></th>
                                                    <th><b>CASILLERO</b></th>
                                                    <th><b>COMUNA</b></th>
                                                    <th><b>PLATAFORMA</b></th>
                                                    <th><b>FECHA AGENDAMIENTO</b></th>
                                                    <th><b>AGENDA</b></th>

                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <?php
                                                        date_default_timezone_set('America/Santiago');
                                                        $fechaHoy = date('Y/m/d');
                                                                                                                                                                       
                                                        date_default_timezone_set('America/Santiago');
                                                        $fechaHoy1 = date('Y/m/d');
                                                        $fechanueva = date('Y-m-d');
                                                        $horaHoy = date('H');
                                                        $minutoHoy = date('i:s');
                                                        $HoraTotal = $horaHoy.':'.$minutoHoy;
                                                        $BAS_NID_ANDES = 0;

                                                        $sUsario0=$_SESSION["UsuarioIngreso"];
                                                        $SprSql = "EXEC [SPR_SELECT_DATOS_TIPIFICACION] '".$sUsario0."','Asignado'";
                                                        $params = array();
                                                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                                                        $stmt = sqlsrv_query($conn, $SprSql, $params, $options);
                                                        $Fila = sqlsrv_num_rows($stmt);
                                                        if($Fila>=1){
                                                            $fila2 = sqlsrv_fetch_array($stmt);
                                                            $TIP_CNUMERO_SOLICITU = $fila2['TIP_CNUMERO_SOLICITU'];
                                                            $TIP_CRUT = $fila2['TIP_CRUT'];
                                                            $TIP_CLOGICA = $fila2['TIP_CLOGICA'];
                                                            $TIP_CIUDAD = $fila2['TIP_CIUDAD'];
                                                            $TIP_CPLATAFORMA = $fila2['TIP_CPLATAFORMA'];
                                                            $TIP_CFECHA_AGENDA = $fila2['TIP_CFECHA_AGENDA'];
                                                            $TIP_CHORA = $fila2['TIP_CHORA'];
                                                            $BAS_NID_ANDES = $fila2['TIP_CDETALLE7'];
                                                            

                                                            echo "<td>".$TIP_CNUMERO_SOLICITU."</td>";
                                                            echo "<td>".$TIP_CRUT."</td>";
                                                            echo "<td>".$TIP_CLOGICA."</td>";
                                                            echo "<td>".$TIP_CIUDAD."</td>";
                                                            echo "<td>".$TIP_CPLATAFORMA."</td>";
                                                            echo "<td>".$TIP_CFECHA_AGENDA."</td>";
                                                            echo "<td>".$TIP_CHORA."</td>";

                                                            /* $SprSql = "EXEC SPR_SELECT_CONEXION_ACTIVIDAD_USER'".$sUsario0."', '".$fechaHoy."', 'Activo'";
                                                            $params = array();
                                                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                                                            $stmt = sqlsrv_query($conn, $SprSql, $params, $options);
                                                            if($stmt==false){
                                                                echo '<script> alert("Error Al Consultar La Base 0.");</script>';
                                                            }else{
                                                                $fila4 = sqlsrv_fetch_array($stmt);
                                                                $USE_NCOUNT = $fila4['USE_NCOUNT'];
                                                                if($USE_NCOUNT>=1){
                                                                    echo "<script>document.getElementById('btn-update-activated').classList.add('btn-success'); document.getElementById('btn-update-activated').classList.remove('btn-warning'); document.getElementById('send-estado-send-user').innerText='Activo'; document.getElementById('send-estado-send-user').value='Activo';</script>";
                                                                }
                                                            } */
                                                        }else{
                                                            $SprSql = "EXEC SPR_SELECT_CONEXION_ACTIVIDAD_USER '".$sUsario0."', '".$fechaHoy1."', 'Activo'";
                                                            /* $params = array();
                                                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); */
                                                            $stmt = sqlsrv_query($conn, $SprSql);
                                                            if($stmt==false){
                                                                echo '<script> alert("Error Al Consultar La Base 0.");</script>';
                                                            }else{
                                                                $fila4 = sqlsrv_fetch_array($stmt);
                                                                $USE_NCOUNT = $fila4['USE_NCOUNT'];
                                                                if($USE_NCOUNT>=1){
                                                                    /* echo "<script>document.getElementById('btn-update-activated').classList.add('btn-success'); document.getElementById('btn-update-activated').classList.remove('btn-warning'); document.getElementById('send-estado-send-user').innerText='Activo'; document.getElementById('send-estado-send-user').value='Activo';</script>";
                                                                    */

                                                                    $ArrayFranja = ['10:00:00-13:00:00', '13:00:00-16:00:00', '16:00:00-19:00:00', '19:00:00-22:00:00'];
                                                                    $NumeroDeFilas1 = 0;

                                                                    $SprsqlSkill = "SELECT SKI_NID, SKI_ASESOR, SKI_SKILLS, SKI_PLATAFORMA FROM TBL_RSKILL WHERE SKI_ASESOR = '$sUsario0'  AND SKI_SKILLS = 'MASIVOS ACTIVOS'";
                                                                    //echo $SprsqlSkill."<br>";
                                                                    $stmtSkill = sqlsrv_query($conn, $SprsqlSkill);
                                                                    if($stmtSkill==false){
                                                                        echo'<script> alert("Error Al consultar Masivos Activos.");</script>';
                                                                    }else{
                                                                            $params = array();
                                                                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); 
                                                                            $slqsrv="SELECT COUNT(BAS_CFECHA_COMPOMISO_ANDES) FROM TBL_RBASE_CARGAR_ANDES WHERE BAS_CDETALLE1_ANDES = 'Pendiente' GROUP BY BAS_CFECHA_COMPOMISO_ANDES ORDER BY CONVERT(DATE, BAS_CFECHA_COMPOMISO_ANDES, 103) ";
                                                                            $stmt = sqlsrv_query($conn, $slqsrv, $params, $options);
                                                                                    
                                                                            $fechaAgenga = sqlsrv_num_rows($stmt);
                                                                            //echo "fechaAgenga: ".$fechaAgenga;

                                                                            while($rowSqlSkill = sqlsrv_fetch_array($stmtSkill)){
                                                                                $SKI_PLATAFORMA = $rowSqlSkill['SKI_PLATAFORMA'];

                                                                                /*$params = array();
                                                                                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); 
                                                                                $slqsrv="SELECT COUNT(BAS_CFECHA_COMPOMISO_ANDES) FROM TBL_RBASE_CARGAR_ANDES WHERE BAS_CDETALLE1_ANDES = 'Pendiente' GROUP BY BAS_CFECHA_COMPOMISO_ANDES ORDER BY CONVERT(DATE, BAS_CFECHA_COMPOMISO_ANDES, 103) ";
                                                                                $stmt = sqlsrv_query($conn, $slqsrv, $params, $options);
                                                                                        
                                                                                $fechaAgenga = sqlsrv_num_rows($stmt);*/

                                                                                /* for($i = 0; $i<=(count($ArrayFranja)-1); $i++){ */
                                                                                    $SprsqlNjgu = "EXEC SPR_SEL_BASE_CARGA_MASIVOS_ACTIVOS 'NJUG', 'Pendiente', '$SKI_PLATAFORMA', '$fechaAgenga'";
                                                                                    //echo $SprsqlNjgu;
                                                                                    $stmt = sqlsrv_query($conn, $SprsqlNjgu);
                                                                                    if($stmt==false){
                                                                                        echo'<script> alert("Error Al consultar Masivos Activos.");</script>';
                                                                                        break;
                                                                                    }else{
                                                                                        $NumeroDeFilas1 = 0;
                                                                                        //$SalidaDelwhile = "False";
                                                                                        while($rowSql = sqlsrv_fetch_array($stmt)){
                                                                                            $NumeroDeFilas1 = $rowSql['BAS_NID_ANDES'];
                                                                                            /* $BAS_CDETALLE4_ANDES = $rowSql['BAS_CDETALLE4_ANDES'];
                                                                                            $BAS_CDETALLE5_ANDES = $rowSql['BAS_CDETALLE5_ANDES'];
                                                                                            $BAS_CDETALLE6_ANDES = $rowSql['BAS_CDETALLE6_ANDES'];
                                                                                            $BAS_CFECHA_COMPOMISO_ANDES = $rowSql['BAS_CFECHA_COMPOMISO_ANDES'];
                                                                                                                                                                                    
                                                                                            
                                                                                            if($BAS_CDETALLE6_ANDES != "SIN CONTACTO CON EL CLIENTE"){
                                                                                                if($NumeroDeFilas1 >= 1){
                                                                                                    $SalidaDelwhile = "True";
                                                                                                    break; 
                                                                                                }
                                                                                            }elseif($BAS_CDETALLE6_ANDES == "SIN CONTACTO CON EL CLIENTE"){
                                                                                                if($BAS_CDETALLE4_ANDES == $fechaHoy){
                                                                                                    $horaHoy = date('H');
                                                                                                    for($nDia = 1; $nDia <= $horaHoy;$nDia++){
                                                                                                        if(strpos($BAS_CDETALLE5_ANDES, ":".$nDia) != false){
                                                                                                            $SalidaDelwhile = "True";
                                                                                                            break;
                                                                                                        }
                                                                                                    }
                                                                                                    if($SalidaDelwhile == "True"){
                                                                                                        break;
                                                                                                    } 
                                                                                                }

                                                                                                echo $NumeroDeFilas1;
                                                                                            } */
                                                                                        }
                                                                                        /* if($SalidaDelwhile == "True"){
                                                                                            break;
                                                                                        }  */
                                                                                    }
                                                                                /* } */
                                                                            }

                                                                    }

                                                                    if($NumeroDeFilas1 >= 1){
                                                                    }else{
                                                                        $params = array();
                                                                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); 
                                                                        $slqsrv="SELECT COUNT(BAS_CFECHA_COMPOMISO_ANDES) FROM TBL_RBASE_CARGAR_ANDES WHERE BAS_CDETALLE1_ANDES = 'Pendiente' GROUP BY BAS_CFECHA_COMPOMISO_ANDES ORDER BY CONVERT(DATE, BAS_CFECHA_COMPOMISO_ANDES, 103) ";
                                                                        $stmt = sqlsrv_query($conn, $slqsrv, $params, $options);
                                                                                
                                                                        $fechaAgenga = sqlsrv_num_rows($stmt); 

                                                                        $SprSql = "EXEC SPR_SELECT_BASE_CARGA '$sUsario0', 'Pendiente','$fechanueva','$fechaAgenga'";//Procedimiento Largo
                                                                        /* $params = array();
                                                                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); */
                                                                        $stmt = sqlsrv_query($conn, $SprSql);
                                                                        //$NumeroDeFilas = sqlsrv_num_rows($stmt);
                                                                    }
                                                                    if($stmt==false){
                                                                        echo '<script> alert("Error Al Consultar La Base 1.");</script>';
                                                                    }else{
                                                                        $NumeroDeFilas = 0;
                                                                        if($NumeroDeFilas1 >= 1){
                                                                            $NumeroDeFilas = $NumeroDeFilas1;
                                                                        }else{
                                                                            while($rowSql = sqlsrv_fetch_array($stmt)){
                                                                                $NumeroDeFilas = $rowSql['BAS_NID_ANDES'];
                                                                            }
                                                                        }
                                                                        if($NumeroDeFilas >= 1){
                                                                            /* echo '<script> alert("'.$NumeroDeFilas.'");</script>'; */
                                                                            //$fila = sqlsrv_fetch_array($stmt);
                                                                            $IdValidate = $NumeroDeFilas;
                                                                            $SprSql = "EXEC SPR_UPDATE_BASE '".$IdValidate."', '".$fechaHoy."', '".$HoraTotal."', '$sUsario0', 'Pendiente'";//CAMBIA EL ESTADO AL USUARIO DEL ASESOR
                                                                            $stmt = sqlsrv_query($conn, $SprSql);

                                                                            $SprSql = "EXEC SPR_SELECT_CONFIRMAR_BASE '".$IdValidate."'";
                                                                            $params = array();
                                                                            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                                                                            $stmtConfirmeData = sqlsrv_query($conn, $SprSql);
                                                                            if ($stmtConfirmeData==false){
                                                                                echo '<script> alert("Error Al Consultar La Base 2.");</script>';
                                                                            }else{
                                                                                $fila = sqlsrv_fetch_array($stmtConfirmeData);

                                                                                $BAS_NID_ANDES = $fila['BAS_NID_ANDES'];
                                                                                $BAS_CID_SS_ANDES = $fila['BAS_CID_SS_ANDES'];
                                                                                $BAS_CNUMERO_ORDEN_ANDES = $fila['BAS_CNUMERO_ORDEN_ANDES'];
                                                                                $BAS_CLOGICA_ANDES = $fila['BAS_CLOGICA_ANDES'];
                                                                                $BAS_CFECHA_ASIGNACION_ANDES = $fila['BAS_CFECHA_ASIGNACION_ANDES'];
                                                                                $BAS_CFECHA_COMPOMISO_ANDES = $fila['BAS_CFECHA_COMPOMISO_ANDES'];
                                                                                $BAS_CFRANJA_HORARIA_ANDES = $fila['BAS_CFRANJA_HORARIA_ANDES'];
                                                                                $BAS_CRUT_CLIENTE_ANDES = $fila['BAS_CRUT_CLIENTE_ANDES'];
                                                                                $BAS_CCIUDAD_LOCALIDAD_ANDES = $fila['BAS_CCIUDAD_LOCALIDAD_ANDES'];
                                                                                $BAS_CCNC_ANDES = $fila['BAS_CCNC_ANDES'];
                                                                                $BAS_CPUESTO_TRABAJO_ANDES = $fila['BAS_CPUESTO_TRABAJO_ANDES'];
                                                                                $BAS_CPLATAFORMA_ANDES = $fila['BAS_CPLATAFORMA_ANDES'];
                                                                                $BAS_CDETALLE1_ANDES = $fila['BAS_CDETALLE1_ANDES'];
                                                                                /*$BAS_CDETALLE4_ANDES = $_SESSION['UsuarioIngreso'];
                                                                                $BAS_CDETALLE2_ANDES = $fechaHoy;
                                                                                $BAS_CDETALLE3_ANDES = $horaHoy.':'.$minutoHoy;*/

                                                                                if($BAS_CDETALLE1_ANDES==$sUsario0){//QUE SEA IGUAL AL USUARIOS DEL ASESOR
                                                                                    $SprSql = "EXEC SPR_UPDATE_BASE '".$BAS_NID_ANDES."', '".$fechaHoy."', '".$HoraTotal."', 'Asignado', '$sUsario0'";//cAMBIA ESTADO ASIGNADO
                                                                                    $stmt = sqlsrv_query($conn, $SprSql);
                                                                                    if ($stmt==false){
                                                                                        echo '<script> alert("Error Al Consultar La Base 3.");</script>';
                                                                                    }else{
                                                                                        $SprSql = "EXEC SPR_INSERT_TIPIFICACION 
                                                                                        
                                                                                        '".$BAS_NID_ANDES."',
                                                                                        '".$BAS_CID_SS_ANDES."',
                                                                                        '".$BAS_CNUMERO_ORDEN_ANDES."',
                                                                                        '".$BAS_CLOGICA_ANDES."',
                                                                                        '".$BAS_CFECHA_ASIGNACION_ANDES."',
                                                                                        '".$BAS_CFECHA_COMPOMISO_ANDES."',
                                                                                        '".$BAS_CFRANJA_HORARIA_ANDES."',
                                                                                        '".$BAS_CRUT_CLIENTE_ANDES."',
                                                                                        '".$BAS_CCIUDAD_LOCALIDAD_ANDES."',
                                                                                        '".$BAS_CCNC_ANDES."',
                                                                                        '".$BAS_CPUESTO_TRABAJO_ANDES."',
                                                                                        '".$BAS_CPLATAFORMA_ANDES."',
                                                                                        '".$sUsario0."',
                                                                                        'Asignado',
                                                                                        '".$fechaHoy."',
                                                                                        '".$HoraTotal."'";
                                                                                        
                                                                                        
                                                                                        $stmt1 = sqlsrv_query($conn, $SprSql);
                                                                                        
                                                                                        if($stmt==false){
                                                                                            echo '<script> alert("Error Al Consultar La Base 4.");</script>';
                                                                                        }else{
                                                                                        /*  echo "<td id='id_base_gestion_principal' type='hidden'>".$BAS_NID_ANDES."</td>"; */
                                                                                            echo "<td>".$BAS_CNUMERO_ORDEN_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CRUT_CLIENTE_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CLOGICA_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CCIUDAD_LOCALIDAD_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CPLATAFORMA_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CFECHA_COMPOMISO_ANDES."</td>";
                                                                                            echo "<td>".$BAS_CFRANJA_HORARIA_ANDES."</td>";
                                                                                            
                                                                                            
                                                                                        }
                                                                                    }
                                                                                }else{
                                                                                    /*  echo '<script> window.location="asesor.php"; </script>';  */
                                                                                    
                                                                                }
                                                                            }
                                                                        }else{
                                                                            echo '<script> alert("No se encontro ningun registro para validar, por favor validar con su supervisor.");</script>';
                                                                            ?>
                                                                            <script>
                                                                                funcsetInterval = setInterval(() => {
                                                                                    console.log("Entro A La Funcio n Set");
                                                                                    $.ajax({
                                                                                            url: 'asesor_setinterval.php',
                                                                                            type: 'POST'
                                                                                        }).done(function(resp){
                                                                                            console.log('Respuesta SetInterval: '+resp);
                                                                                            if(resp=='HayCasos'){
                                                                                                window.location='asesor.php';
                                                                                            }
                                                                                        })

                                                                                }, 10000);
                                                                            </script>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }else{
                                                                    echo '<script> alert("Recuerde cambiar su estado, para iniciar su gestion.");</script>';
                                                                    //echo '<script>MsgRecuerdeIniciar();</script>';
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="enviar_tipificacion.php" method="POST" id="tipificacion_vtr_asesor">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        
                                                        <h4>Tipificación</h4>
                                                        <div class="col-md-3">
                                                                <div class="cronometro col-md" id="cronometro">
                                                                    <div id="hms"></div>
                                                                    <div hidden class="boton start"></div>
                                                                    <div hidden class="boton stop"></div>
                                                                    <div hidden class="boton reiniciar"></div>
                                                                </div>
                                                                
                                                            </div>
                                                        <div class="row">
                                                            
                                                            <!-- <div class="col-md-4">
                                                                <label for=""><b>Solicitud de Servicio</b></label>
                                                                <input required type="text" class="form-control" placeholder="Ingrese Solicitud de Servicio">
                                                            </div> -->

                                                            
                                                            <div class="col-md-3">
                                                                <label for=""><b>Fecha Gestión</b></label>
                                                                <input required type="date" class="form-control"  name="fechaGestion" id="fechaGestion1" >
                                                            </div>
                                                            <input type="hidden" name="horaGestion" id="horaGestion1" value="<?php echo $HoraTotal ?>">
                                                            <input type="number" class="form-control" hidden="hidden" name="id_base_principal" id="id_base_principal1" value="<?php echo $BAS_NID_ANDES;?>">

                                                            <script>
                                                                IdResultado = <?php echo $BAS_NID_ANDES;?>;
                                                                let Id_Hms = document.querySelectorAll("#hms")[0];
                                                                Id_Hms.classList.toggle("hms-inactivo");
                                                                if(IdResultado !== '' && IdResultado >= 1){
                                                                    setInterval(() => {
                                                                        $.ajax({
                                                                            url: 'cronometro_setinterval.php',
                                                                            type: 'POST',
                                                                            data: {'switch': 'consultaCronometro',
                                                                                'IdGestion': IdResultado
                                                                            }
                                                                        }).done(function(resp){
                                                                            console.log('Respuesta SetInterval: '+resp);
                                                                            document.getElementById("hms").innerHTML = resp;
                                                                        })
                                                                    }, 1000);
                                                                }else{
                                                                    document.getElementById("hms").innerHTML = "00:00:00";
                                                                }
                                                            </script>

                                                            <script>
                                                                IdResultado5 = '<?php echo $EstadoConexion; ?>';
                                                                //let Id_Hms = document.querySelectorAll("#hms")[0];
                                                                //Id_Hms.classList.toggle("hms-inactivo");
                                                                if(IdResultado5 === 'Bano'){
                                                                    setInterval(() => {
                                                                        $.ajax({
                                                                            url: 'cronometroBano.php',
                                                                            type: 'POST',
                                                                            data: {'switch': 'ConsultarCronometroBano',
                                                                                'IdGestion': IdResultado5
                                                                            }
                                                                        }).done(function(resp){
                                                                            console.log('Respuesta bano: '+resp);
                                                                            document.getElementById("hms").innerHTML = resp;
                                                                        })
                                                                    }, 1000);
                                                                }
                                                            </script>

                                                            <script>
                                                                IdResultado4 = '<?php echo $EstadoConexion; ?>';
                                                                //let Id_Hms = document.querySelectorAll("#hms")[0];
                                                                //Id_Hms.classList.toggle("hms-inactivo");
                                                                if(IdResultado4 === 'Break'){
                                                                    setInterval(() => {
                                                                        $.ajax({
                                                                            url: 'cronometroBreak.php',
                                                                            type: 'POST',
                                                                            data: {'switch': 'ConsultarCronometroBreak',
                                                                                'IdGestion': IdResultado4
                                                                            }
                                                                        }).done(function(resp){
                                                                            console.log('Respuesta break: '+resp);
                                                                            document.getElementById("hms").innerHTML = resp;
                                                                        })
                                                                    }, 1000);
                                                                }
                                                            </script>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Tipo de Orden</b></label>
                                                                <select required class="form-control"  name="orden" id="orden1">
                                                                <option value="">Seleccione una opcinón...</option>
                                                                <option value="Actividad Remota">Actividad Remota</option>
                                                                <option value="Incoveniente Servicio">Incoveniente Servicio</option>
                                                                <option value="Incoveniente Servicio Reclamo 105">Incoveniente Servicio Reclamo 105</option>
                                                                <option value="B2B">B2B</option>
                                                                <option value="Servicio Tecnico">Servicio Tecnico</option>
                                                                <option value="Cero Soporte">Cero Soporte</option>
                                                                <option value="Cero Soporte 105">Cero Soporte 105</option>


                                                                </select>
                                                                
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Servicio</b></label>
                                                                <select required class="form-control"  name="servicio" id="servicio1">
                                                                <option value="">Seleccione...</option>
                                                                <?php
                                                                $sql = "EXEC [SPR_SELECT_SERVICIO]";
                                                                $row = sqlsrv_query($conn, $sql);
                                                                while ($data = sqlsrv_fetch_array($row)) {?>
                                                                <option value="<?php  echo $data['SER_CSERVCIO']; ?>"><?php  echo $data['SER_CSERVCIO']; ?></option>
                                                                <?php 
                                                                } ?>

                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Casillero</b></label>
                                                                <select required class="form-control" name="casillero" id="casillero1">
                                                                <option value="">Seleccione...</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for=""><b>Casuística</b></label>
                                                                <select required class="form-control" name="casuistica" id="casuistica1">
                                                                <option value="">Seleccione una opción...</option>
                                                                </select>
                                                                    
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Gestión</b></label>
                                                                <select required class="form-control"  name="gestion" id="gestion1">
                                                                <option value="">Seleccione una opción...</option>
                                                                <option value="ACEPTA SCRIPT">ACEPTA SCRIPT</option>
                                                                <option value="LLAMADO POSTERIOR">LLAMADO POSTERIOR</option>
                                                                <option value="FALLA PERSISTE">FALLA PERSISTE</option>
                                                                <option value="EXIGE VISITA">EXIGE VISITA</option>
                                                                <option value="SIN CONTACTO APAGADO">SIN CONTACTO APAGADO</option>
                                                                <option value="SIN CONTACTO CON EL CLIENTE">SIN CONTACTO CON EL CLIENTE</option>
                                                                <option value="SIN CONTACTO POR AGENDA">SIN CONTACTO POR AGENDA</option>
                                                                <option value="NO CORRESPONDE GESTION/SE CONFIRMA VISITA">NO CORRESPONDE GESTION/SE CONFIRMA VISITA</option>
                                                                <option value="NO CORRESPONDE GESTION">NO CORRESPONDE GESTION</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-1">
                                                                <label for=""><b>Pruebas</b></label>
                                                                <select required class="form-control"  name="prueba" id="prueba1">
                                                                <option value="">Sele...</option>
                                                                <option value="SI">SI</option>
                                                                <option value="NO">NO</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label for=""><b>Solución</b></label>
                                                                <select required class="form-control" name="solucion" id="solucion1">
                                                                <option value="">Seleccione...</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Agedar</b></label>
                                                                <select required class="form-control" name="reprogramar" id="reprogramar1"  >
                                                                <option value="">Seleccione una opción...</option>
                                                                <option value="SI">SI</option>
                                                                <!-- <option value="NO">NO</option> -->
                                                                </select>
                                                                
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row"> 
                                                            
                                                            <div class="col-md-3">
                                                                <label for=""><b>Fecha Agenda</b></label>
                                                                <input required type="date" class="form-control" style="background-color: #F7D2CC;" name="fechareprogramar" id="fechareprogramar1" disabled>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Agenda</b></label>
                                                                <select required class="form-control" name="horarepro" id="horarepro1" disabled>
                                                                <option value="">Seleccione...</option>
                                                                <option value="10:00:00-13:00:00">10:00:00-13:00:00</option>
                                                                <option value="13:00:00-16:00:00">13:00:00-16:00:00</option>
                                                                <option value="16:00:00-19:00:00">16:00:00-19:00:00</option>
                                                                <option value="19:00:00-22:00:00">19:00:00-22:00:00</option>
                                                                
                                                                </select>
                                                            </div>
                                                            

                                                            <div class="col-md-3">
                                                                <label for=""><b>Fecha Bloque</b></label>
                                                                <input required type="date" class="form-control" style="background-color: #F7D2CC;" name="fechabloque" id="fechabloque1" >
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for=""><b>Bloque</b></label>
                                                                <select required class="form-control" name="tipoblo" id="tipoblo1">
                                                                <option value="">Seleccione...</option>
                                                                <option value="Bloque 1">Bloque 1</option>
                                                                <option value="Bloque 2">Bloque 2</option>
                                                                
                                                                
                                                                </select>
                                                            </div>
                                                        </div>
                                                         <br>       
                                                        <div class="row"> 

                                                            <div class="col-md-3">
                                                                <label for=""><b>Bloque 1 hora</b></label>
                                                                <select required class="form-control" name="bloque" id="bloque1" >
                                                                <option value="">Seleccione...</option>

                                                                <option value="06:00:00-07:00:00">07:00:00-08:00:00</option>
                                                                <option value="07:00:00-08:00:00">08:00:00-09:00:00</option>
                                                                <option value="08:00:00-09:00:00">09:00:00-10:00:00</option>
                                                                <option value="09:00:00-10:00:00">10:00:00-11:00:00</option>
                                                                <option value="10:00:00-11:00:00">11:00:00-12:00:00</option>
                                                                <option value="11:00:00-12:00:00">12:00:00-13:00:00</option>
                                                                <option value="12:00:00-13:00:00">13:00:00-14:00:00</option>
                                                                <option value="13:00:00-14:00:00">14:00:00-15:00:00</option>
                                                                <option value="14:00:00-15:00:00">15:00:00-16:00:00</option>
                                                                <option value="15:00:00-16:00:00">16:00:00-17:00:00</option>
                                                                <option value="16:00:00-17:00:00">17:00:00-18:00:00</option>
                                                                <option value="17:00:00-18:00:00">18:00:00-19:00:00</option>
                                                                <option value="18:00:00-19:00:00">19:00:00-20:00:00</option>
                                                                <option value="19:00:00-20:00:00">20:00:00-21:00:00</option>
                                                                <option value="20:00:00-21:00:00">21:00:00-22:00:00</option>

                                                                
                                                                
                                                                </select>
                                                            </div>  

                                                            <div class="col-md-3">
                                                                <label for=""><b>Bloque 2 horas</b></label>
                                                                <select required class="form-control" name="bloque2" id="bloque2">
                                                                <option value="">Seleccione...</option>

                                                                <option value="06:00:00-07:00:00">08:00:00-09:00:00</option>
                                                                <option value="07:00:00-08:00:00">09:00:00-10:00:00</option>
                                                                <option value="08:00:00-09:00:00">10:00:00-11:00:00</option>
                                                                <option value="09:00:00-10:00:00">11:00:00-12:00:00</option>
                                                                <option value="10:00:00-11:00:00">12:00:00-13:00:00</option>
                                                                <option value="11:00:00-12:00:00">13:00:00-14:00:00</option>
                                                                <option value="12:00:00-13:00:00">14:00:00-15:00:00</option>
                                                                <option value="13:00:00-14:00:00">15:00:00-16:00:00</option>
                                                                <option value="14:00:00-15:00:00">16:00:00-17:00:00</option>
                                                                <option value="15:00:00-16:00:00">17:00:00-18:00:00</option>
                                                                <option value="16:00:00-17:00:00">18:00:00-19:00:00</option>
                                                                <option value="17:00:00-18:00:00">19:00:00-20:00:00</option>
                                                                <option value="18:00:00-19:00:00">20:00:00-21:00:00</option>
                                                                <option value="19:00:00-20:00:00">21:00:00-22:00:00</option>

                                                                
                                                                </select>
                                                            </div> 
                                                               
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for=""><b>Observaciones</b></label>
                                                                <br>
                                                                <textarea required name="observaciones" id="observaciones1" cols="145" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <button type="submit" class="form-control btn btn-danger"  name="enviar" id="enviar1">Enviar</button>

                                                                <input type="hidden" name="fechaInactivo" id="fechaInactivo1" value="<?php echo $fechaHoy ?>">
                                                                <input type="hidden" name="horaInactivo" id="horaInactivo1" value="<?php echo $HoraTotal ?>">
                                                                <input type="hidden" name="fechaActivo" id="Fecha" value="<?php echo $fechaHoy ?>">
                                                                <input type="hidden" name="horaActivo" id="Hora" value="<?php echo $HoraTotal ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        

                        
                    </div>
                </main>

                <script src="tipificacion_vtr.js" ></script> 
                <script src="estados_boton.js" ></script>

                <!-- <script type="text/javascript">
                    $(document).ready(function(e) {
                        $('#gestion1').change(function(){
                            $('#gestion1 option:selected').each(function){

                                repro = $(this).val();

                                if(repro === 'ACEPTA SCRIPT'){

                                    $('#reprogramar1').hide();

                                }
                                else{
                                    $('#reprogramar1').show();
                                }
                            });
                        });
                    });
                    
                </script> -->

                <!-- <script type="text/javascript">
                    $(document).ready(function(e) {
                        $('#gestion1').change(function(){
                            $('#gestion1 option:selected').each(function){

                                if(document.getElementById('gestion1').val('ACEPTA SCRIPT')){

                                    $('#reprogramar1').hide();

                                }
                                else{
                                    $('#reprogramar1').show();
                                }
                            });
                        });
                    });
                    
                </script> -->

                <!-- <script type="text/javascript">
                    $(document).ready(function(e) {
                        function hide(){

                            var sel = document.getElementById('#reprogramar1');
                            sel.style.display='none';
                        }
                        
                        function show(){
                            var sel = document.getElementById('#reprogramar1');
                            sel.style.display='inline';
                        }
                    });
                </script>                                             

                <script type="text/javascript">
                    $(document).ready(function(e) {
                        function Gestion(select) {
                        
                            if(select.value=='ACEPTA SCRIPT'){
                                $('#reprogramar1').hide();
                            }else{
                                $('#reprogramar1').show();
                            }
                        });
                    });
                    
                </script> -->

                
                
                <script language="javascript">
                    $(document).ready(function(){
                        $("#servicio1").change(function () {
                            $("#servicio1 option:selected").each(function () {
                                servicio= $(this).val();
                                //console.log(id_combinacion)
                                $.post("getCasillero.php",{servicio:servicio},function(data){
                                    $("#casillero1").html(data);
                                        console.log(data)

                                });
                            });
                        })
                    });
                </script>
                
                <script language="javascript">
                    $(document).ready(function(){
                        $("#casillero1").change(function () {
                            $("#casillero1 option:selected").each(function () {
                                casillero= $(this).val();
                                //console.log(id_combinacion)
                                $.post("getCasuistica.php",{casillero:casillero},function(data){
                                    $("#casuistica1").html(data);
                                        console.log(data)

                                });
                            });
                        })
                    });
                </script>  

                <script language="javascript">
                    $(document).ready(function(){
                        $("#servicio1").change(function () {
                            $("#servicio1 option:selected").each(function () {
                                servicio= $(this).val();
                                //console.log(id_combinacion)
                                $.post("getSolucion.php",{servicio:servicio},function(data){
                                    $("#solucion1").html(data);
                                        console.log(data)

                                });
                            });
                        })
                    });
                </script>

                <script languaje="javascript">
                    /*setInterval(() => {
                        $(document).ready(function() {
                            fechagest = $('#fechaGestion1').val();
                            console.log("fechagest: "+fechagest);
                            if (fechagest === "" || fechagest === null) {
                                $.post("tipificacion_setinterval.php", {
                                    switche: 'Obtener_Fecha_Inicial'
                                }, function(data) {
                                    data = JSON.parse(data);
                                    $("#Fecha").val(data.mens);
                                    $("#Hora").val(data.datos);
                                });
                            }
                        });
                    }, 5000);*/
                </script>


                <script>
                    window.onload = init;

                    function init() {
                        document.querySelector(".start").addEventListener("click", cronometrar);
                        document.querySelector(".stop").addEventListener("click", parar);
                        document.querySelector(".reiniciar").addEventListener("click", reiniciar);
                        h = 0;
                        m = 0;
                        s = 0;
                        document.getElementById("hms").innerHTML = "00:00:00";
                    }

                    function cronometrar(accion = 'false') {
                        if (accion == 'true') {
                            let Id_Hms = document.querySelectorAll("#hms")[0];
                            Id_Hms.classList.toggle("hms-inactivo");
                        } else if (accion == '2veces') {
                            return 1;
                        } else {
                            let Id_Hms = document.querySelectorAll("#hms")[0];
                            Id_Hms.classList.toggle("hms-inactivo");
                            Id_Hms.classList.toggle("hms-activo");
                            $('#fechaGestion1').removeAttr('onclick');
                            $('#fechaGestion1').prop('onclick', 'cronometrar("2veces")');
                            $('#orden1').removeAttr('onclick');
                            $('#orden1').prop('onclick', 'cronometrar("2veces")');
                            $('#servicio1').removeAttr('onclick');
                            $('#servicio1').prop('onclick', 'cronometrar("2veces")');
                            $('#gestion1').removeAttr('onclick');
                            $('#gestion1').prop('onclick', 'cronometrar("2veces")');
                            $('#prueba1').removeAttr('onclick');
                            $('#prueba1').prop('onclick', 'cronometrar("2veces")');
                            $('#enviar1').removeAttr('onclick');
                            $('#enviar1').prop('onclick', 'cronometrar("2veces")');
                        }
                        escribir();
                        if (typeof id !== 'undefined') {
                            clearInterval(id);
                        }
                        id = setInterval(escribir, 1000);
                        document.querySelector(".start").removeEventListener("click", cronometrar);
                    }

                    function escribir() {
                        var hAux, mAux, sAux;
                        s++;
                        if (s > 59) {
                            m++;
                            s = 0;
                        }
                        if (m > 59) {
                            h++;
                            m = 0;
                        }
                        if (h > 24) {
                            h = 0;
                        }

                        if (s < 10) {
                            sAux = "0" + s;
                        } else {
                            sAux = s;
                        }
                        if (m < 10) {
                            mAux = "0" + m;
                        } else {
                            mAux = m;
                        }
                        if (h < 10) {
                            hAux = "0" + h;
                        } else {
                            hAux = h;
                        }
                        document.getElementById("hms").innerHTML = hAux + ":" + mAux + ":" + sAux;
                    }

                    function parar() {
                        clearInterval(id);
                        document.querySelector(".start").addEventListener("click", cronometrar);
                    }

                    function reiniciar() {
                        clearInterval(id);
                        document.getElementById("hms").innerHTML = "00:00:00";
                        h = 0;
                        m = 0;
                        s = 0;
                        document.querySelector(".start").addEventListener("click", cronometrar);
                    }
                </script>

                <script>
                    function estadoActivo(){

                    var switche = 'ACTIVO'
                    console.log('SE EJECUTA LA FUNCION "ACTIVO"');
                    $.ajax({
                        type: 'POST',
                        url: 'cambiar_estado_activo.php',
                        data: {
                            'switche': switche
                        },
                    })
                    
                    }

                </script>

                <script>
                    function estadoInactivo(){

                    var switche = 'INACTIVO'
                    console.log('SE EJECUTA LA FUNCION "INACTIVO"');
                    $.ajax({
                        type: 'POST',
                        url: 'cambiar_estado_inactivo.php',
                        data: {
                            'switche': switche
                        },
                    })
                    
                    }

                </script>

                <script>
                    function estadoBano(){

                    var switche = 'BANO'
                    console.log('SE EJECUTA LA FUNCION "BANO"');
                    $.ajax({
                        type: 'POST',
                        url: 'cambiar_estado_bano.php',
                        data: {
                            'switche': switche
                        },
                    })
                    
                    }

                </script>

                <script>
                    function estadoBreak(){

                    var switche = 'BREAK'
                    console.log('SE EJECUTA LA FUNCION "BREAK"');
                    $.ajax({
                        type: 'POST',
                        url: 'cambiar_estado_break.php',
                        data: {
                            'switche': switche
                        },
                    })
                    
                    }

                </script>

                <script type="text/javascript">
                    /**
                    * Funcion para cambiar el color de fondo
                    * Tiene que recibir el objeto "this"
                    */
                    function changeColor(x)
                    {
                    if(x.style.background=='rgb(11, 126, 11)')
                    {
                    x.style.background='rgba(206, 18, 18, 0.863)';
                    }else{
                    x.style.background='rgb(11, 126, 11)';
                    }
                    return false;
                    }
                </script> 

                <script>
                    function color(){

                    var switche = 'COLOR'
                    console.log('SE EJECUTA LA FUNCION "COLOR"');
                    $.ajax({
                        type: 'POST',
                        url: 'cambiar_color_estado.php',
                        data: {
                            'switche': switche
                        },
                    })
                    
                    }

                </script>
 

                

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Carlos Niño DESARROLLADOR RPA 2021 Privacy Policy Terms & Conditions</div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            //init();
            //cronometrar('true');
        </script>
        
        
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
        <!-- <script src="js/datatables-simple-demo.js"></script>
        <script src="assets/bundles/libscripts.bundle.js"></script> ** Termina Cargando **
        <script src="assets/bundles/vendorscripts.bundle.js"></script> ** Termina Cargando **
        <script src="assets/bundles/chartist.bundle.js"></script> ** Muestra Mensaje De Bienvenidad  **
        <script src="assets/bundles/knob.bundle.js"></script> ** Muestra Mensaje De Bienvenidad  **
        <script src="../assets/vendor/toastr/toastr.js"></script> ** Muestra Mensaje De Bienvenidad  **
        <script src="assets/bundles/mainscripts.bundle.js"></script> ** Termina Cargando **
        <script src="assets/js/index.js"></script> ** Muestra Mensaje De Bienvenidad  ** -->
        <!-- <script src="js/main.js"></script> -->
    </body>
</html>
