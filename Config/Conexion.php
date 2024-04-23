<?php
    //Se implementa la conexión usando el Patrón de Diseño Singleton y PDO
    class Conexion{
        private $c = NULL;
        private static $con;

        private function __construct(){ //Constructor
            $host = "localhost";
            $usuario = "root";
            $clave = "123456";
            $bd_nombre = "Concesionario";

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            
            try{
                $this->c = new PDO("mysql:host=$host;dbname=$bd_nombre",$usuario,$clave,$opciones);
            } 
            catch (Exception $e){
                die("ERROR al realizar la conexión <br>".$e->getMessage());
            }
        }
        public static function getConexion(){ //Método que retora el objeto de tipo Conexión
            if(!self::$con)
                self::$con = new Conexion();

            return self::$con;
        }
        public function getCon(){ //Método que retorna la conexión la BD
            return $this->c;
        }
    }
?>