<?php
    include("../../Config/Conexion.php"); 

    class UsuarioDAO{
        private $objetoConexion = Conexion::getConexion();
        private $conexion = $this->objetoConexion->getCon();
        private $datos = NULL;

        public function buscarUsuario($usuario,$clave,$tipoUsuario){
            try{
                $sql = $this->conexion->query("SELECT * FROM Usuarios WHERE(Usuario='$usuario' AND Clave='$clave' AND TipoUsuario='$tipoUsuario')");

                $this->datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $this->datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario <br>".$e->getMessage());
            }
            
            $this->conexion = NULL;
        }
    }
?>