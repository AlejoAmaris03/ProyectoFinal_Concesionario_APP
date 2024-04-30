<?php //Clase u Objeto para la tabla "Usuario"
    class Usuario{
        private $id;
        private $nombre;
        private $apellido;
        private $correo;
        private $fechaNacimiento;
        private $tipoUsuario;
        private $usuario;
        private $clave;
        private $estado;

        //Métodos Get
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function getFechaNacimiento(){
            return $this->fechaNacimiento;
        }
        public function getTipoUsuario(){
            return $this->tipoUsuario;
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function getClave(){
            return $this->clave;
        }
        public function getEstado(){
            return $this->estado;
        }

        //Métodos Set
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        public function setFechaNacimiento($fechaNacimiento){
            $this->fechaNacimiento = $fechaNacimiento;
        }
        public function setTipoUsuario($tipoUsuario){
            $this->tipoUsuario = $tipoUsuario;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function setClave($clave){
            $this->clave = $clave;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
    }
?>