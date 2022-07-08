<?php

date_default_timezone_set('America/Santiago');
$fechaHoy1 = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

session_start();

require('conexion.php');
?>
   <div class="container">
            <div class="row">
				<?php
					$query="EXEC [SPR_GET_TOTALES_ANDES] '".$fechaHoy1."','Andes','Asignado'";
					$resultado=sqlsrv_query($conn, $query);

					$information = [];
					$count = 0;
					$ASINGADOS= 0;
				    while($row=sqlsrv_fetch_array($resultado)){
						$information[$count] = $row;
						$ASINGADOS = $row[0];
						if(isset($_GET[$ASINGADOS==" "]) && isset($_GET[$ASINGADOS==null])){
						$ASINGADOS=0;
					}
					};
					
				?>

				<?php
					$query="EXEC [SPR_GET_TOTALES_ANDES_PEN] '".$fechaHoy1."', 'Andes', 'Pendiente'";
					$resultado=sqlsrv_query($conn, $query);

					$information = [];
					$count = 0;
					$PENDIENTE= 0;
				    while($row=sqlsrv_fetch_array($resultado)){
						$information[$count] = $row;
						$PENDIENTE = $row[0];
						if(isset($_GET[$PENDIENTE==" "]) && isset($_GET[$PENDIENTE==null])){
						$PENDIENTE=0;
					}
					};
				?>

				<?php
					$query="EXEC [SPR_GET_TOTALES_TANGO] '".$fechaHoy1."', 'Tango', 'Asignado'";
					$resultado=sqlsrv_query($conn, $query);

					$information = [];
					$count = 0;
					$ASINGADOT= 0;
				    while($row=sqlsrv_fetch_array($resultado)){
						$information[$count] = $row;
						$ASINGADOT = $row[0];
						if(isset($_GET[$ASINGADOT==" "]) && isset($_GET[$ASINGADOT==null])){
						$ASINGADOT=0;
					}
					};
					
				?>

				<?php
					$query="EXEC [SPR_GET_TOTALES_TANGO_PEN] '".$fechaHoy1."', 'Tango', 'Pendiente'";
					$resultado=sqlsrv_query($conn, $query);

					$information = [];
					$count = 0;
					$PENDIENTET= 0;
				    while($row=sqlsrv_fetch_array($resultado)){
						$information[$count] = $row;
						$PENDIENTET = $row[0];
						if(isset($_GET[$PENDIENTET==" "]) && isset($_GET[$PENDIENTET==null])){
						$PENDIENTET=0;
					}
					};
				?>


                    <div class="col-xs-12 col-sm-6 col-md-3"  > 
					
						<div class="card horizontal cardIcon waves-effect waves-dark text-center" style="height: 82px;" >
						<div class="card-image red">
						<i class="material-icons dp48"> Totales Andes</i>
						</div>
						<div class="card-stacked red">
						<div class="card-content">
						<h2><?php echo $ASINGADOS + $PENDIENTE; ?></h2> 
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
						<h6>Asignado: <?php echo $ASINGADOS; ?> </h6> 
						<h6>Pendiente: <?php echo $PENDIENTE; ?></h6>
						</div>
						
						</div>
						</div> 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
							<div class="card horizontal cardIcon waves-effect waves-dark text-center" style="height: 82px;">
						<div class="card-image blue">
						<i class="material-icons dp48">Totales Tango</i>
						</div>
						<div class="card-stacked blue">
						<div class="card-content">
						<h2><?php echo $ASINGADOT + $PENDIENTET; ?></h2>
						
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
						<h6>Asignado: <?php echo $ASINGADOT; ?> </h6> 
						<h6>Pendiente: <?php echo $PENDIENTET; ?></h6>
						</div>
					
						</div>
						</div> 
						 
                    </div>
                </div>
             </div>
             <br>
			 



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
  
       