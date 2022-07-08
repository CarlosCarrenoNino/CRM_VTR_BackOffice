<?php
date_default_timezone_set('America/Santiago');
$fechaHoy = date('d/m/Y');
$fechaHoy = date('Y/m/d');
$horaHoy = date('H');
$minutoHoy = date('i:s');
$HoraTotal = $horaHoy.':'.$minutoHoy;

session_start();

require('conexion.php');

    $UsuarioCRM = $_POST['UsuarioCRM'];
    $BaseSkill = $_POST['BaseSkill'];
    $SkillAsigna = $_POST['SkillAsigna'];
    $EstadoSkill = $_POST['EstadoSkill'];
    if($EstadoSkill=="Activo"){
        $query = "EXEC [SPR_SELECT_SKILL2] '".$UsuarioCRM."','".$SkillAsigna."','".$BaseSkill."' ";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $resultado = sqlsrv_query($conn,$query,$params,$options);
        if($resultado==false){
            echo "Error1";
        }else{
            if(sqlsrv_num_rows($resultado) < 1){
                $query = "EXEC [SPR_INSERT_SKILL] '".$UsuarioCRM."', '".$SkillAsigna."', '".$BaseSkill."'";
                $resultado = sqlsrv_query($conn,$query);
                if($resultado==false){
                    echo "Error2";
                }else{
                    echo "Exito";
                }
            }else{
                echo "Exito";
            }
        }
    }elseif($EstadoSkill=="Inactivo"){
        $query = "EXEC [SPR_SELECT_SKILL3] '".$UsuarioCRM."','".$SkillAsigna."','".$BaseSkill."'";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $resultado = sqlsrv_query($conn,$query,$params,$options);
        if($resultado==false){
            echo "Error1";
        }else{
            if(sqlsrv_num_rows($resultado) > 0){
                $query = "EXEC [SPR_DELETE_SKILL] '".$UsuarioCRM."','".$SkillAsigna."','".$BaseSkill."'";
                $resultado = sqlsrv_query($conn,$query);
                if($resultado==false){
                    echo "Error2";
                }else{
                    echo "Exito";
                }
            }else{
                echo "Exito";
            }
        }
    }

?>