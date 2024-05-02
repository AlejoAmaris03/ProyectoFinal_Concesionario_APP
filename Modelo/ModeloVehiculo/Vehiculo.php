<?php 
    class Vehiculo{
        private $id;
        private $imagen;
        private $placa;
        private $marca;
        private $tipo;
        private $descripcion;
        private $valor;
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
        public function getMarca(){
            return $this->marca;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getValor(){
            return $this->valor;
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
        public function setMarca($marca){
            $this->marca = $marca;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setValor($valor){
            $this->valor = $valor;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
    }
?>