<?php
    class Extra{
        private $idVentaCompra;
        private $idEquipamiento;
        private $cantidad;

        //Métodos Get
        public function getIdVentaCompra(){
            return $this->idVentaCompra;
        }
        public function getIdEquipamiento(){
            return $this->idEquipamiento;
        }
        public function getCantidad(){
            return $this->cantidad;
        }

        //Métodos Set
        public function setIdVentaCompra($idVentaCompra){
            $this->idVentaCompra = $idVentaCompra;
        }
        public function setIdEquipamiento($idEquipamiento){
            $this->idEquipamiento = $idEquipamiento;
        }
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
    }
?>