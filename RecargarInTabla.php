<?php

date_default_timezone_set('America/Santiago');
$fechaHoy1 = date('d/m/Y');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

session_start();

require('conexion.php');
?>

            <form action ="update_tabla_indicadores.php" method="POST">
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
        <script src="vendor_/jquery/jquery.min.js"></script>
        <script src="vendor_/bootstrap/js/bootstrap.bundle.min.js"></script> 
        <script src="vendor_/jquery-easing/jquery.easing.min.js"></script>
        <script src="vendor_/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor_/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="vendor_/chart.js/Chart.min.js"></script>
  

       