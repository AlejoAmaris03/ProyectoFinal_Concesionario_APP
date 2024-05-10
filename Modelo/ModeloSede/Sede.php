<?php
    class Sede{
        private $id;
        private $nombre;
        private $direccion;

        //Métodos Get
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDireccion(){
            return $this->direccion;
        }

        //Métodos Set
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
    }
?>