document.getElementById('editarCasa').addEventListener('click', function() {
    var casaId = sessionStorage.getItem('casaIdAEditar');
    var nuevoNombreCasa = document.getElementById('nuevoNombreCasa').value;
    var correoUsuario = document.getElementById('correoUsuario').value;

    var datos = { casaId: casaId };
    if (nuevoNombreCasa) {
        datos.nuevoNombreCasa = nuevoNombreCasa;
    }
    if (correoUsuario) {
        datos.correoUsuario = correoUsuario;
    }

    fetch('editar_casa.php', {
        method: 'POST',
        body: JSON.stringify(datos),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.mensaje);
        window.location.href = 'tus_casas.html';
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('eliminarCasa').addEventListener('click', function() {
    var casaId = sessionStorage.getItem('casaIdActual');
    if (confirm('¿Estás seguro de que desea eliminar la casa?')) {
        fetch('eliminar_casa.php', {
            method: 'POST',
            body: JSON.stringify({ casaId: casaId }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.mensaje);
            window.location.href = 'tus_casas.html'; // Redirigir después de eliminar
        })
        .catch(error => console.error('Error:', error));
    }
});
