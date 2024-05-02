<?php
    include("../Config/Conexion.php");

    class TipoVehiculoDAO{
        public function listarTiposVehiculos(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM TiposVehiculos");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Tipos de Vehículos: ".$e->getMessage());
            }
        }
        public function agregarTipoVehiculo($mV){
            $conexion = Conexion::conectar();

            try{
                $tipo = $mV->getNombre();

                $sql = $conexion->query("INSERT INTO TiposVehiculos(Nombre) VALUES ('$tipo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar los Tipos de Vehículos: ".$e->getMessage());
            }
        }
        public function modificarTipoVehiculo($mV){
            $conexion = Conexion::conectar();

            try{
                $id = $mV->getId();
                $tipo = $mV->getNombre();

                $sql = $conexion->query("UPDATE TiposVehiculos SET Nombre='$tipo' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al editar los Tipos de Vehículos: ".$e->getMessage());
            }
        }
        public function eliminarTipoVehiculo($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM TiposVehiculos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar los Tipos de Vehículos: ".$e->getMessage());
            }
        }
        public function buscarTipoPorNombre($nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM TiposVehiculos WHERE(Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un tipo de vehículo: ".$e->getMessage());
            }
        }
        public function buscarTipoPorId($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM TiposVehiculos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un tipo de vehículo: ".$e->getMessage());
            }
        }
        public function buscarTipoPorIdNombre($id,$nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM TiposVehiculos WHERE(ID!=$id AND Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un tipo de vehículo: ".$e->getMessage());
            }
        }
    }
?>