document.getElementById('editarZona').addEventListener('click', function() {
    var salaId = sessionStorage.getItem('salaIdAEditar');
    var nuevoNombreSala = document.getElementById('nuevoNombreSala').value;

    var datos = { salaId: salaId };
    if (nuevoNombreSala) {
        datos.nuevoNombreSala = nuevoNombreSala;
    }

    fetch('editar_zona.php', {
        method: 'POST',
        body: JSON.stringify(datos),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.mensaje);
        window.location.href = 'tus_zonas.html';
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('eliminarZona').addEventListener('click', function() {
    var salaId = sessionStorage.getItem('salaIdAEditar');
    if (confirm('¿Estás seguro de que desea eliminar la zona?')) {
        fetch('eliminar_zona.php', {
            method: 'POST',
            body: JSON.stringify({ salaId: salaId }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.mensaje);
            window.location.href = 'tus_zonas.html'; // Redirigir después de eliminar
        })
        .catch(error => console.error('Error:', error));
    }
});
