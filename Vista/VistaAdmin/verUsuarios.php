<?php //Vista que muestra todos los usuarios
    include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenido-opcion">
    <!--Botones Superiores (Modal)-->
    <div class="botones">
        <div class="principales">
            <button class="btnAgregar" type="button" onclick="validarUsuario()" title="Agregar Usuarios">
                <i class="btnAgregar fa-solid fa-user-plus"></i>
            </button>

            <a class="btnInactivos" href="./verUsuariosInactivos.php" title="Ver Usuarios Inactivos">
                <i class="btnInactivos fa-solid fa-ban"></i>
            </a>
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la Página Principal">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <!-- Modal Usuarios -->
    <div class="modal fade" id="tablaDatos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="tabla-usuarios modal-title fs-5">Agregar Usuarios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form name="form" id="formUsuarios" method="POST">
                        <div class="campos" id="campo-id">
                            <i class="fa-solid fa-address-card"></i>
                            <input class="form-campos" type="number" name="id" id="id" readonly>
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-user"></i>
                            <input class="form-campos" type="text" name="nombre" id="nombre" placeholder="Digite su Nombre">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-user"></i>
                            <input class="form-campos" type="text" name="apellido" id="apellido" placeholder="Digite su Apellido">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-envelope"></i>
                            <input class="form-campos" type="email" name="correo" id="correo" placeholder="Digite su Correo Electrónico">
                        </div>

                        <abbr title="Seleccione su Fecha de Nacimiento">
                            <div class="campos">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input class="form-campos" type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="Eliga su Fecha de Nacimiento">
                            </div>
                        </abbr>

                        <div class="campos">
                            <i class="fa-solid fa-user"></i>
                            <input class="form-campos" type="text" name="usuario" id="usuario" placeholder="Digite su Nombre de Usuario">
                        </div>

                        <div class="campos">
                            <i class="fa-solid fa-lock"></i>
                            <input class="form-campos" type="password" name="clave" id="clave" placeholder="Digite su Contraseña">
                        </div>

                        <div class="campos select">
                            <i>Tipo de Usuario</i>

                            <select name="tipoUsuario" id="tipoUsuario">
                                <option value="2">Cliente</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>

                        <input type="hidden" name="accion" id="accion">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnPrincipal" class="btn btn-primary" onclick="btnAgregarUsuarios()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Usuarios Registrados</h3>
        </div>
        
        <div class="table-responsive contenido-tabla">
            <table class="table table-striped table-dark table-hover display nowrap" id="tablaUsuarios" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Tipo de Usuario</th>
                        <th>Nombre de Usuario</th>
                        <th>Clave</th>
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