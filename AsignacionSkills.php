<?php

date_default_timezone_set('America/Santiago');
$fechaHoy = date('d/m/Y');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

session_start();

require('conexion.php');

if(isset($_SESSION['UsuarioIngreso'])) {
    $Privilegio = $_SESSION["PrivilegioUsuario"];
    if ($Privilegio == "1" or $Privilegio == "21"){

    }else{
        echo '<script> window.location="logout.php"; </script>';
    }
}else{
    echo '<script> window.location="logout.php"; </script>';
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
        <title>VTR | BACK-OFFICE-SKILL </title>
        <link rel="icon" href="vtricono.ico" type="image/x-ico">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css"> 
        <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/vendor/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="../assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
        <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/color_skins.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/Chart.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
    
<body>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            <!-- Navbar Brand-->
            <img src="" alt=""><a class="navbar-brand ps-3" href="index.php"><b>VTR Back-Office</b> </a>
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
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Supervisor <?php echo  $_SESSION["UsuarioIngreso"] ?>
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaces</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php">Supervisor</a>
                                    <a class="nav-link" href="asesor.php">Asesor</a>
                                    <a class="nav-link" href="login.php">Cerrar Sesión</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Skill</div>
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Asignar Skill
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> 
                            <div  class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                <style>
                                    #skill{
                                       text-decoration:none; 
                                       color:black;
                                    }

                                </style>
                                <a id="skill" href="AsignacionSkills.php"> Asesores</a>
                                    <!-- <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="">Modal</a>
                                            
                                        </nav>
                                    </div> -->
                                    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Informes e Indicadores</div>
                            <a class="nav-link" href="TablaIndicadores.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                                Indicadores
                            </a>
                            <a class="nav-link" href="base.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Bases
                            </a>
                            
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
              
            

   
   <div class="card-body">
        <br>
        <table id="table_id" class="display">
                <thead>
                    <style>
                        th, tr{
                            text-align: center;
                        }
                    </style>
                        <tr>
                            <th>NOMBRE</th>
                            <th>USUARIO RED</th>
                            <th>ESTADO</th>
                            <th style=" width: 10%;">skills</th>
                        </tr>
                </thead>
            <tbody>

                <?php
                    $BasesGestion = array('Andes', 'Tango');
                    $query = "EXEC [SPR_SELECT_PRIORIDADES]";
                    $params = array();
                    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                    $resultado = sqlsrv_query($conn,$query,$params,$options);
                    $Select = '<option value=""selected>seleccionar</option>';
                    $TotalSkillsAsigna = array();
                    //$CantidadSkills = sqlsrv_num_rows($resultado);
                    while ($row = sqlsrv_fetch_array($resultado)){
                        $PRI_CPRIORIDAD = $row['PRI_CPRIORIDAD'];
                        $Select = $Select.'<option value="'.$PRI_CPRIORIDAD.'">'.$PRI_CPRIORIDAD.'</option>';
                        array_push($TotalSkillsAsigna, $PRI_CPRIORIDAD);
                    }
                    //echo print_r($TotalSkillsAsigna);

                    $query="EXEC SPR_SELECT_ASIGNACION_SKILL '".$fechaHoy."'"; //  AND id_outbound ORDER BY id_outbound LIMIT 100
                    //$query="SELECT * FROM TBL_RCREDENCIAL WHERE FECHA = HOY"; //  AND id_outbound ORDER BY id_outbound LIMIT 100
                    $resultado = sqlsrv_query($conn,$query);

                    while ($row = sqlsrv_fetch_array($resultado)){
                        $CRE_CUSUARIO = $row['CRE_CUSUARIO'];
                        $querySkills = "EXEC [SPR_SELECT_SKILL] '".$CRE_CUSUARIO."'";
                        $resultadoSkills = sqlsrv_query($conn,$querySkills);
                        $ArraySkillsActivos = [];
                        while ($rowSkills = sqlsrv_fetch_array($resultadoSkills)){
                            $Skills = $rowSkills['SKI_SKILLS'];
                            $BaseSk = $rowSkills['SKI_PLATAFORMA'];
                            $ArraySkillsActivos += ["$Skills"."$BaseSk" => "1"];
                        }

                ?>
                                    <tr>
                                        <td><?php echo $row['CRE_CNOMBRE'] ?></td>
                                        <td><?php echo $row['CRE_CUSUARIO'] ?></td>
                                        <td><?php echo $row['CON_CESTADO_SESSION'] ?></td>
                                        
                                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $CRE_CUSUARIO;?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                        </svg></button></td>

                                        <div class="modal fade" id="exampleModal<?php echo $CRE_CUSUARIO;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog"  role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Asignacion de Skill para <?php echo $CRE_CUSUARIO;?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding-top: 0px;">
                                            
                                                <!--<div class="row">

                                                        <div class="col-md-6">
                                                            <select  class="form-select" aria-label="Default select example" name="select">
                                                            <option value=""selected>seleccionar</option>
                                                            <option value="Andes">Andes</option>
                                                            <option value="Tango">Tango</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select  class="form-select" aria-label="Default select example" name="select2">
                                                                <?php echo $Select;?>
                                                            <!-- <option value=""selected>seleccionar</option>
                                                            <option value="B2B">B2B</option>
                                                            <option value="LLAMADO POSTERIOR">LLAMADO POSTERIOR</option>
                                                            <option value="MASIVOS">MASIVOS</option>
                                                            <option value="CABLE">CABLE</option>
                                                            <option value="INTERNET">INTERNET</option>
                                                            <option value="TELEFONIA">TELEFONIA</option> --
                                                            </select>
                                                        </div>
                                                </div>-->
                                                

                                                <!-- <div class="row">
                                                    <div class="col text-center">
                                                        <button style="border-radius:20px;"  type="button" class="btn btn-success">Agregar</button>
                                                    </div>
                                                </div> -->
                                                
                                                <div class="row">

                                                    <div class="row text-center" style="margin:auto; padding-block:20px; background-color:#dc3545; color: #fff;">
                                                        <div class="col-md-4">BASE</div>
                                                        <div class="col-md-4">PRIORIDAD</div>
                                                        <!-- <div class="col-md-3">ESTADO</div> -->
                                                        <div class="col-md-4">ON/OFF</div>
                                                    </div>
                                                   <br>
                                                   <?php
                                                    for($i=0;$i<count($BasesGestion);$i++){
                                                        for($m=0;$m<count($TotalSkillsAsigna);$m++){
                                                        ?>
                                                            <div class="row text-center" style="margin:auto; padding-block:10px;">
                                                            
                                                                <div class="col-md-4"><?php echo $BasesGestion[$i];?></div>
                                                                
                                                                <div class="col-md-4"><?php echo $TotalSkillsAsigna[$m];?></div>
                                                                
                                                                <!-- <div class="col-md-3">Activo</div> -->
                                                               
                                                                <div class="col-md-4" id="button_<?php echo $CRE_CUSUARIO;?>_<?php echo $BasesGestion[$i];?>_<?php echo str_replace(" ","",$TotalSkillsAsigna[$m]);?>">
                                                                    <?php
                                                                    if(isset($ArraySkillsActivos[$TotalSkillsAsigna[$m].$BasesGestion[$i]])){?>
                                                                    <button type="button" onclick="CambiarEstadoSkills('<?php echo $CRE_CUSUARIO;?>', '<?php echo $BasesGestion[$i];?>', '<?php echo $TotalSkillsAsigna[$m];?>', 'Inactivo')" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <rect x="5" y="11" width="14" height="10" rx="2" />
                                                                        <circle cx="12" cy="16" r="1" />
                                                                        <path d="M8 11v-5a4 4 0 0 1 8 0" />
                                                                        </svg>
                                                                    </button>
                                                                    <?php
                                                                    }else{
                                                                    ?>
                                                                    <button type="button" onclick="CambiarEstadoSkills('<?php echo $CRE_CUSUARIO;?>', '<?php echo $BasesGestion[$i];?>', '<?php echo $TotalSkillsAsigna[$m];?>', 'Activo')" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <rect x="5" y="11" width="14" height="10" rx="2" />
                                                                        <circle cx="12" cy="16" r="1" />
                                                                        <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                                                        </svg>
                                                                    </button>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <hr style="width: 95%;  background-color:#dc3545;">
                                                    <?php
                                                        }
                                                    }
                                                    ?>


                                                   
                                                <!--<table id="modal" class="display">
                                                                <thead>
                                                                <style>
                                                                    th, tr{
                                                                        text-align: center;
                                                                    }
                                                                </style>
                                                                    <tr>
                                                                        <th>skill</th>
                                                                        <th style=" width: 10%;">eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                
                                                                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                        </svg></button></td>
                                                                    </tr>
                                                                
                                                                </tbody>
                                                    </table>-->
                                                </div>
                                    
                                                
                                                        
                                                </div>
                                                </div>
                                            </div> 
                                    </div>
                                    </tr>
                

                <?php 
                    } 
                ?>    
            </tbody>
        </table> 
    </div> 
    </div>                                                                <!--  modal -->
 </div>                         
</body>  
        <script>
            function CambiarEstadoSkills(UsuarioCRM, BaseSkill, SkillAsigna, EstadoSkill){
                $.ajax({
                    type: 'POST',
                    url: 'ValidacionSkill.php',
                    data: {
                        'UsuarioCRM': UsuarioCRM,
                        'BaseSkill': BaseSkill,
                        'SkillAsigna': SkillAsigna,
                        'EstadoSkill': EstadoSkill
                    },
                })
                .done(function(resultado){
                    console.log('resultado: '+resultado);
                    if(resultado=="Exito"){
                        if(EstadoSkill=="Activo"){
                            $("#button_"+UsuarioCRM+"_"+BaseSkill+"_"+SkillAsigna.replace(' ','')).html('<button type="button" onclick="CambiarEstadoSkills('+"'"+UsuarioCRM+"','"+BaseSkill+"','"+SkillAsigna+"','Inactivo'"+')" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="11" width="14" height="10" rx="2" /><circle cx="12" cy="16" r="1" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg></button>');
                        }else{
                            $("#button_"+UsuarioCRM+"_"+BaseSkill+"_"+SkillAsigna.replace(' ','')).html('<button type="button" onclick="CambiarEstadoSkills('+"'"+UsuarioCRM+"','"+BaseSkill+"','"+SkillAsigna+"','Activo'"+')" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="11" width="14" height="10" rx="2" /><circle cx="12" cy="16" r="1" /><path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg></button>');
                        }
                    }
                })
            }
        </script>

        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="assets/bundles/libscripts.bundle.js"></script> <!--** Termina Cargando **-->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!--** Termina Cargando **-->
        <script src="assets/bundles/chartist.bundle.js"></script> <!--** Muestra Mensaje De Bienvenidad  **-->
        <script src="assets/bundles/knob.bundle.js"></script> <!--** Muestra Mensaje De Bienvenidad  **-->
        <script src="../assets/vendor/toastr/toastr.js"></script> <!--** Muestra Mensaje De Bienvenidad  **-->
        <script src="assets/bundles/mainscripts.bundle.js"></script> <!--** Termina Cargando **-->
        <script src="assets/js/index.js"></script> <!--** Muestra Mensaje De Bienvenidad  **-->
        <script src="js/main.js"></script>
  



    <script>
            $(document).ready( function () {
            $('#table_id').DataTable();
            } );
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Arrastra y suelta un archivo aquí o haz clic',
                    replace: 'Arrastre y suelte un archivo o haga clic para reemplazar',
                    remove: 'Suprimir',
                    error: 'Lo sentimos, el archivo es demasiado grande.'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Deseas Eliminarlo..? \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('Archivo Borrado');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Error');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <script>

        $(document).ready(function(){
            $("#progress").hide();
            $("#CargarBase").hide();
            $("#CargueUser").hide();


        })

        $("#carga").click(function(){
            $("#progress").show();
        })

        $("#BaseMasiva").click(function(){
            $("#UnUsuario").hide();
            $("#BaseMasiva").hide();
            $("#CargarBase").show();
            $("#CargueUser").show();

        })


        $("#CargueUser").click(function(){
            $("#CargarBase").hide();
            $("#CargueUser").hide();
            $("#BaseMasiva").show();
            $("#UnUsuario").show();

        })


            $(document).ready(function() {
                $('#myTable').DataTable();
                $(document).ready(function() {
                    var table = $('#example').DataTable({
                        "columnDefs": [{
                            "visible": false,
                            "targets": 2
                        }],
                        "order": [
                            [2, 'asc']
                        ],
                        "displayLength": 25,
                        "drawCallback": function(settings) {
                            var api = this.api();
                            var rows = api.rows({
                                page: 'current'
                            }).nodes();
                            var last = null;
                            api.column(2, {
                                page: 'current'
                            }).data().each(function(group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before('<tr class="group"><td colspan="1">' + group + '</td></tr>');
                                    last = group;
                                }
                            });
                        }
                    });
                    // Order by the grouping
                    $('#example tbody').on('click', 'tr.group', function() {
                        var currentOrder = table.order()[0];
                        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                            table.order([2, 'desc']).draw();
                        } else {
                            table.order([2, 'asc']).draw();
                        }
                    });
                });
            });

    </script>


</html>

