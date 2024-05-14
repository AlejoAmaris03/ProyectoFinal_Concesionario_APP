<?php
    class DetallesVentasCompras{
        private $idVentaCompra;
        private $nombreVendedor;
        private $nombreComprador;
        private $correoComprador;
        private $sedeConcesionario;

        //Métodos Get
        public function getIdVentaCompra(){
            return $this->idVentaCompra;
        }
        public function getNombreVendedor(){
            return $this->nombreVendedor;
        }
        public function getNombreComprador(){
            return $this->nombreComprador;
        }
        public function getCorreoComprador(){
            return $this->correoComprador;
        }
        public function getSedeConcesionario(){
            return $this->sedeConcesionario;
        }

        //Métodos Set
        public function setIdVentaCompra($idVentaCompra){
            $this->idVentaCompra = $idVentaCompra;
        }
        public function setNombreVendedor($nombreVendedor){
            $this->nombreVendedor = $nombreVendedor;
        }
        public function setNombreComprador($nombreComprador){
            $this->nombreComprador = $nombreComprador;
        }
        public function setCorreoComprador($correoComprador){ // El nombre del método set no coincide con el nombre de la propiedad
            $this->correoComprador = $correoComprador; // Debería ser correoComprador en lugar de correoVendedor
        }
        public function setSedeConcesionario($sedeConcesionario){
            $this->sedeConcesionario = $sedeConcesionario;
        }
    }
?>