<?php
    include("../Config/Conexion.php");

    class VentaCompraDAO{
        function listarVentaCompra(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,CONCAT(U.Nombre,' ',U.Apellido) AS Usuario,VC.IdUsuario,TU.Nombre AS TipoU,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Usuarios U ON (VC.IdUsuario=U.ID) JOIN TiposUsuarios TU ON (U.TipoUsuario=TU.ID) JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Ventas/Compras: ".$e->getMessage());
            }
        }
        function listarCompras($idUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,VC.IdUsuario,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) WHERE(IdUsuario=$idUsuario) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Compras de un Usuario: ".$e->getMessage());
            }
        }
        function listarVentas($idUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,VC.IdUsuario,DVC.NombreComprador AS NombreComprador,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) JOIN DetallesVentasCompras DVC ON (VC.ID=DVC.IdVentaCompra) WHERE(IdUsuario=$idUsuario) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Ventas de un Usuario: ".$e->getMessage());
            }
        }
        function listarComprasPorIdCompra($idCompra){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,VC.IdUsuario,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,DVC.SedeConcesionario AS Sede,V.Precio AS PrecioVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) JOIN DetallesVentasCompras DVC ON (VC.ID=DVC.IdVentaCompra) WHERE(VC.ID=$idCompra) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Compras por Id: ".$e->getMessage());
            }
        }
        function listarVentasPorIdVenta($idVenta){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,VC.IdUsuario,DVC.NombreComprador AS NombreComprador,DVC.CorreoComprador AS CorreoComprador,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,DVC.SedeConcesionario AS Sede,V.Precio AS PrecioVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) JOIN DetallesVentasCompras DVC ON (VC.ID=DVC.IdVentaCompra) WHERE(VC.ID=$idVenta) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Compras por Id: ".$e->getMessage());
            }
        }
        function listarHistorialPorIdVentaCompra($idVentaCompra){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT VC.ID,VC.IdUsuario,DVC.NombreVendedor,DVC.NombreComprador,DVC.CorreoComprador,VC.IdVehiculo,CONCAT(MV.Nombre,' - ',V.Modelo) AS Vehiculo,TV.Nombre AS TipoV,VC.Referencia,VC.PlacaVehiculo,DVC.SedeConcesionario AS Sede,V.Precio AS PrecioVehiculo,VC.FechaVentaCompra,VC.Total FROM VentasCompras VC JOIN Vehiculos V ON (V.ID=VC.IdVehiculo) JOIN MarcasVehiculos MV ON (V.Marca=MV.ID) JOIN TiposVehiculos TV ON (V.Tipo=TV.ID) JOIN DetallesVentasCompras DVC ON (VC.ID=DVC.IdVentaCompra) WHERE(VC.ID=$idVentaCompra) GROUP BY VC.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Ventas/Compras por Id: ".$e->getMessage());
            }
        }
        function listarCompraPorPlacaVehiculo($placaVehiculo){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM VentasCompras WHERE(PlacaVehiculo='$placaVehiculo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al listar las Compras por Id: ".$e->getMessage());
            }
        }
        function generarReferencia($idV){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT MAX(Referencia) AS Referencia FROM VentasCompras WHERE(IdVehiculo=$idV)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al generar la Referencia: ".$e->getMessage());
            }
        }
        function realizarVentaCompra($vC){
            $conexion = Conexion::conectar();

            try{
                $idU = $vC->getIdUsuario();
                $idV =  $vC->getIdVehiculo();
                $ref = $vC->getReferencia();
                $placaV = $vC->getPlacaVehiculo();

                date_default_timezone_set("America/Bogota");
                $fecha = date("Y-m-d H:i:s"); 

                $total = $vC->getTotal();

                $sql = $conexion->query("INSERT INTO VentasCompras(IdUsuario,IdVehiculo,Referencia,PlacaVehiculo,FechaVentaCompra,Total) VALUES ($idU,$idV,$ref,'$placaV','$fecha',$total)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al realizar la Venta/Compra: ".$e->getMessage());
            }
        }
        function eliminarVentaCompraPorIdUsuario($idUsuario){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("DELETE FROM VentasCompras WHERE(IdUsuario=$idUsuario)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
            catch(Exception $e){
                die("Error al eliminar las una Ventas/Compras: ".$e->getMessage());
            }
        }
    }
?>