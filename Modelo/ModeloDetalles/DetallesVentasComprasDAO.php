<?php
    include("../Config/Conexion.php");

    class DetallesVentasComprasDAO{
        public function agregarDetallesCompra($detalles){
            $conexion = Conexion::conectar();

            try{
                $idCompra = $detalles->getIdVentaCompra();
                $nombreComprador = $detalles->getNombreComprador();
                $correoComprador = $detalles->getCorreoComprador();
                $sede = $detalles->getSedeConcesionario();

                $sql = $conexion->query("INSERT INTO DetallesVentasCompras(IdVentaCompra,NombreComprador,CorreoComprador,SedeConcesionario) VALUES($idCompra,'$nombreComprador','$correoComprador','$sede')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar los detalles de la Compra: ".$e->getMessage());
            }
        }
        public function agregarDetallesVenta($detalles){
            $conexion = Conexion::conectar();

            try{
                $idCompra = $detalles->getIdVentaCompra();
                $nombreVendedor = $detalles->getNombreVendedor();
                $nombreComprador = $detalles->getNombreComprador();
                $correoComprador = $detalles->getCorreoComprador();
                $sede = $detalles->getSedeConcesionario();

                $sql = $conexion->query("INSERT INTO DetallesVentasCompras(IdVentaCompra,NombreVendedor,NombreComprador,CorreoComprador,SedeConcesionario) VALUES($idCompra,'$nombreVendedor','$nombreComprador','$correoComprador','$sede')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar los detalles de la Venta: ".$e->getMessage());
            }
        }
        public function obtenerSede($idSede){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT CONCAT(Nombre,' - ',Direccion) AS Sede FROM SedesConcesionario WHERE(ID=$idSede) GROUP BY ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar los detalles de la Compra: ".$e->getMessage());
            }
        }   
        function eliminarDetallesPorIdCompraVenta($idVentaCompra){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("DELETE FROM DetallesVentasCompras WHERE(IdVentaCompra=$idVentaCompra)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar los Detalles de una Venta/Compra: ".$e->getMessage());
            }
        }
    }
?>