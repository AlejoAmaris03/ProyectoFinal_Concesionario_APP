<?php //Vista que muestra los tipos de vehículos
include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenido-opcion">
    <!--Botones Superiores (Modal)-->
    <div class="botones">
        <div class="principales">
            <button class="btnAgregar" type="button" onclick="validarTipo()" title="Agregar Tipos">
                <i class="btnAgregar fa-solid fa-plus"></i>
            </button>

            <div class="drop-down btn-group dropend">
                <button type="button" class="btnVerMas dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Ver Más">
                    <i class="fa-solid fa-car"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="../VistaAdmin/verMarcas.php">Ver Marcas de Vehículos</a></li>
                    <li><a class="dropdown-item" href="../VistaAdmin/verTipos.php">Ver Tipos de Vehículos</a></li>
                    <li><a class="dropdown-item" href="../VistaAdmin/verEquipamiento.php">Ver Equipamiento de los Vehículos</a></li>
                </ul>
            </div>
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="./verVehiculos.php" title="Regresar a Ver Vehículos">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tablaDatos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="tabla-usuarios modal-title fs-5">Agregar Tipos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="modal-body">
                        <form name="form" id="formMarcas" method="POST">
                            <div class="campos" id="campo-id">
                                <i class="fa-solid fa-address-card"></i>
                                <input class="form-campos" type="number" name="id" id="id" readonly>
                            </div>

                            <div class="campos">
                                <i class="fa-solid fa-car"></i>
                                <input class="form-campos" type="text" name="nombre" id="nombre" placeholder="Digite el Tipo de Vehículo">
                            </div>

                            <input type="hidden" name="accion" id="accion">
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnPrincipal" class="btn btn-primary" onclick="btnAgregarTipo()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Tipos de Vehículos Registrados</h3>
        </div>

        <div class="table-responsive contenido-tabla">
            <table class="table table-dark table-hover table-striped display nowrap" id="tablaTipos" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>