<?php
    include("../Config/Conexion.php");

    class SedeVehiculoDAO{
        public function buscarSedePorId($id){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM SedesVehiculo WHERE(IdSede=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar las Sedes: ".$e->getMessage());
            }
        }
        public function buscarVehiculoPorId($id){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT SV.IdSede,SV.IdVehiculo,SV.Cantidad,S.Nombre AS Sede,S.Direccion AS Direccion FROM SedesVehiculo SV JOIN SedesConcesionario S ON (SV.IdSede=S.ID) JOIN Vehiculos V ON (SV.IdVehiculo=V.ID) WHERE(IdVehiculo=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Vehiculos: ".$e->getMessage());
            }
        }
    }
?>