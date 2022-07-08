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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>     
        <title>VTR | BACK-OFFICE </title>
        <link rel="icon" href="vtricono.ico" type="image/x-ico">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        

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
       
    </head>
    <body class="sb-nav-fixed">
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
                                <a id="skill" href="./AsignacionSkills.php"> Asesores</a>
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
                
                <main>
              
                        
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Visual | Efectividad</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Supervisor</li>
                        </ol> -->
                        <br>
                    
              <div id="seccionRecargar">
                            <div class="col-xl-12">
                             <div class="card mb-4">
                                 <div class="card-body" >
                                <table border="2" class="table m-b-0 table-hover" id="" >
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Asesor</th>
                                                                                <th>Casos Tipificados</th>
                                                                                <th>TMO</th>
                                                                                <th>Estado conexion</th>
                                                                                <th>Estado en gestion</th>
                                                                                <th>Tiempo Gestion</th>
                                                                        </thead>
                                                                        <tbody>

                                                                           
                                                                        </tbody>
                                </table>
                                <div class="row">
                                <div class="col-md-5"></div> 

                                    <div class="col-md-3">

                                        <img src="cargando.gif" alt="">
                                    </div>

                                <div class="col-md-5"></div>                             

                                </div>
                                
                                </div>
                                </div>   
                </div>
                        



                        <script>
                          //console.log('IdGestionArray: '+IdGestionArray);
                          //console.log('UsuariosArray: '+UsuariosArray);
                          //console.log('EstadosArray: '+EstadosArray);
                            setInterval(() => {
                                $.ajax({
                                    url: 'cronometro_setinterval_coordinador.php',
                                    type: 'POST',
                                    data: {'switch': 'consultaCronometro2',
                                        'IdGestion': IdGestionArray,
                                        'UsuariosArray': UsuariosArray,
                                        'EstadosArray': EstadosArray
                                    }
                                })
                                .done(function(resp){
                                    //UserName2 = UsuariosArray[i];
                                    console.log('Respuesta SetInterval: '+resp);
                                    //document.getElementById("hms1_"+UserName2).innerHTML = resp;
                                    console.log('Cuentas: '+IdResultado);
                                    NewArrayResp = JSON.parse(resp);
                                    for(var i=0; i < UsuariosArray.length;i++){
                                        console.log('Cuentas: '+NewArrayResp[i]);
                                        UserName2 = UsuariosArray[i];
                                        IdResultado = parseInt(IdGestionArray[i], 10);
                                        document.getElementById("hms1_"+UserName2).innerHTML = NewArrayResp[i];
                                    }
                                })
                                /*for(var i=0; i < UsuariosArray.length;i++){
                                    UserName2 = UsuariosArray[i];
                                    IdResultado = parseInt(IdGestionArray[i], 10);
                                    //console.log('Cuentas: '+UserName2);
                                    //console.log('IdResultado: '+IdResultado);
                                    if(IdResultado >= 1){
                                        
                                    }else{
                                        document.getElementById("hms1_"+UserName2).innerHTML = '00:00:00';
                                    }
                                }*/
                            }, 1000);
                            /*if(IdResultado >= 1){
                                
                                $.ajax({
                                    url: 'cronometro_setinterval_coordinador.php',
                                    type: 'POST',
                                    data: {'switch': 'consultaCronometro',
                                        'IdGestion': IdResultado
                                    }
                                }).done(function(resp){
                                        console.log('Respuesta SetInterval: '+resp);
                                        document.getElementById("hms1_"+UserName).innerHTML = resp;
                                    })
                                
                            }else{
                                document.getElementById("hms1_"+UserName).innerHTML = '00:00:00';
                            }*/
                              /*user = '<?php echo $UsuariosRed; ?>'
                              valor = 'tiempo gestion'
                              estado = ''


                              console.log(user + '-' + valor + ' ' + estado);

                              funcUpdateTimeCaso = setInterval(() => {
                                $.post("tiempo_coordinador.php", {
                                  'user': user,
                                  'valor': valor,
                                  'estado': estado
                                }, function(resultado) {
                                  console.log("resultado: " + resultado);
                                  if (resultado == '') {
                                    $('#retornotiempo<?php echo $UsuariosRed; ?>').html('00:00')
                                  } else {
                                    $('#retornotiempo<?php echo $UsuariosRed; ?>').html(resultado)
                                  }

                                });
                              }, 1000);

                              setTimeout(() => {
                                clearInterval(funcUpdateTimeCaso);
                              }, 3000);*/
                        </script>

                        <script>
                          
                          /*setInterval(() => {
                              $.ajax({
                                  url: 'cronometro_setinterval_coordinador_bano.php',
                                  type: 'POST',
                                  data: {'switch': 'consultaCronometro3',
                                      'IdGestion': UsuariosArray
                                  }
                              })
                              .done(function(resp){
                                  //UserName2 = UsuariosArray[i];
                                  console.log('Respuesta SetInterval: '+resp);
                                  //document.getElementById("hms1_"+UserName2).innerHTML = resp;
                                  //console.log('Cuentas: '+IdResultado);
                                  NewArrayResp = JSON.parse(resp);
                                  for(var i=0; i < UsuariosArray.length;i++){
                                      console.log('Cuentas: '+NewArrayResp[i]);
                                      UserName2 = UsuariosArray[i];
                                      UserName = parseInt(UsuariosArray[i], 10);
                                      document.getElementById("hms1_"+UserName2).innerHTML = NewArrayResp[i];
                                  }
                              })
                          }, 1000);*/
                          /*if(IdResultado >= 1){
                              
                              $.ajax({
                                  url: 'cronometro_setinterval_coordinador.php',
                                  type: 'POST',
                                  data: {'switch': 'consultaCronometro',
                                      'IdGestion': IdResultado
                                  }
                              }).done(function(resp){
                                      console.log('Respuesta SetInterval: '+resp);
                                      document.getElementById("hms1_"+UserName).innerHTML = resp;
                                  })
                              
                          }else{
                              document.getElementById("hms1_"+UserName).innerHTML = '00:00:00';
                          }*/
                            /*user = '<?php echo $UsuariosRed; ?>'
                            valor = 'tiempo gestion'
                            estado = ''


                            console.log(user + '-' + valor + ' ' + estado);

                            funcUpdateTimeCaso = setInterval(() => {
                              $.post("tiempo_coordinador.php", {
                                'user': user,
                                'valor': valor,
                                'estado': estado
                              }, function(resultado) {
                                console.log("resultado: " + resultado);
                                if (resultado == '') {
                                  $('#retornotiempo<?php echo $UsuariosRed; ?>').html('00:00')
                                } else {
                                  $('#retornotiempo<?php echo $UsuariosRed; ?>').html(resultado)
                                }

                              });
                            }, 1000);

                            setTimeout(() => {
                              clearInterval(funcUpdateTimeCaso);
                            }, 3000);*/
                      </script>

                <script>
                    /*window.onload = init;

                    function init() {
                        document.querySelector(".start").addEventListener("click", cronometrar);
                        document.querySelector(".stop").addEventListener("click", parar);
                        document.querySelector(".reiniciar").addEventListener("click", reiniciar);
                        h = 0;
                        m = 0;
                        s = 0;
                        document.getElementById("hms1").innerHTML = "00:00:00";
                    }

                    function cronometrar(accion = 'false') {
                        if (accion == 'true') {
                            let Id_Hms = document.querySelectorAll("#hms1")[0];
                            Id_Hms.classList.toggle("hms1-inactivo");
                        } else if (accion == '2veces') {
                            return 1;
                        } else {
                            let Id_Hms = document.querySelectorAll("#hms1")[0];
                            Id_Hms.classList.toggle("hms1-inactivo");
                            Id_Hms.classList.toggle("hms1-activo");
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
                        document.getElementById("hms1").innerHTML = hAux + ":" + mAux + ":" + sAux;
                    }

                    function parar() {
                        clearInterval(id);
                        document.querySelector(".start").addEventListener("click", cronometrar);
                    }

                    function reiniciar() {
                        clearInterval(id);
                        document.getElementById("hms1").innerHTML = "00:00:00";
                        h = 0;
                        m = 0;
                        s = 0;
                        document.querySelector(".start").addEventListener("click", cronometrar);
                    }*/
                </script>




                        <div class="modal" id="asignarSkill">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="smallModalLabel">Skill</h4>
                                    </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div >
                                                        <div class="input-group">
                                                                <input class="form-control" type="text" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="btnNavbarSearch" />
                                                                <button class="btn btn-danger" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div><br>
                                                <div class="row" >
                                                    
                                                    <div class="col-lg-6">
                                                    <table border="2" class="table m-b-0 table-hover" id="">
                                                        <thead>
                                                            <tr>
                                                                <th><b>Skill</b></th>
                                                                <th><b>Asignar</b></th>
                                                                <th><b>Quitar</b></th>
                                                            </tr>
                                                        </thead>
                                                        
                                                        <tbody id="table-tbody-supervisor-descargas-post">
                                                            <form action="" method="post">
                                                                <tr>
                                                                    <td><b>Andes</b></td>
                                                                    <td><button type="submit" class="btn btn-link" id="buttom-skill" name="buttom-skill" ><img src="asignar.png" alt="icono asignar"></button></td>
                                                                    <td><button type="submit" class="btn btn-link" id="buttom-skill" name="buttom-skill" ><img src="quitar.png" alt="icono quitar"></button></td>

                                                                </tr>
                                                                
                                                            </form>
                                                            <form action="" method="post">
                                                                <tr>
                                                                    <td><b>Tango</b></td>
                                                                    <td><button type="submit" class="btn btn-link" id="buttom-skill" name="buttom-skill" ><img src="asignar.png" alt="icono asignar"></button></td>
                                                                    <td><button type="submit" class="btn btn-link" id="buttom-skill" name="buttom-skill" ><img src="quitar.png" alt="icono quitar"></button></td>

                                                                </tr>
                                                                
                                                            </form>
                                                        
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                </div>


                            </div>
                        </div>

                        
                    </div>
                </main>
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
        <script src="vendor_/jquery/jquery.min.js"></script>
        <script src="vendor_/bootstrap/js/bootstrap.bundle.min.js"></script> 
        <script src="vendor_/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor_/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor_/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="vendor_/chart.js/Chart.min.js"></script>
    </body>



</html>

<script>
     $(document).ready(function(){

        setInterval(
            function(){
                $('#seccionRecargar').load('seccionRecarga.php')
            },5000
        
        )
       
     });
</script> 