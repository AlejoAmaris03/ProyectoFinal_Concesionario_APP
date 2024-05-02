<?php
    include("../Config/Conexion.php");

    class MarcaVehiculoDAO{
        public function listarMarcasVehiculos(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM MarcasVehiculos");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar las Marcas de Vehículos: ".$e->getMessage());
            }
        }
        public function agregarMarcaVehiculo($mV){
            $conexion = Conexion::conectar();

            try{
                $nombre = $mV->getNombre();

                $sql = $conexion->query("INSERT INTO MarcasVehiculos(Nombre) VALUES ('$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar las Marcas de Vehículos: ".$e->getMessage());
            }
        }
        public function modificarMarcaVehiculo($mV){
            $conexion = Conexion::conectar();

            try{
                $id = $mV->getId();
                $nombre = $mV->getNombre();

                $sql = $conexion->query("UPDATE MarcasVehiculos SET Nombre='$nombre' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al editar las Marcas de Vehículos: ".$e->getMessage());
            }
        }
        public function eliminarMarcaVehiculo($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM MarcasVehiculos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar las Marcas de Vehículos: ".$e->getMessage());
            }
        }
        public function buscarMarcaPorNombre($nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM MarcasVehiculos WHERE(Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una marca: ".$e->getMessage());
            }
        }
        public function buscarMarcaPorId($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM MarcasVehiculos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una marca: ".$e->getMessage());
            }
        }
        public function buscarMarcaPorIdNombre($id,$nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM MarcasVehiculos WHERE(ID!=$id AND Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una marca: ".$e->getMessage());
            }
        }
    }
?>