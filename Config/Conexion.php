<?php
    class Conexion{
        public static function conectar(){ //Método que retorna el objeto de tipo Conexión
            $host = "localhost";
            $usuario = "root";
            $clave = "Alejo12345";
            $bd_nombre = "Concesionario";

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            
            try{
                $c = new PDO("mysql:host=$host;dbname=$bd_nombre",$usuario,$clave,$opciones);
                return $c;
            } 
            catch (Exception $e){
                die("ERROR al realizar la conexión: ".$e->getMessage());
            }
        }
    }
?>