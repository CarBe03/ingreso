<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');
class Sucursales
{
    /*TODO: Procedimiento para sacar todos los registros*/
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT SucursalId, Nombre, Direccion, Telefono, Correo, Parroquia, Canton, Provincia FROM `Sucursales`";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para sacar un registro*/
    public function uno($SucursalId)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `sucursales` WHERE `SucursalId`=$SucursalId";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para insertar */
    public function InsertarSucu($Nombre, $Direccion, $Telefono, $Correo, $Parroquia, $Canton, $Provincia)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena2 = "INSERT INTO `sucursales`(`Nombre`, `Direccion`, `Telefono`, `Correo`, `Parroquia`, `Canton`, `Provincia`) VALUES('$Nombre','$Direccion','$Telefono','$Correo','$Parroquia','$Canton','$Provincia')";

        if (mysqli_query($con, $cadena2)) {
            return "ok";
        } else {
            return mysqli_error($con);
        }
        $con->close();
    }
    /*TODO: Procedimiento para actualizar */
    public function Actualizar()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "";
        if (mysqli_query($con, $cadena)) {
            return "ok";
        } else {
            return 'error al actualizar el registro';
        }
        $con->close();
    }
    /*TODO: Procedimiento para Eliminar */
    public function Eliminar($idAccesos)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();

}
}
