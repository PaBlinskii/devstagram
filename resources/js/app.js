import Dropzone from "dropzone";

// Por default va a buscar un elemento clase dropzone pero nosotros queremos darle el comportamiento
//  y decirle a que endpoint y a que ruta darle las peticiones e imagenes
Dropzone.autoDiscover = false;

// const { Dropzone } = require("dropzone");

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
    });
// });
// }
dropzone.on('sending', function(file, xhr, formData) {
    console.log(xhr);
});

dropzone.on('success', function(file, response) {
    console.log(response);
});

dropzone.on('error', function(file, message) {
    console.log(message);
});


dropzone.on('removeFile', function() {
    console.log("Archivo Eliminado");
});