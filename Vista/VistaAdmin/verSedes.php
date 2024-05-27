<?php //Vista que muestra los tipos de vehículos
    include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");

        $v = $_SESSION["v"];
?>

<div class="contenido-opcion">
    <!--Botones Superiores (Modal)-->
    <div class="botones">
        <div class="principales">
            <button class="btnAgregar" type="button" onclick="validarSede()" title="Agregar Sedes">
                <i class="btnAgregar fa-solid fa-plus"></i>
            </button>
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la página principal">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tablaDatos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="tabla-usuarios modal-title fs-5">Agregar Sedes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="modal-body">
                        <form name="form" id="formSedes" method="POST">
                            <div class="campos" id="campo-id">
                                <i class="fa-solid fa-address-card"></i>
                                <input class="form-campos" type="number" name="id" id="id" readonly>
                            </div>

                            <div class="campos">
                                <i class="fa-solid fa-building"></i>
                                <input class="form-campos" type="text" name="nombre" id="nombre" placeholder="Digite el Nombre de la Sede">
                            </div>

                            <div class="campos">
                                <i class="fa-solid fa-location-dot"></i>
                                <input class="form-campos" type="text" name="direccion" id="direccion" placeholder="Digite la Dirección de la Sede">
                            </div>

                            <div class="sede">
                                <i>Vehículos que posee la Sede</i>
                                
                                <?php for ($i=0; $i<count($v); $i++){ ?>
                                    <div class="contenidoSede">
                                        <div class="sedes">
                                            <input type="checkbox" id="idVehiculo" value="<?=$v[$i]["ID"]?>">
                                            <label id="nombreV"><?=$v[$i]["Marca"]?></label>
                                            - <label id="marcaV"><?=$v[$i]["Modelo"]?></label>
                                        </div>

                                        <div class="cantidad" title="Digite la Cantidad de Vehículos">
                                            <input type="number" name="cantidadV" id="cantidadV" min=1 placeholder="Digite la Cantidad">
                                        </div>
                                    </div>
                                <?php 
                                    } ?>
                            </div>

                            <input type="hidden" name="accion" id="accion">
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnPrincipal" class="btn btn-primary" onclick="btnAgregarSede()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Sedes Registradas</h3>
        </div>

        <div class="table-responsive contenido-tabla">
            <table class="table table-dark table-hover table-striped display nowrap" id="tablaSedes" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Editar</th>
                        <!--<th>Eliminar</th>-->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>