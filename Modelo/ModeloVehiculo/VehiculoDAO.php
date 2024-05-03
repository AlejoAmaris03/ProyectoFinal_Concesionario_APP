<?php
    include("../Config/Conexion.php");

    class VehiculoDAO{
        public function listarVehiculos(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Placa,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Cantidad,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(EV.Nombre='Activo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Vehículos: ".$e->getMessage());
            }
        } 
        public function agregarVehiculo($v){
            $conexion = Conexion::conectar();

            try{
                $imagen = $v->getImagen();
                $placa = $v->getPlaca();
                $modelo = $v->getModelo();
                $marca = $v->getMarca();
                $tipo = $v->getTipo();
                $descripcion = $v->getDescripcion();
                $cantidad = $v->getCantidad();
                $precio = $v->getPrecio();
                $estado = 1;

                $sql = $conexion->prepare("INSERT INTO Vehiculos(Imagen,Placa,Modelo,Marca,Tipo,Descripcion,Cantidad,Precio,Estado) VALUES (?,?,?,?,?,?,?,?,?)");
                $sql->bindParam(1,$imagen,PDO::PARAM_LOB);
                $sql->bindParam(2,$placa,PDO::PARAM_STR);
                $sql->bindParam(3,$modelo,PDO::PARAM_STR);
                $sql->bindParam(4,$marca,PDO::PARAM_INT);
                $sql->bindParam(5,$tipo,PDO::PARAM_INT);
                $sql->bindParam(6,$descripcion,PDO::PARAM_STR);
                $sql->bindParam(7,$cantidad,PDO::PARAM_INT);
                $sql->bindParam(8,$precio,PDO::PARAM_INT);
                $sql->bindParam(9,$estado,PDO::PARAM_INT);
                $sql->execute();

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al agregar el Vehículo: ".$e->getMessage());
            }
        }
        public function verificarPlacaVehiculo($placa){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Vehiculos WHERE(Placa='$placa')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
        public function verificarPlacaVehiculoActual($id,$placa){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Vehiculos WHERE(ID!=$id AND Placa='$placa')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
        public function verificarModeloVehiculo($modelo){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Vehiculos WHERE(Modelo='$modelo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
        public function verificarModeloVehiculoActual($id,$modelo){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT * FROM Vehiculos WHERE(ID!=$id AND Modelo='$modelo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
        public function listarVehiculosPorFila($fila){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Placa,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Cantidad,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(EV.Nombre='Activo') LIMIT 1 OFFSET $fila");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
    }
?>