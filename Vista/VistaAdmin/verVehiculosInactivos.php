<?php
    include("../Principal/header.php");

    /*if(strcmp($u->getTipoUsuario(),"Administrador")!=0)
            header("Location: ../../Controlador/Validar.php?accion=Salir");*/
?>

<div class="contenido-opcion">
    <!--Botones Superiores (Modal)-->
    <div class="botones">
        <div class="principales">
            <a href="./verVehiculos.php" title="Regresar a Ver Vehículos">
                <i class="btnInactivos fa-solid fa-rotate-left"></i>
            </a>
        </div>

        <div class="regresar">
            <a class="btnRegresar" href="<?php echo $link; ?>" title="Regresar a la Página Principal">
                <i class="btnRegresar fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <div class="separador"></div>
    <!--Tabla de Datos-->
    <div class="tabla">
        <div class="titulo-tabla">
            <h3>Vehículos Inactivos</h3>
        </div>
        
        <div class="table-responsive contenido-tabla">
            <table class="table table-striped table-dark table-hover display nowrap" id="tablaVehiculosInactivos" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Activar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
    include("../Principal/footer.php");
?>