<?php
    include("../Config/Conexion.php");

    class VehiculoDAO{
        public function listarVehiculosParaMostrar(){
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) JOIN SedesVehiculo SV ON (V.ID=SV.IdVehiculo) WHERE(EV.Nombre='Activo' AND SV.Cantidad>0) GROUP BY V.ID");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Vehículos para mostrar: ".$e->getMessage());
            }
        }
        public function listarVehiculos(){ //Lista los vehículos activos
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(EV.Nombre='Activo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Vehículos: ".$e->getMessage());
            }
        } 
        public function listarVehiculosInactivos(){ //Lista los vehículos inactivos
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(EV.Nombre='Inactivo')");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Listar los Vehículos Inactivos: ".$e->getMessage());
            }
        } 
        public function agregarVehiculo($v){ //Agrega los vehículos
            $conexion = Conexion::conectar();

            try{
                $imagen = $v->getImagen();
                $modelo = $v->getModelo();
                $marca = $v->getMarca();
                $tipo = $v->getTipo();
                $descripcion = $v->getDescripcion();
                $precio = $v->getPrecio();
                $estado = 1;

                $sql = $conexion->prepare("INSERT INTO Vehiculos(Imagen,Modelo,Marca,Tipo,Descripcion,Precio,Estado) VALUES (?,?,?,?,?,?,?)");
                $sql->bindParam(1,$imagen,PDO::PARAM_LOB);
                $sql->bindParam(2,$modelo,PDO::PARAM_STR);
                $sql->bindParam(3,$marca,PDO::PARAM_INT);
                $sql->bindParam(4,$tipo,PDO::PARAM_INT);
                $sql->bindParam(5,$descripcion,PDO::PARAM_STR);
                $sql->bindParam(6,$precio,PDO::PARAM_INT);
                $sql->bindParam(7,$estado,PDO::PARAM_INT);
                $sql->execute();

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al agregar el Vehículo: ".$e->getMessage());
            }
        }
        public function buscarVehiculoPorId($id){ //Busca un vehículo determinado por su ID
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Modelo,MV.ID AS IdMarca,MV.Nombre AS Marca,TV.ID AS IdTipo,TV.Nombre AS Tipo,V.Descripcion,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(V.ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un Vehículo: ".$e->getMessage());
            }
        }
        public function verificarModeloVehiculo($modelo){ //Busca un vehículo determinado por su Modelo
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
        public function verificarModeloVehiculoActual($id,$modelo){  //Busca un vehículo determinado por su Modelo excluyendo el Modelo del vehículo a editar
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
        public function listarVehiculosPorFila($fila){ //Lista un vehículo en una fila específica
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("SELECT V.ID,V.Imagen,V.Modelo,MV.Nombre AS Marca,TV.Nombre AS Tipo,V.Descripcion,V.Precio,EV.Nombre AS Estado FROM Vehiculos V JOIN MarcasVehiculos MV ON (V.Marca = MV.ID) JOIN TiposVehiculos TV ON (V.Tipo = TV.ID) JOIN EstadosVehiculos EV ON (V.Estado = EV.ID) WHERE(EV.Nombre='Activo') LIMIT 1 OFFSET $fila");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al Buscar un vehículo: ".$e->getMessage());
            }
        }
        public function modificarVehiculos($v){ //Edita la información de un vehículo
            $conexion = Conexion::conectar();

            try{
                $id = $v->getId();
                $imagen = $v->getImagen();
                $modelo = $v->getModelo();
                $marca = $v->getMarca();
                $tipo = $v->getTipo();
                $descripcion = $v->getDescripcion();
                $precio = $v->getPrecio();
                $estado = 1;

                if($imagen != NULL){ //Si la imagen fue modificada
                    $sql = $conexion->prepare("UPDATE Vehiculos SET Imagen=?,Modelo=?,Marca=?,Tipo=?,Descripcion=?,Precio=?,Estado=? WHERE(ID=?)");
                    $sql->bindParam(1,$imagen,PDO::PARAM_LOB);
                    $sql->bindParam(2,$modelo,PDO::PARAM_STR);
                    $sql->bindParam(3,$marca,PDO::PARAM_INT);
                    $sql->bindParam(4,$tipo,PDO::PARAM_INT);
                    $sql->bindParam(5,$descripcion,PDO::PARAM_STR);
                    $sql->bindParam(6,$precio,PDO::PARAM_INT);
                    $sql->bindParam(7,$estado,PDO::PARAM_INT);
                    $sql->bindParam(8,$id,PDO::PARAM_INT);
                    $sql->execute();
                }
                else{ //Si no
                    $sql = $conexion->prepare("UPDATE Vehiculos SET Modelo=?,Marca=?,Tipo=?,Descripcion=?,Precio=?,Estado=? WHERE(ID=?)");
                    $sql->bindParam(1,$modelo,PDO::PARAM_STR);
                    $sql->bindParam(2,$marca,PDO::PARAM_INT);
                    $sql->bindParam(3,$tipo,PDO::PARAM_INT);
                    $sql->bindParam(4,$descripcion,PDO::PARAM_STR);
                    $sql->bindParam(5,$precio,PDO::PARAM_INT);
                    $sql->bindParam(6,$estado,PDO::PARAM_INT);
                    $sql->bindParam(7,$id,PDO::PARAM_INT);
                    $sql->execute();
                }

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al editar el Vehículo: ".$e->getMessage());
            }
        }
        public function modificarEstadoVehiculo($id,$estado){ //Modifica el estado de un vehículo
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("UPDATE Vehiculos SET Estado='$estado' WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al modficar el estado de un vehículo: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
        public function eliminarVehiculo($id){ //Elimina a un vehículo
            $conexion = Conexion::conectar();

            try{
                $sql = $conexion->query("DELETE FROM Vehiculos WHERE(ID=$id)");

                $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            } 
            catch(Exception $e){
                die("Error al eliminar un vehículo: ".$e->getMessage());
            }
            
            $conexion = NULL;
        }
    }
?>