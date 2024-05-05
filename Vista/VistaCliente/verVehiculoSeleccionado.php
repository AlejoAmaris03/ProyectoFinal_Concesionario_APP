<?php //Vista para ver y comprar el vehículo seleccionado por el cliente
    include("../Principal/header.php");   

    $v = $_SESSION["vSeleccionado"];
?>

<div class="editar">
    <div class="botones">
        <div class="principales">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la página principal">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>

    <hr class="separador">

    <h3 class="titulo">Adquirir Vehículo</h3>

    <div class="contenedor-editar">
        <div class="ver-info">
            <div class="logo">
                <img src="data:image/jpeg;base64,<?=$v[0]["Imagen"]?>" width="100%" height="100%" alt="Vehículo Seleccionado">
            </div>

            <div class="info">
                <form name="ver-info" id="ver-info">
                    <div class="datos">
                        <label class="MarcaModelo" type="text"><?=$v[0]["Marca"]?> <?=$v[0]["Modelo"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-car"></i><b>Tipo de Vehículo:</b>
                        <label type="text"><?=$v[0]["Tipo"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-comment"></i><b>Descripción:</b> 
                        <label type="text"><?=$v[0]["Descripcion"]?></label>
                    </div>

                    <div class="datos">
                        <i class="fa-solid fa-money-bill"></i><b>Precio:</b> 
                        <label type="text">$<?=$v[0]["Precio"]?></label>
                    </div>
                </form>

                <div class="btn-editar">
                    <button type="button" onclick="btnMostarBotonComprar()">Adquirir</button>
                </div>
            </div>
        </div>

        <div class="edicion">
            <h3>Equipamento Extra</h3>

            <form name="form" id="edicion" method="POST">
                <!--<input type="hidden" id="id" value="<?=$u->getID()?>">
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
                </div>-->
            </form>

            <div class="btn-editar">
                <button id="btnConfirmarCompra" type="button" onclick="btnConfirmarCompra()">Comprar Vehículo</button>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmar Compra -->
    <div class="modal fade" id="confirmarCompra" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalles de la Compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <buton type="button" class="btn btn-primary" onclick="btnRealizarCompra()">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>