<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/sucursal.models.php");
//require_once("../models/Accesos.models.php");
$Sucursales = new Sucursales;
//$Accesos = new Accesos;
switch ($_GET["op"]) {
        /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Sucursales->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $idUsuarios = $_POST["idUsuarios"];
        $datos = array();
        $datos = $Usuarios->uno($idUsuarios);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        /*TODO: Procedimiento para insertar */
    case 'insertar':
        $Nombre = $_POST["Nombre"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Correo = $_POST["Correo"];
        $Parroquia = $_POST["Parroquia"];
        $Canton = $_POST["Canton"];
        $Provincia = $_POST["Provincia"];
        $datos = array();
        $datos = $Sucursales->InsertarSucu($Nombre, $Direccion, $Telefono, $Correo, $Parroquia, $Canton, $Provincia);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $idUsuarios = $_POST["idUsuarios"];
        $Nombres = $_POST["Nombres"];
        $Apellidos = $_POST["Apellidos"];
        $Correo = $_POST["Correo"];
        $Contrasenia = $_POST["Contrasenia"];
        $Roles_idRoles = $_POST["Roles_idRoles"];
        $datos = array();
        $datos = $Usuarios->Actualizar($idUsuarios, $Nombres, $Apellidos, $Correo, $Contrasenia, $Roles_idRoles);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $idUsuarios = $_POST["idUsuarios"];
        $datos = array();
        $datos = $Usuarios->Eliminar($idUsuarios);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para insertar */
    case 'login':
        $correo = $_POST['correo'];
        $contrasenia = $_POST['contrasenia'];

        //TODO: Si las variables estab vacias rgersa con error
        if (empty($correo) or  empty($contrasenia)) {
            header("Location:../login.php?op=2");
            exit();
        }

        try {
            $datos = array();
            $datos = $Usuarios->login($correo, $contrasenia);
            $res = mysqli_fetch_assoc($datos);
        } catch (Throwable $th) {
            header("Location:../login.php?op=1");
            exit();
        }
        //TODO:Control de si existe el registro en la base de datos
        try {
            if (is_array($res) and count($res) > 0) {
                //if ((md5($contrasenia) == ($res["Contrasenia"]))) {
                if ((($contrasenia) == ($res["Contrasenia"]))) {
                    //$datos2 = array();
                    // $datos2 = $Accesos->Insertar(date("Y-m-d H:i:s"), $res["idUsuarios"], 'ingreso');

                    $_SESSION["idUsuarios"] = $res["idUsuarios"];
                    $_SESSION["Usuarios_Nombres"] = $res["Nombres"];
                    $_SESSION["Usuarios_Apellidos"] = $res["Apellidos"];
                    $_SESSION["Usuarios_Correo"] = $res["Correo"];
                    $_SESSION["Usuario_IdRoles"] = $res["idRoles"];
                    $_SESSION["Rol"] = $res["Rol"];



                    header("Location:../views/home.php");
                    exit();
                } else {
                    header("Location:../login.php?op=1");
                    exit();
                }
            } else {
                header("Location:../login.php?op=1");
                exit();
            }
        } catch (Exception $th) {
            echo ($th->getMessage());
        }
        break;
}