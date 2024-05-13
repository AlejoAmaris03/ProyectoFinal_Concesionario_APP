<?php
    class VentaCompra{
        private $idUsuario;
        private $idVehiculo;
        private $referencia;
        private $placaVehiculo;
        private $total;

        //Métodos Get
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getIdVehiculo(){
            return $this->idVehiculo;
        }
        public function getReferencia(){
            return $this->referencia;
        }
        public function getPlacaVehiculo(){
            return $this->placaVehiculo;
        }
        public function getTotal(){
            return $this->total;
        }

        //Métodos Set
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setIdVehiculo($idVehiculo){
            $this->idVehiculo = $idVehiculo;
        }
        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }
        public function setPlacaVehiculo($placaVehiculo){
            $this->placaVehiculo = $placaVehiculo;
        }
        public function setTotal($total){
            $this->total = $total;
        }
    }
?>