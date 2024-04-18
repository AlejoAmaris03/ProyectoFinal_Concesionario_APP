<?php
    //Se implementa la conexión usando el Patrón de Diseño Singleton y PDO
    class Conexion{
        private $c = NULL;
        private static $con;

        private function __construct(){
            define("host","localhost");
            define("username","root");
            define("password","123456");
            define("database","Concesionario");

            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            
            try{
                $this->c = new PDO("mysql:host=".host.";dbname=".database,username,password,$options);
            } 
            catch (Exception $e){
                die("ERROR al realizar la conexión <br>".$e->getMessage());
            }
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