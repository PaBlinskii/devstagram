import Dropzone from "dropzone";
// Por default va a buscar un elemento clase dropzone pero nosotros queremos darle el comportamiento
//  y decirle a que endpoint y a que ruta darle las peticiones e imagenes
Dropzone.autoDiscover = false;
// windows.addEventListener('DOMContentLoaded', () => {
// if(document.getElementById("dropzone"))
// {
const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,

        // Se va ejecutar cada se inicie dropzone
        init:function() {
            if(document.querySelector('[name="imagen"]').value.trim()){
                const imagenPublicada = {}
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.querySelector('[name="imagen"]').value

                this.options.addedfile.call( this, imagenPublicada); // cuando se inicie la funcion llama a la imagen, se puede usar bind pero hay que llamar a la funcion
                this.options.thumbnail.call( this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

                imagenPublicada.previewElemente.classList.add('dz-success', 'dz-complete')
            }
        },

    });
// });
// }

dropzone.on('success', function(file, response) {
    // console.log(response.imagen);
    // Agregando el UUID de la imagen al value del input hidden
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removeFile', function() {
    console.log("Archivo Eliminado");
});

dropzone.on('removedfile', function() { // Si se borra el archivo le quita el value en el input hidden
    document.querySelector('[name="imagen"]').value = "";
});

// dropzone.on('sending', function(file, xhr, formData) {
//     console.log(formData);
// });

// dropzone.on('error', function(file, message) {
//     console.log(message);
// });
