//eliminar registros
function eliminar(id, ruta) {
    swal({
        title: "Estas seguro de eliminar este registro?",
        text: "Una vez lo hagas no podras recuperarlo",
        icon: "warning",
        buttons: [
            'No',
            'Si'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/' + ruta + '/' + id,
                dataType: 'json',
                success: function (data) {
                    swal({
                        title: data["success"],
                        text: "Operacion realizada Correctamente",
                        icon: "success",
                        buttons: false
                    });
                    setTimeout(function () { window.location.reload() }, 300);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    })

}


//solo numeros
function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}

function validarImagen(obj) {
    var uploadFile = obj.files[0];
    mostrarFoto.src = "";
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|jpeg|png|gif)$/i).test(uploadFile.name)) {
        swal({
            title: "Error al intentar cargar la imagen",
            text: "El archivo seleccionado no corresponde a un formato imagen (solo se aceptan jpg, jpeg, gid, png)",
            icon: "error",
        });
        mostrarFoto.src = "";
        foto.value = "";

    } else {
        mostrarFoto.src = "";
        mostrarFoto.src = URL.createObjectURL(uploadFile);

    }
}

//Esta funcionalidad la estoy usando en clientes para las imagenes del frente y dorso
function validarImagen2(obj) {
    var uploadFile = obj.files[0];
    mostrarFoto2.src = "";
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|jpeg|png|gif)$/i).test(uploadFile.name)) {
        swal({
            title: "Error al intentar cargar la imagen",
            text: "El archivo seleccionado no corresponde a un formato imagen (solo se aceptan jpg, jpeg, gid, png)",
            icon: "error",
        });
        mostrarFoto2.src = "";
        foto.value = "";

    } else {
        mostrarFoto2.src = "";
        mostrarFoto2.src = URL.createObjectURL(uploadFile);

    }
}


function Validar(idcampo, campoError, validador, tabladb) {
    var campo1 = $(idcampo);
    var parametros = {
        campo: campo1.val(),
        validar: validador,
        tabla: tabladb
    };
    $.ajax({
        data: parametros,
        url: 'funcionalidades.php',
        type: 'POST',
        beforeSend: function () {
            console.log("Procesando, espere por favor...");
        },

        success: function (response) {
            $(campoError).html(response);
            if (response != '') {
                //si existe vacia el campo y poner placeholder

                campo1.attr("placeholder", "Ingrese otro diferente");
                campo1.val("");
            }
        }
    });

}

//datatable y select 2
$(document).ready(function () {
    $('.select2').select2();

    $('#dataTable').DataTable();
    $('#dtPrestamo').DataTable({
        "order": [[0, "desc"]]
    });


});
