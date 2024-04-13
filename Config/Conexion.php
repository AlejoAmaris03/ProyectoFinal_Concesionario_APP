<?php
    //Se implementa la conexión usando el Patrón de Diseño Singleton
    class Conexion{
        private $c = NULL;
        private static $con;

        private function __construct(){
            $this->c = new mysqli("localhost","root","123456","Concesionario");
            $this->c->set_charset("UTF8");

            if(!$this->c)
                die("ERROR al realizar la conexión <br>".$this->c->mysqli_error());
        }
        public static function getConexion(){
            if(!self::$con)
                self::$con = new Conexion();

            return self::$con;
        }
        public function getCon(){
            return $this->c;
        }
    }
?>