<?php
    include("../Config/Conexion.php"); 

    class UsuarioDAO{
        public function listarUsuarios($id){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(ID!=$id AND Estado='Activo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar los Usuarios: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function listarUsuariosInactivos(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(Estado='Inactivo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar los Usuarios Inactivos: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuario($usuario,$clave,$tipoUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(Usuario='$usuario' AND Clave='$clave' AND TipoUsuario='$tipoUsuario')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuarioPorID($id){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
    }
?>