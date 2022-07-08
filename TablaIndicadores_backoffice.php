<?php

date_default_timezone_set('America/Santiago');
$fechaHoy1 = date('d/m/Y');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;
/* echo($HoraTotal); */
session_start();

require('conexion.php');

if(isset($_SESSION['UsuarioIngreso'])) {
    $Privilegio = $_SESSION["PrivilegioUsuario"];
    if ($Privilegio == "1" or  $Privilegio == "23"){

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
        <title>VTR | BACK-OFFICE-INDICADORES </title>
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
                                    <!-- <a class="nav-link" href="index.php">Supervisor</a>
                                    <a class="nav-link" href="asesor.php">Asesor</a> -->
                                    <a class="nav-link" href="login.php">Cerrar Sesión</a>
                                </nav>
                            </div>
                            <!-- <div class="sb-sidenav-menu-heading">Skill</div>
                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Asignar Skill
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>  -->
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
                            <a class="nav-link" href="TablaIndicadores_backoffice.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                                Indicadores
                            </a>
                            <form action="Update_base.php" method="POST">
                            <button type="submit" name="ActualizarBase" class="form-control btn btn-danger">Actualizar Base</button>
                            </form>
                            <a class="nav-link" href="backoffice.php">
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
      
        <div id="seccionRecargarIndicadores">
        <div class="container">
            <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
						<div class="card horizontal cardIcon waves-effect waves-dark text-center" >
						<div class="card-image red">
						<i class="material-icons dp48">Totales Andes</i>
						</div>
						<div class="card-stacked red">
						<div class="card-content">
						<h3><img src="loader.gif" alt="" width="50px" height="50px"></h3> 
						</div>
					
						</div>
						</div>
	 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
						<div class="card horizontal cardIcon waves-effect waves-dark text-center text-white "style="background-color:#dc3545;">
						<div class="card-image orange">
						<i class="material-icons dp48">Base Andes</i>
						</div>
						<div class="card-stacked orange">
						<div class="card-content">
						<h3><img src="load.gif" alt="" width="50px" height="50px"></h3> 
						</div>
						
						</div>
						</div> 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
							<div class="card horizontal cardIcon waves-effect waves-dark text-center">
						<div class="card-image blue">
						<i class="material-icons dp48">Totales Tango</i>
						</div>
						<div class="card-stacked blue">
						<div class="card-content">
						<h3><img src="loader.gif" alt="" width="50px" height="50px"></h3> 
						</div>
						
						</div>
						</div> 
						 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
					<div class="card horizontal cardIcon waves-effect waves-dark text-center text-white"style="background-color:#dc3545;" >
						<div class="card-image green">
						<i class="material-icons dp48">Base Tango</i>
						</div>
						<div class="card-stacked green">
						<div class="card-content">
						<h3><img src="load.gif" alt="" width="50px" height="50px"></h3> 
						</div>
					
						</div>
						</div> 
						 
                    </div>
                </div>
             </div>
             <br>
 
        </div>  
        <div id="RecargarInTabla_backoffie">

        <form action ="update_tabla_indicadores_backoffice.php" method="POST">
        <table id="table_id" class="display">
                    <thead>
                        <style>
                            th, tr{
                                text-align: center;
                            }
                        </style>
                            <tr>
                                <th>NUMERO DE ORDEN</th>
                                <th>RUT</th>
                                <th>CASILLERO</th>
                                <th>COMUNA</th>
                                <th>PLATAFORMA</th>
                                <th>FECHA AGENDAMIENTO</th>
                                <th>AGENDA</th>
                                <th><input type="submit" Style="color: #fff; font-weight: bold;" class="btn btn-dager" name="BtnEliminar" value="CANCELAR"></th>
                                <th hidden="hidden"></th>
                                <th hidden="hidden"></th>   

                            </tr>
                    </thead>
                <tbody>
                    <?php
                     $sql="EXEC [SPR_SELECT_PEDIENTES_BASE_CARGA] '".$fechaHoy1."','Pendiente'";
                     $row=sqlsrv_query($conn, $sql);

                     

                     while($resultado=sqlsrv_fetch_array($row)){
                        
                        $orden=$resultado['BAS_CNUMERO_ORDEN_ANDES'];
                        $rut=$resultado['BAS_CRUT_CLIENTE_ANDES'];
                        $casillero=$resultado['BAS_CLOGICA_ANDES'];
                        $comuna=$resultado['BAS_CCIUDAD_LOCALIDAD_ANDES'];
                        $plataforma=$resultado['BAS_CPLATAFORMA_ANDES'];
                        $fecha=$resultado['BAS_CFECHA_COMPOMISO_ANDES'];
                        $franja=$resultado['BAS_CFRANJA_HORARIA_ANDES'];
                        
                        
                        ?>
                                        <tr>
                                            <td><?php echo $orden;?></td>
                                            <td><?php echo $rut;?></td>
                                            <td><?php echo $casillero;?></td>
                                            <td><?php echo $comuna;?></td>
                                            <td><?php echo $plataforma;?></td>
                                            <td><?php echo $fecha;?></td>
                                            <td><?php echo $franja;?></td>
                                            
                                                <!-- <form action ="update_tabla_indicadores.php" method="POST"> -->
                                                            <td hidden="hidden"><input type="text" hidden="hidden" name="id_new" id="id_new1" value="<?php echo $resultado['BAS_NID_ANDES']; ?>"></td>
                                                            <td hidden="hidden"><b><input type = "text" hidden="hidden" name ="estado" class="form-control" row="12" value="Cancelado"> </b></td>
                                                            <td>
                                                            <input type="checkbox" style="transform:scale(2);" name="IdBase[]" value="<?php echo $resultado['BAS_NID_ANDES']?>" class="btn btn-rounded btn-danger">
                                                            <!-- <i class="mdi mdi-arrow-up-bold"></i>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <line x1="4" y1="7" x2="20" y2="7" />
                                                            <line x1="10" y1="11" x2="10" y2="17" />
                                                            <line x1="14" y1="11" x2="14" y2="17" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg> -->
                                                            </input>
                                                            </td>
                                                <!-- </form> -->
                                            
                                            
                                            <!-- <td>
                                            
                                            <button  class ="btn 
                                            btn-danger" name="update" > 
                                                <i class="fas fa-marker"></i><?php echo $resultado['BAS_NID_ANDES']; ?>
                                            </button>
                                            
                                            </td> -->
                                            
                                            <!-- <td><button type="button" class="btn btn-danger" data-toggle="" data-target=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-cancel" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <circle cx="10" cy="10" r="7" />
                                            <line x1="8" y1="8" x2="12" y2="12" />
                                            <line x1="12" y1="8" x2="8" y2="12" />
                                            <line x1="21" y1="21" x2="15" y2="15" />
                                            </svg></button></td> -->
                                        </tr>
                    <?php }
                    ?>

                                        
 
                </tbody>
            </table>
            </form>
            </div>  
    </div> 


    </div>                                                                <!--  modal -->
 </div>                         
</body>  
    

<!-- Modal 
<div class="modal fade" id="CancelarCaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cancelación </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
           
            <textarea placeholder="Motivo de Cancelación"  class="form-control" id="exampleFormControlTextarea1" rows="3"style="resize: none;"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">salir</button>
        <button type="button" class="btn btn-danger">Cancelar caso</button>
      </div>
    </div>
  </div>
</div>
 Modal -->



        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <script src="assets/bundles/vendorscripts.bundle.js"></script> 
        <script src="assets/bundles/chartist.bundle.js"></script> 
        <script src="assets/bundles/knob.bundle.js"></script> 
        <script src="../assets/vendor/toastr/toastr.js"></script> 
        <script src="assets/bundles/mainscripts.bundle.js"></script> 
        <script src="assets/js/index.js"></script>  
        <script src="js/main.js"></script>

        <!-- <script src="vendor_/jquery/jquery.min.js"></script>
        <script src="vendor_/bootstrap/js/bootstrap.bundle.min.js"></script> 
        <script src="vendor_/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor_/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor_/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="vendor_/chart.js/Chart.min.js"></script> -->
   

     

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

<script>
     $(document).ready(function(){

        setInterval(
            function(){
                $('#seccionRecargarIndicadores').load('RecargarIndicadores.php')
            },2000
        
        )
       
     });
</script> 
<script>
     $(document).ready(function(){

        setInterval(
            function(){
                $('#RecargarInTabla_backoffie').load('RecargarInTabla_backoffie.php')
            },60000
        
        )
       
     });
</script> 


