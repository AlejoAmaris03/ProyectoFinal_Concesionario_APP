<?php 
    class Vehiculo{
        private $id;
        private $imagen;
        private $placa;
        private $modelo;
        private $marca;
        private $tipo;
        private $descripcion;
        private $cantidad;
        private $precio;
        private $estado;

        //Métodos Get
        public function getId(){
            return $this->id;
        }
        public function getImagen(){
            return $this->imagen;
        }
        public function getPlaca(){
            return $this->placa;
        }
        public function getModelo(){
            return $this->modelo;
        }
        public function getMarca(){
            return $this->marca;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getCantidad(){
            return $this->cantidad;
        }
        public function getPrecio(){
            return $this->precio;
        }
        public function getEstado(){
            return $this->estado;
        }
        
        //Métodos Set
        public function setId($id){
            $this->id = $id;
        }
        public function setImagen($imagen){
            $this->imagen = $imagen;
        }
        public function setPlaca($placa){
            $this->placa = $placa;
        }
        public function setModelo($modelo){
            $this->modelo = $modelo;
        }        
        public function setMarca($marca){
            $this->marca = $marca;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
    }
?>