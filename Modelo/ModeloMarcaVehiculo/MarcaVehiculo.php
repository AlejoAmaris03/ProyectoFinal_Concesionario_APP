<?php
    class MarcaVehiculo{
        private $id;
        private $nombre;

        //Métodos Get
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }

        //Métodos Set
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
    }
?>