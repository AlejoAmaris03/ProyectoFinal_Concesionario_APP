<?php
    include("../Config/Conexion.php");

    class SedeVehiculoDAO{
        public function agregarSedeVehiculo($sV){
            $conexion = Conexion::conectar();

            try{
                $idSede = $sV->getIdSede();
                $idVehiculo = $sV->getIdVehiculo();
                $cantidad = $sV->getCantidad();

                $sql = $conexion->query("INSERT INTO SedesVehiculo(IdSede,IdVehiculo,Cantidad) VALUES ($idSede,$idVehiculo,$cantidad)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar las Sedes - Vehículos: ".$e->getMessage());
            }
        }
        public function obtenerStock($idS,$idV){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT Cantidad FROM SedesVehiculo WHERE(IdSede=$idS AND IdVehiculo=$idV)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al obtener el Stock: ".$e->getMessage());
            }
        }
        public function actualizarStock($idS,$idV,$stock){
            $conexion = Conexion::conectar();

            try{
                $cantidad = $stock - 1; 

                $sql = $conexion->query("UPDATE SedesVehiculo SET Cantidad=$cantidad WHERE(IdSede=$idS AND IdVehiculo=$idV)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al actualizar el Stock: ".$e->getMessage());
            }
        }
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
        public function eliminarPorIdVehiculo($idV){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM SedesVehiculo WHERE(IdVehiculo=$idV)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar las Sede por Id Vehículo: ".$e->getMessage());
            }
        }
        public function eliminarPorIdSede($idS){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM SedesVehiculo WHERE(IdSede=$idS)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar las Vehículo por Id Sede: ".$e->getMessage());
            }
        }
    }
?>