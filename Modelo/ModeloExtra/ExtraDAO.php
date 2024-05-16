<?php
    include("../Config/Conexion.php");

    class ExtraDAO{
        public function agregarExtras($extra){
            $conexion = Conexion::conectar();

            try{
                $idVentaCompra = $extra->getIdVentaCompra();
                $idEquipamiento = $extra->getIdEquipamiento();
                $cantidad = $extra->getCantidad();

                $sql = $conexion->query("INSERT INTO Extras (IdVentaCompra,IdEquipamiento,Cantidad) VALUES ($idVentaCompra,$idEquipamiento,$cantidad)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al agregar el Extra: ".$e->getMessage());
            }
        }
        function listarExtrasPorIdCompra($idCompra){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT EQ.Nombre AS Equipamiento,EQ.Precio,EX.Cantidad FROM Extras EX JOIN Equipamientos EQ ON (Ex.IdEquipamiento=EQ.ID) WHERE(EX.IdVentaCompra=$idCompra)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al listar los Extras Por IdCompra: ".$e->getMessage());
            }
        }
        function eliminarExtasPorIdCompraVenta($idVentaCompra){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("DELETE FROM Extras WHERE(IdVentaCompra=$idVentaCompra)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar los Extas de una Venta/Compra: ".$e->getMessage());
            }
        }
    }
?>