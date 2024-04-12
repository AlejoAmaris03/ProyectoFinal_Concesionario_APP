function limpiar(){
    document.form.reset();
    document.form.usuario.focus();
}
function validar(){
    let form = document.form;

    if(form.usuario.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El nombre de usuario es requerido!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    if(form.clave.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "La contraseña es requerida!", 
            confirmButtonText: "Aceptar"
        });
        return false;
    }

    form.submit();
}