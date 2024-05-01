<?php //Ejecuta las consultas de la tabla "Usuarios"
    include("../Config/Conexion.php"); 

    class UsuarioDAO{
        public function listarUsuarios($id){ //Lista todos los usuarios (activos)
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT U.ID,U.Nombre,U.Apellido,U.Correo,U.FechaNacimiento,TU.Nombre AS TipoUsuario,U.Usuario,U.Clave,EU.Nombre AS Estado FROM Usuarios U JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN EstadosUsuarios EU ON (U.Estado=EU.ID) WHERE(U.ID!=$id AND EU.Nombre='Activo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar los Usuarios: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function listarUsuariosInactivos(){ //Lista todos los usuarios inactivos
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT U.ID,U.Nombre,U.Apellido,U.Correo,U.FechaNacimiento,TU.Nombre AS TipoUsuario,U.Usuario,U.Clave,EU.Nombre AS Estado FROM Usuarios U JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN EstadosUsuarios EU ON (U.Estado=EU.ID) WHERE(EU.Nombre='Inactivo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar los Usuarios Inactivos: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuario($usuario,$clave){ //Busca un usuario por su Nombre de Usuario y Clave
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT U.ID,U.Nombre,U.Apellido,U.Correo,U.FechaNacimiento,TU.Nombre AS TipoUsuario,U.Usuario,U.Clave,EU.Nombre AS Estado FROM Usuarios U JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN EstadosUsuarios EU ON (U.Estado=EU.ID) WHERE(U.Usuario='$usuario' AND U.Clave='$clave')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuarioPorID($id){ //Busca un usuario por su ID
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT U.ID,U.Nombre,U.Apellido,U.Correo,U.FechaNacimiento,TU.Nombre AS TipoUsuario,U.Usuario,U.Clave,EU.Nombre AS Estado FROM Usuarios U JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN EstadosUsuarios EU ON (U.Estado=EU.ID) WHERE(U.ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuarioPorNombreUsuario($usuario){ //Busca un usuario con un nombre de usuario en específico
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(Usuario='$usuario')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function buscarUsuarioPorCorreo($correo){ //Busca un usuario con un correo en específico
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT U.ID,U.Nombre,U.Apellido,U.Correo,U.FechaNacimiento,TU.Nombre AS TipoUsuario,U.Usuario,U.Clave,EU.Nombre AS Estado FROM Usuarios U JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN EstadosUsuarios EU ON (U.Estado=EU.ID) WHERE(U.Correo='$correo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function verificarUsuarioPorIdCorreo($id,$correo){ //Busca un usuario con un correo en específico (excluyendo a un usuario en específico)
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(ID!=$id AND Correo='$correo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function verificarUsuarioPorIdUsuario($id,$usuario){ //Busca un usuario con un nombre de usuario en específico (excluyendo a un usuario en específico)
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Usuarios WHERE(ID!=$id AND Usuario='$usuario')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function agregarUsuarios($u){ //Agrega un usuario
            $conexion = Conexion::conectar();

            try{
                $nombre = $u->getNombre();
                $apellido = $u->getApellido();
                $correo = $u->getCorreo();
                $fechaNacimiento = $u->getFechaNacimiento();
                $tipoUsuario = $u->getTipoUsuario();
                $usuario = $u->getUsuario();
                $clave = $u->getClave();
                
                $sql = $conexion->query("INSERT INTO Usuarios(Nombre,Apellido,Correo,FechaNacimiento,TipoUsuario,Usuario,Clave,Estado) VALUES('$nombre','$apellido','$correo','$fechaNacimiento','$tipoUsuario','$usuario','$clave',1)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al agregar un Usuario: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function modificarUsuarios($u){ //Modifica la información de un usuario
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
        public function modificarEstadoUsuario($id,$estado){ //Modifica el estado de un usuario
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
        public function eliminarUsuario($id){ //Elimina a un usuario
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