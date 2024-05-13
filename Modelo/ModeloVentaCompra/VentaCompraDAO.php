<?php
    include("../Config/Conexion.php");

    class VentaCompraDAO{
        function generarReferencia($idV){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT COUNT(IdVehiculo) AS Referencia FROM VentasCompras WHERE(IdVehiculo=$idV)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al generar la Referencia: ".$e->getMessage());
            }
        }
    }
?>