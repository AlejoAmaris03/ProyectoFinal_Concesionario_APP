<?php //Vista que muestra los vehiculos 
include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenido-opcion">
    <!--Botones Superiores (Modal)-->
    <div class="botones">
        <div class="principales">
            <button class="btnAgregar" type="button" onclick="verificarVehiculo()" title="Agregar Vehículos">
                <i class="btnAgregar fa-solid fa-plus"></i>
            </button>

            <a class="btnInactivos" href="./verVehiculosInactivos.php" title="Ver Vehículos Inactivos">
                <i class="btnInactivos fa-solid fa-ban"></i>
            </a>

            <div class="drop-down btn-group dropend">
                <button type="button" class="btnVerMas dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Ver Más">
                    <i class="fa-solid fa-car"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="../VistaAdmin/verMarcas.php">Ver Marcas de Vehículos</a></li>
                    <li><a class="dropdown-item" href="../VistaAdmin/verTipos.php">Ver Tipos de Vehículos</a></li>
                    <li><a class="dropdown-item" href="../VistaAdmin/verColores.php">Ver Colores de Vehículos</a></li>
                </ul>
            </div>
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la Página Principal">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tablaDatos" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="tabla-usuarios modal-title fs-5">Agregar Vehículos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php
                    $marcaV = $_SESSION["marcaV"];
                    $tipoV = $_SESSION["tipoV"];
                ?>
                <div class="modal-body">
                    <form name="form" id="formVehiculos" method="POST" enctype="multipart/form-data">
                        <div class="campos" id="campo-id">
                            <i class="fa-solid fa-car-rear"></i>
                            <input class="form-campos" type="number" name="id" id="id" readonly>
                        </div>

                        <div class="campos" title="Seleccione la imágen del Vehículo">
                            <i class="img fa-solid fa-image"></i>
                            <input class="form-campos" type="file" name="imagen" id="imagen" placeholder="Ingrese la Imagen del Vehículo">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-car"></i>
                            <input class="form-campos" type="text" name="placa" id="placa" placeholder="Digite la Placa">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-car"></i>
                            <input class="form-campos" type="text" name="modelo" id="modelo" placeholder="Digite El Modelo">
                        </div>

                        <div class="campos select">
                            <i>Marca</i>

                            <select name="marca" id="marca">
                                <?php 
                                    for ($i=0; $i<count($marcaV); $i++) { ?>
                                        <option value="<?=$marcaV[$i]["ID"]?>"><?=$marcaV[$i]["Nombre"]?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="campos select">
                            <i>Tipo de Vehículo</i>

                            <select name="tipo" id="tipo">
                                <?php 
                                    for ($i=0; $i<count($tipoV); $i++) { ?>
                                        <option value="<?=$tipoV[$i]["ID"]?>"><?=$tipoV[$i]["Nombre"]?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="campos descripcion">
                            <i>Descripción</i>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-hashtag"></i>
                            <input class="form-campos" type="number" name="cantidad" id="cantidad" min="1" placeholder="Ingrese la cantidad de Vehículos Disponibles">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <input class="form-campos" type="number" name="precio" id="precio" placeholder="Ingrese el Valor del Vehiculo">
                        </div>

                        <input type="hidden" name="accion" id="accion">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnPrincipal" class="btn btn-primary" onclick="btnAgregarVehiculo()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Vehículos Registrados</h3>
        </div>

        <div class="table-responsive contenido-tabla">
            <table class="table table-dark table-hover table-striped display nowrap" id="tablaVehiculos" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Inactivar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>