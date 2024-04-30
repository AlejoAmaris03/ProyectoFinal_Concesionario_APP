<?php //Vista para editar la información del usuario que tiene iniciada la sesión
    include("./header.php");   
?>

<div class="editar">
    <div class="botones">
        <div class="principales">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la página principal">
                <i class="btnInactivos fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>

    <hr class="separador">

    <div class="contenedor-editar">
        <div class="ver-info">
            <div class="logo">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="info">
                <form name="ver-info" id="ver-info">
                    <div class="datos">
                        <label class="nombreUsuario" type="text"><?=$u->getNombre()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-user"></i><b>Nombre:</b> 
                        <label type="text"><?=$u->getNombre()." ".$u->getApellido()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-envelope"></i><b>Correo:</b>
                        <label type="text"><?=$u->getCorreo()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-user"></i><b>Nombre de Usuario:</b> 
                        <label type="text"><?=$u->getUsuario()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-calendar-days"></i><b>Fecha de Nacimiento:</b> 
                        <label type="text"><?=$u->getFechaNacimiento()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-user"></i><b>Tipo de Usuario:</b> 
                        <label type="text"><?=$u->getTipoUsuario()?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-user"></i><b>Estado:</b> 
                        <label type="text"><?=$u->getEstado()?></label>
                    </div>
                </form>

                <div class="btn-editar">
                    <button type="button" onclick="btnMostarBotonEditar()">Editar</button>
                </div>
            </div>
        </div>

        <div class="edicion">
            <h3>Datos Personales</h3>

            <form name="form" id="edicion" method="POST">
                <input type="hidden" id="id" value="<?=$u->getID()?>">
                <input type="hidden" id="tipoUsuario" value="<?=$u->getTipoUsuario()?>">
                <input type="hidden" id="estado" value="<?=$u->getEstado()?>">

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="nombre" id="nombre" value="<?=$u->getNombre()?>" placeholder="Digite su Nombre">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="apellido" id="apellido" value="<?=$u->getApellido()?>" placeholder="Digite su Apellido">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-envelope"></i>
                    <input class="form-campos" type="email" name="correo" id="correo" value="<?=$u->getCorreo()?>" placeholder="Digite su Correo Electrónico">
                </div>

                <abbr title="Seleccione su Fecha de Nacimiento">
                    <div class="campos">
                        <i class="fa-solid fa-calendar-days"></i>
                        <input class="form-campos" type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?=$u->getFechaNacimiento()?>" placeholder="Eliga su Fecha de Nacimiento">
                    </div>
                </abbr>

                <div class="campos">
                    <i class="fa-solid fa-user"></i>
                    <input class="form-campos" type="text" name="usuario" id="usuario" value="<?=$u->getUsuario()?>" placeholder="Digite su Nombre de Usuario">
                </div>

                <div class="campos">
                    <i class="fa-solid fa-lock"></i>
                    <input class="form-campos" type="password" name="clave" id="clave" value="<?=$u->getClave()?>" placeholder="Digite su Contraseña">
                </div>
            </form>

            <div class="btn-editar">
                <button id="btnEditarUsuarioActual" type="button" onclick="btnEditarUsuarioActual()">Modificar Información</button>
            </div>
        </div>
    </div>
</div>

<?php
    include("./footer.php");
?>