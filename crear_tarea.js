document.addEventListener('DOMContentLoaded', function() {
    cargarUsuariosDeLaCasa();
    document.getElementById('crearTareaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        crearTarea();
    });
});

function cargarUsuariosDeLaCasa() {
    var casaId = sessionStorage.getItem('casaIdActual');
    fetch(`obtener_usuarios_casa.php?casaId=${casaId}`)
    .then(response => response.json())
    .then(usuarios => {
        var selectPersona = document.getElementById('personaTarea');
        usuarios.forEach(usuario => {
            var option = document.createElement('option');
            option.value = usuario.id;
            option.textContent = usuario.nombre;
            selectPersona.appendChild(option);
        });
    })
    .catch(error => console.error('Error:', error));
}
function asignarAleatoriamente() {
    var selectPersona = document.getElementById('personaTarea');
    var usuarioAsignado = document.getElementById('usuarioAsignado');
    var usuarioIdAsignado = document.getElementById('usuarioIdAsignado');

    var numOpciones = selectPersona.options.length;

    if (numOpciones > 0) {
        var indiceAleatorio = Math.floor(Math.random() * numOpciones);
        var usuarioSeleccionado = selectPersona.options[indiceAleatorio];

        usuarioAsignado.textContent = usuarioSeleccionado.text;
        usuarioIdAsignado.value = usuarioSeleccionado.value;
    }
}
function crearTarea() {
    var nombreTarea = document.getElementById('nombreTarea').value;
    var usuarioId = document.getElementById('personaTarea').value;
    var casaId = sessionStorage.getItem('casaIdActual');
    var salaId = sessionStorage.getItem('salaIdActual');
  
    var datosTarea = {
        nombre_tarea: nombreTarea,
        usuario_id: usuarioId,
        casa_id: casaId,
        sala_id: salaId
    };
  
    fetch('crear_tarea.php', {
        method: 'POST',
        body: JSON.stringify(datosTarea),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        window.location.href = 'tus_tareas.html';
    })
    .catch(error => console.error('Error:', error));
}
function cargarOpciones() {
    fetch('opciones_personas.php')
        .then(response => response.json())
        .then(opciones => {
            var selectPersona = document.getElementById("personaTarea");
            selectPersona.innerHTML = "";
            opciones.forEach(opcion => {
                var option = document.createElement("option");
                option.value = opcion.usuario_id;
                option.text = opcion.nombre;
                selectPersona.add(option);
            });
        })
        .catch(error => console.error('Error al cargar opciones:', error));
}

function asignarAleatoriamente() {
    var selectPersona = document.getElementById("personaTarea");
    var numOpciones = selectPersona.options.length;

    if (numOpciones > 0) {
        var indiceAleatorio = Math.floor(Math.random() * numOpciones);
        selectPersona.selectedIndex = indiceAleatorio;
    }
}