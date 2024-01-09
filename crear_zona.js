function seleccionarTipoZona(selectElement) {
    var tipoZona = selectElement.value;
    sessionStorage.setItem('tipoZonaSeleccionada', tipoZona);
}

function crearZona() {
    var nombreZona = document.getElementById('nombreZona').value;
    var tipoZona = sessionStorage.getItem('tipoZonaSeleccionada');
    var casaId = sessionStorage.getItem('casaIdActual');


    if (!nombreZona || !tipoZona) {
        alert('Por favor, ingresa el nombre y tipo de la zona.');
        return;
    }

    var formData = new FormData();
    formData.append('nombre_sala', nombreZona);
    formData.append('tipoZona', tipoZona);
    formData.append('casa_id', casaId);

    fetch('crear_zona.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 
        window.location.href = 'tus_zonas.html'; 
    })
    .catch(error => console.error('Error:', error));
}
