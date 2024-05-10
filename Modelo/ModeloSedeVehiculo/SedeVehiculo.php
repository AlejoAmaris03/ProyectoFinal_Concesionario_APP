<?php
    class SedeVehivulo{
        private $idSede;
        private $idVehiculo;
        private $cantidad;

        //Métodos Get
        public function getIdSede(){
            return $this->idSede;
        }
        public function getIdVehiculo(){
            return $this->idVehiculo;
        }
        public function getCantidad(){
            return $this->cantidad;
        }

        //Métodos Set
        public function setIdSede($idSede){
            $this->idSede = $idSede;
        }
        public function setIdVehiculo($idVehiculo){
            $this->idVehiculo = $idVehiculo;
        }
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
    }
?>