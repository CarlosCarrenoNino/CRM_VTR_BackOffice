<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar VTR-Back-Office</title>
    <link rel="icon" href="vtricono.ico" type="image/x-icon">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    
</head>
<body class="bg-dark" background="vtr_fondo2.png" class="sb-nav-fixed">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container" >
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Actualizar</h3>
                                    <div class="card card-body Actulizar-card">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label Actulizar-card">Seleccionar el archivo a cargar.</label>
                                                <input class="form-control Actulizar-card" type="file" id="archivo-cargar-crm" name="archivo-cargar-crm" value="Seleccionar">
                                                <br>
                                                <label class="form-label Actulizar-card">Seleccionar los archivos.</label>
                                                <input class="form-control" type="file" id="archivo-cargar-crm2[]" name="archivo-cargar-crm2[]" value="Seleccionar" directory multiple>
                                                <br>
                                                <div class="col-sm-12">
                                                    <label for="">Ubicacion Guardar: </label>
                                                    <input class="form-control Actulizar-card" type="text" id="ubicacion-guardar-file" name="ubicacion-guardar-file" value="VTR_BACK_OFFICE/">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-danger form-control mb-3 actulizar-archivo" name="cargar-file-upload-crm">Cargar Solo</button>
                                                <button type="submit" class="btn btn-danger form-control mb-3" name="cargar-file-upload-crm2">Cargar Carpeta</button>
                                            </div>
                                        </form>
                                            <?php
                                            if(isset($_POST['cargar-file-upload-crm'])){
                                                
                                                $sizeFile = $_FILES['archivo-cargar-crm']['size'];
                                                
                                                $nameFile = $_FILES['archivo-cargar-crm']['name'];
                                            
                                                if($nameFile!="") {
                                                    $RutaGuarda = '../'.$_POST['ubicacion-guardar-file'];
                                                    $target_path = $RutaGuarda . basename( $_FILES['archivo-cargar-crm']['name']);
                                                
                                                    if(move_uploaded_file($_FILES['archivo-cargar-crm']['tmp_name'], $target_path)) {
                                                        echo "<script>alert('El archivo: ".basename( $_FILES['archivo-cargar-crm']['name'])." ha sido cargado');</script>";
                                                        echo '<script> window.location="cargar.php"; </script>';
                                                    } else{
                                                        echo "<script>alert('Ha ocurrido un error, al intentar guardar el archivo.');</script>";
                                                        echo '<script> window.location="cargar.php"; </script>';
                                                    }   
                                                }else{
                                                    echo "<script>alert('No ha seleccionado un archivo valido.);</script>";
                                                }
                                            }
                                            if(isset($_POST['cargar-file-upload-crm2'])){
                                                $CargarCorrecta = 0;
                                                $CargarIncorrecta = 0;
                                                foreach($_FILES["archivo-cargar-crm2"]['tmp_name'] as $key => $tmp_name)
                                                {
                                                    //Validamos que el archivo exista
                                                    if($_FILES["archivo-cargar-crm2"]["name"][$key]) {
                                                        $filename = $_FILES["archivo-cargar-crm2"]["name"][$key]; //Obtenemos el nombre original del archivo
                                                        $source = $_FILES["archivo-cargar-crm2"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                                                        $RutaGuarda = '../'.$_POST['ubicacion-guardar-file'];
                                        
                                                        if(file_exists($RutaGuarda)){
                                                            //echo "<script>alert('La carpeta especificada existe');</script>";
                                                        }else{
                                                            echo "<script>alert('La carpeta especificada no existe');</script>";
                                                            mkdir($RutaGuarda, 0700);
                                                        }
                                                        $dir=opendir($RutaGuarda);
                                        
                                                        $target_path = $RutaGuarda . basename( $_FILES['archivo-cargar-crm2']['name'][$key]);
                                                        if(move_uploaded_file($_FILES['archivo-cargar-crm2']['tmp_name'][$key], $target_path)) {
                                                            $CargarCorrecta ++;
                                                        } else{
                                                            $CargarIncorrecta ++;
                                                        }
                                                        closedir($dir);
                                                    }
                                                }
                                                echo "<script>alert('Se cargaron correctamente -".$CargarCorrecta."- archivos. No se cargaron -".$CargarIncorrecta."- archivos.');</script>";
                                                echo '<script> window.location="cargar.php"; </script>';
                                            }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </main>
        </div>
    </div>
                        
</body>
</html>