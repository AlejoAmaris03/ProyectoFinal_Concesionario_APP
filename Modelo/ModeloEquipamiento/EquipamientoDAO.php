<?php
    include("../Config/Conexion.php");

    class EquipamientoDAO{
        public function listarEquipamientos(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Equipamientos");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Equipamientos: ".$e->getMessage());
            }
        }
        public function agregarEquipamiento($e){
            $conexion = Conexion::conectar();

            try{
                $nombre = $e->getNombre();
                $precio = $e->getPrecio();

                $sql = $conexion->query("INSERT INTO Equipamientos(Nombre,Precio) VALUES ('$nombre',$precio)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar el Equipamiento: ".$e->getMessage());
            }
        }
        public function modificarEquipamento($e){
            $conexion = Conexion::conectar();

            try{
                $id = $e->getId();
                $nombre = $e->getNombre();
                $precio = $e->getPrecio();

                $sql = $conexion->query("UPDATE Equipamientos SET Nombre='$nombre',Precio='$precio' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al editar el Equipamiento: ".$e->getMessage());
            }
        }
        public function eliminarEquipamento($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM Equipamientos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar el Equipamiento: ".$e->getMessage());
            }
        }
        public function buscarEquipamientoPorNombre($nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM Equipamientos WHERE(Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un Equipamiento: ".$e->getMessage());
            }
        }
        public function buscarEquipamentoPorId($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM Equipamientos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un Equipamiento: ".$e->getMessage());
            }
        }
        public function buscarEquipamientoPorIdNombre($id,$nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM Equipamientos WHERE(ID!=$id AND Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar un Equipamiento: ".$e->getMessage());
            }
        }
    }
?>