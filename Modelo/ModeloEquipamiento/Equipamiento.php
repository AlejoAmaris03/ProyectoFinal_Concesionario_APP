<?php
    class Equipamiento{
        private $id;
        private $nombre;
        private $precio;

        //Métodos Get
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getPrecio(){
            return $this->precio;
        }
        
        //Métodos Set
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
    }
?>