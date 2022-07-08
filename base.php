<?php

date_default_timezone_set('America/Santiago');
$fechaHoy = date('d/m/Y');
$horaHoy = date('H');
$minutoHoy = date('i');

session_start();

require('conexion.php');

if(isset($_SESSION['UsuarioIngreso'])) {
    $Privilegio = $_SESSION["PrivilegioUsuario"];
    if ($Privilegio == "1" or $Privilegio == "21" or $Privilegio == "23"){

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
        <title>VTR | Bases</title>
        <link rel="icon" href="vtricono.ico" type="image/x-ico">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><b>VTR Back-Office</b></a>
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
            <!-- ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuración</a></li>
                         <li><a class="dropdown-item" href="#!">Activity Log</a></li> 
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Cesarr Sesión</a></li>
                    </ul>
                </li>
            </ul> -->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menú</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Supervisor <?php echo  $_SESSION["UsuarioIngreso"]?>
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
                                <a id="skill" href="./AsignacionSkills.php"> Asesores</a>
                                    <!-- <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="">Modal</a>
                                            
                                        </nav>
                                    </div> -->
                                    
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                                C
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->
                            <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        B
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php"></a>
                                            <a class="nav-link" href="register.php"></a>
                                            <a class="nav-link" href="password.php"></a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        l
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php"></a>
                                            <a class="nav-link" href="404.php"></a>
                                            <a class="nav-link" href="500.php"></a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->
                            <div class="sb-sidenav-menu-heading">Informes e Indicadores</div>
                            <a class="nav-link" href="TablaIndicadores.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                                Indicadores
                            </a>
                            <a class="nav-link" href="base.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Bases
                            </a>
                            <!-- <div class="collapse" id="collapbases" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsBases" aria-expanded="false" aria-controls="pagesCollapsBases">
                                     Cargar Bases
                                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                     </a>
                                    <div class="collapse" id="pagesCollapsBases" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="">Cargar Andes</a>
                                                <ul class="right_chat list-unstyled">
                                                    <li class="online">
                                                        
                                                            <form action="cargar_base_andes.php" method="post" class="media" enctype="multipart/form-data">
                                                                <div>
                                                                <button type="submit" class="btn btn-link" name="upload-base_andes"><img src="carga.png" alt="Icono Cargar"><b></b></button>
                                                                <input type="file" class="form-control btn btn-danger" name="upload-base_andes1" value="Seleccionar"></input>
                                                                </div>    
                                                            </form>
                                                        
                                                    </li>
                                                </ul>
                                            <a class="nav-link" href="">Cargar Tango</a>
                                                <ul class="right_chat list-unstyled">
                                                    <li class="online">
                                                        
                                                            <form action="cargar_base_tango.php" method="post" class="media" enctype="multipart/form-data">
                                                                <div>
                                                                <button type="submit" class="btn btn-link" name="upload-base_tango"><img src="carga.png" alt="Icono Cargar"><b></b></button>
                                                                <input type="file" class="form-control btn btn-danger bg-red" name="upload-base_tango1" value="Seleccionar"></input>
                                                                </div>    
                                                            </form>
                                                        
                                                    </li>
                                                </ul>
                                        </nav>
                                    </div>
                                    
                                    
                                </nav>
                            </div> -->
                            
                            
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
                        <!-- <h1 class="mt-4">Informes Tipificación</h1> -->
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Supervisor</a></li>
                            <li class="breadcrumb-item active">Informes</li>
                        </ol> -->
                        <br>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h4>Cargar Bases</h4>
                                        <div class="row">
                                            <div class="card-body col-xl-5">
                                            <label for="Cargar Andes"><b>Cargar Andes</b></label>
                                                <ul class="right_chat list-unstyled">
                                                    <li class="online">
                                                        
                                                            <form action="cargar_base_andes_spreed.php" method="post" class="media" enctype="multipart/form-data">
                                                                <div>
                                                                <button type="submit" class="btn btn-link" name="upload-base_andes"><img src="carga.png" alt="Icono Cargar"><b></b></button>
                                                                <input required type="file" class="form-control btn btn-danger" name="upload-base_andes1" value="Seleccionar"></input>
                                                                </div>    
                                                            </form>
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body col-xl-5">
                                            <label for="Cargar Tango"><b>Cargar Tango</b></label>
                                                <ul class="right_chat list-unstyled">
                                                    <li class="online">
                                                        
                                                            <form action="cargar_base_tango_spreed.php" method="post" class="media" enctype="multipart/form-data">
                                                                <div>
                                                                <button type="submit" class="btn btn-link" name="upload-base_tango"><img src="carga.png" alt="Icono Cargar"><b></b></button>
                                                                <input required type="file" class="form-control btn btn-danger bg-red" name="upload-base_tango1" value="Seleccionar"></input>
                                                                </div>    
                                                            </form>
                                                       
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                            
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h4>Descargar Informes</h4>
                                        <table border="2" class="table m-b-0 table-hover" id="tableBase">
                                            <thead class="base">
                                                <tr>
                                                    <th><b>BASES</b></th>
                                                    <th><b>FECHA INICIO</b></th>
                                                    <th><b>FECHA FIN</b></th>
                                                    <th><b>DESCARGAR</b></th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <form action="generar_informe_baseTipificacion.php" method="post">
                                                    <tr>
                                                        <td>Descargar Base General</td>
                                                        <td><input required type="date" class="form-control" name="fecha-inicio_tipificacion" value="fecha-inicio_tipificacion" ></td>
                                                        <td><input required type="date" class="form-control" name="fecha-fin_tipificacion" value="fecha-fin_tipificacion"></td>
                                                        <td><button type="submit" class="btn btn-link" id="buttom_tipificacion" name="buttom_tipificacion" ><img src="descarga.png" alt="icono descarga"></button></td>
                                                    </tr>
                                                    
                                                </form>
                                                <form action="generar_informe_baseAndes.php" method="post">
                                                
                                                    <tr>
                                                        <td>Descargar Base Andes</td>
                                                        <td><input required type="date" class="form-control" value="fecha-inicio_andes" name="fecha-inicio_andes"></td>
                                                        <td><input required type="date" class="form-control" value="fecha-fin_andes" name="fecha-fin_andes"></td>
                                                        <td><button type="submit" class="btn btn-link" id="buttom_andes" name="buttom_andes" ><img src="descarga.png" alt="icono descarga"></button></button></td>
                                                    </tr>
                                                    
                                                </form>
                                                <form action="generar_informe_baseTango.php" method="post">
                                                    
                                                    <tr>
                                                        <td>Descargar Base Tango</td>
                                                        <td><input required type="date" class="form-control" value="fecha-inicio_tango" name="fecha-inicio_tango"></td>
                                                        <td><input required type="date" class="form-control" value="fecha-fin_tango" name="fecha-fin_tango"></td>
                                                        <td><button type="submit" class="btn btn-link" id="buttom_tango" name="buttom_tango" ><img src="descarga.png" alt="icono descarga"></button></button></td>

                                                    </tr>
                                                </form>

                                                <form action="generar_informe_baseCargada.php" method="post">
                                                    
                                                    <tr>
                                                        <td>Descargar Bases Cargadas </td>
                                                        <td><input required type="date" class="form-control" value="fecha-inicio_Basecarga" name="fecha-inicio_Basecarga"></td>
                                                        <td><input required type="date" class="form-control" value="fecha-fin_Basecarga" name="fecha-fin_Basecarga"></td>
                                                        <td><button type="submit" class="btn btn-link" id="buttom_Basecarga" name="buttom_Basecarga" ><img src="descarga.png" alt="icono descarga"></button></button></td>

                                                    </tr>
                                                </form>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"></div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
    </body>
</html>
