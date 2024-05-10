<?php
    include("../Config/Conexion.php");

    class SedeDAO{
        public function listarSedes(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar las Sedes: ".$e->getMessage());
            }
        }
        public function agregarSedes($s){
            $conexion = Conexion::conectar();

            try{
                $nombre = $s->getNombre();
                $direccion = $s->getDireccion();

                $sql = $conexion->query("INSERT INTO SedesConcesionario(Nombre,Direccion) VALUES ('$nombre','$direccion')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar las Sedes: ".$e->getMessage());
            }
        }
        public function modificarSedes($s){
            $conexion = Conexion::conectar();

            try{
                $id = $s->getId();
                $nombre = $s->getNombre();
                $direccion = $s->getDireccion();

                $sql = $conexion->query("UPDATE SedesConcesionario SET Nombre='$nombre',Direccion='$direccion' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al editar las Sedes: ".$e->getMessage());
            }
        }
        public function eliminarSedes($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("DELETE FROM SedesConcesionario WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar las Sedes: ".$e->getMessage());
            }
        }
        public function buscarSedePorNombre($nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario WHERE(Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una Sede: ".$e->getMessage());
            }
        }
        public function buscarSedePorDireccion($direccion){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario WHERE(Direccion='$direccion')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una Sede: ".$e->getMessage());
            }
        }
        public function buscarSedePorId($id){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una Sede: ".$e->getMessage());
            }
        }
        public function buscarSedePorIdNombre($id,$nombre){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario WHERE(ID!=$id AND Nombre='$nombre')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una Sede: ".$e->getMessage());
            }
        }
        public function buscarSedePorIdDireccion($id,$direccion){
            $conexion = Conexion::conectar();
        
            try{
                $sql = $conexion->query("SELECT * FROM SedesConcesionario WHERE(ID!=$id AND Direccion='$direccion')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al Buscar una Sede: ".$e->getMessage());
            }
        }
    }
?>