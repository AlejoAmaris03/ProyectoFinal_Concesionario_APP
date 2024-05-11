<?php //Vista Principal de los Vendedores
    include("../Principal/header.php");

    if(strcmp($u->getTipoUsuario(),"Vendedor")!=0)
        header("Location: ../../Controlador/Validar.php?accion=Salir");
?>

<div class="contenido-opciones">
    <div class="superior">
        <!-- Botón Usuarios -->
        <div class="opciones">
            <a href="./verVehiculos.php" title="Vender Vehículos">
                <div class="icono">
                    <i class="fa-solid fa-car"></i>
                    <h2>Vender Vehículos</h2>
                </div>

                <div class="footer-boton">
                    <p>Ver Vehículos</p>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </a>
        </div>

        <div class="opciones">
            <a href="./verHistorial.php" title="Ver Historial de Ventas">
                <div class="icono">
                    <i class="fa-solid fa-receipt"></i>
                    <h2>Historial de Ventas</h2>
                </div>

                <div class="footer-boton">
                    <p>Ver Historial</p>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php")
?>