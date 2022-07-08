<?php

date_default_timezone_set('America/Santiago');
$fechaHoy1 = date('Y/m/d');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

session_start();
$asesor= $_SESSION['UsuarioIngreso'];
require('conexion.php');

?>


<div class="row" >
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body" >
                    
                    <!-- <h4>Descargar Informes</h4> -->
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
                                    <script>
                                        var UsuariosArray = new Array();
                                        var IdGestionArray = new Array();
                                        var EstadosArray = new Array();
                                    </script>
                                    <?php
                                //Primera Consulta A La tabla De Conexion Solo Hoy. Aqui Trae El UsuarioCRM, Estado

                                $usuario = "EXEC [SPR_GET_CONEXION_ASESOR] '".$fechaHoy."'";
                                $resultadoCone = sqlsrv_query($conn,$usuario);

                                while($rowCone = sqlsrv_fetch_array($resultadoCone)){
                                    $CON_CUSUARIO = $rowCone['CON_CUSUARIO'];
                                    $CON_CESTADO = $rowCone['CON_CESTADO'];
                                    $CON_CESTADO_SESSION = $rowCone['CON_CESTADO_SESSION'];

                                    $nombre = "EXEC [SPR_GET_NOMBRE_ASESOR] '".$CON_CUSUARIO."'"; 
                                    $resultadoNOM = sqlsrv_query($conn,$nombre); 
                                    while($rowUsuarios = sqlsrv_fetch_array($resultadoNOM)){
                                        $NombreCompleto = $rowUsuarios['CRE_CNOMBRE'];
                                    }
                                    $indicadores="EXEC [SPR_GET_TMO_EFECTIVIDAD] '".$CON_CUSUARIO."','".$fechaHoy1."','Finalizado'";
                                    $resultadoIND = sqlsrv_query($conn,$indicadores);
                                    $TMO = 0;
                                    $TIP_NEFECTIVIDAD = 0;
                                    while($rowInd = sqlsrv_fetch_array($resultadoIND)){
                                        $TMO = $rowInd['TMO'];
                                        $TIP_NEFECTIVIDAD = $rowInd['TIP_NEFECTIVIDAD'];
                                    }

                                    $IdBase = 0;
                                    $IdBaseActual="EXEC [SPR_GET_IDBASE] '".$CON_CUSUARIO."','".$fechaHoy1."','Asignado'";
                                    $resultadoBase = sqlsrv_query($conn,$IdBaseActual);
                                    while($rowBase = sqlsrv_fetch_array($resultadoBase)){
                                        $IdBase = $rowBase['TIP_CDETALLE7'];
                                    }



                                        ?> 
                                    
                                        <tr>        
                                        <td class="col-md-3 text-center"><?php echo $NombreCompleto; ?></td>
                                        <td class="col-md-2 text-center"><?php echo $TIP_NEFECTIVIDAD; ?></td>
                                        <td class="col-md-1 text-center"><?php echo $TMO; ?> seg</td>
                                        <td class="col-md-2 text-center"><?php echo $CON_CESTADO_SESSION; ?></td>
                                        <td class="col-md-2 text-center"><?php echo $CON_CESTADO; ?></td>
                                        <td class="col-md-3 text-center">
                                            <div class="cronometro" id="cronometro">
                                                <div id="hms1_<?php echo $CON_CUSUARIO;?>" class="hms1-inactivo"></div>
                                                <script>
                                                    IdResultado = '<?php echo $IdBase;?>';
                                                    UserName = '<?php echo $CON_CUSUARIO;?>';
                                                    EstadoUser = '<?php echo $CON_CESTADO;?>';
                                                    UsuariosArray.push(UserName);
                                                    IdGestionArray.push(IdResultado);
                                                    EstadosArray.push(EstadoUser);
                                                    //alert('IdResultado: '+IdResultado);
                                                    //alert('UserName: '+UserName);
                                                    //let Id_Hms = document.querySelectorAll("#hms1_"+UserName)[0];
                                                    //Id_Hms.classList.toggle("hms1-inactivo");
                                                </script>
                                                </div>
                                                <!-- <script> alert(IdResultado)</script> -->
                                            </div>
                                        </td>
                                    
                                    </tr>

                                <?php   
                                    }
                                ?> 
                                </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>