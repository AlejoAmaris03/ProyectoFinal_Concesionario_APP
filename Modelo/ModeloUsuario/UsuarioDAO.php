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
        public function buscarUsuarioPorUsuarioTipo($usuario,$tipoUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(Usuario='$usuario' AND TipoUsuario='$tipoUsuario')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function verificarUsuarioPorId($id,$usuario,$tipoUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(ID!=$id AND Usuario='$usuario' AND TipoUsuario='$tipoUsuario')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function agregarUsuarios($u){
            $conexion = Conexion::conectar();

            try{
                $nombre = $u->getNombre();
                $apellido = $u->getApellido();
                $correo = $u->getCorreo();
                $fechaNacimiento = $u->getFechaNacimiento();
                $tipoUsuario = $u->getTipoUsuario();
                $usuario = $u->getUsuario();
                $clave = $u->getClave();
                
                $sql = $conexion->query("INSERT INTO Usuarios(Nombre,Apellido,Correo,FechaNacimiento,TipoUsuario,Usuario,Clave,Estado) VALUES('$nombre','$apellido','$correo','$fechaNacimiento','$tipoUsuario','$usuario','$clave','Activo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al agregar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function modificarUsuarios($u){
            $conexion = Conexion::conectar();

            try{
                $id = $u->getID();
                $nombre = $u->getNombre();
                $apellido = $u->getApellido();
                $correo = $u->getCorreo();
                $fechaNacimiento = $u->getFechaNacimiento();
                $tipoUsuario = $u->getTipoUsuario();
                $usuario = $u->getUsuario();
                $clave = $u->getClave();
                
                $sql = $conexion->query("UPDATE Usuarios SET Nombre='$nombre',Apellido='$apellido',Correo='$correo',FechaNacimiento='$fechaNacimiento',TipoUsuario='$tipoUsuario',Usuario='$usuario',Clave='$clave' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al modificar un usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function modificarEstadoUsuario($id,$estado){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("UPDATE Usuarios SET Estado='$estado' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al modficar el estado de un usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function eliminarUsuario($id){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("DELETE FROM Usuarios WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al eliminar un usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
    }
?>