<?php
  class Connection{
    public function Connect(){
      return $this->Connect2();
    }
    private function Connect2(){
      $this->credenciales = parse_ini_file(".credentials/db.php.ini");
      $BaseDeDatos = $this->credenciales["BaseDeDatos"];
      $Server = $this->credenciales["Server"];
      $Password = $this->credenciales["Password"];
      $User = $this->credenciales["User"];
      $serverName = $Server;
      if($User=="" || $User==null){
        $connectionInfo = array("Database"=>$BaseDeDatos);
      }else{
        $connectionInfo = array("Database"=>$BaseDeDatos,"UID"=>$User, "PWD"=>$Password, "CharacterSet"=>"UTF-8");
      }
      $conn = sqlsrv_connect($serverName, $connectionInfo);

      if($conn){
        /* echo 'Conexion Establecida'; */
        return $conn;
      }else{
        die( print_r( sqlsrv_errors(), true));
        echo '<script> alert("Conexion fallida al servidor.");</script>';
        exit;
      }
    }
  }
  //phpinfo();
  $ClassConnect = new Connection;
  $conn = $ClassConnect->Connect();

?>