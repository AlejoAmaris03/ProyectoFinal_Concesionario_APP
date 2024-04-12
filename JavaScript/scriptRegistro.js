function limpiar(){
    document.form.reset();
    document.form.nombre.focus();
}
function validar(){
    let form = document.form;
    let correo = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(form.nombre.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El nombre es requerido!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    if(form.apellido.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El apellido es requerido!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }

    if(form.correo.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El correo es requerido!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
    if(!correo.test(form.correo.value)){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El correo no es válido!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }

    if(form.fecha_nacimiento.value.trim() === ""){
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "La fecha de nacimiento es requerida!",
            confirmButtonText: "Aceptar"
        });
        return false;
    }
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