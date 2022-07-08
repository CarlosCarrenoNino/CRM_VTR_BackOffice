<?php

/* $serverName = "LAPTOP-RKR7SOR0\MSSQLSERVER01";
$conectionInfo = array("Database" => "VTR_BACKOFFICE_RPA_13102021", "UID" => "LAPTOP-RKR7SOR0\Carlos", "PWD"=>" ", "CharacterSet"=>"UTF-8");

$conn=sqlsrv_connect($serverName, $conectionInfo);

if($conn){

    echo("Conexion Establecida");

}else{
    die('Conexion Fallida');
} */



$serverName = "LAPTOP-RKR7SOR0\MSSQLSERVER01";

$connectionInfo = array ("Database"=>"VTR_BACKOFFICE_RPA_13102021");
$conn = sqlsrv_connect($serverName, $connectionInfo);

/*  if($conn){
   echo "DB conectada";
}else{
    echo "DB No Conectada";
    die (print_r(slqsrv_errors(), true));
} */

 


?>