  window.onload = function() {
    var salaId = sessionStorage.getItem('salaIdActual');
    cargarTareas(salaId);
  };

  function cargarTareas(salaId) {
    fetch(`obtener_tareas.php?salaId=${salaId}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('nombreZona').textContent = `${data.infoSala.nombre_casa} - ${data.infoSala.nombre_sala}`;
        var container = document.getElementById('tareasContainer');
        container.innerHTML = '';
        data.tareas.forEach(function(tarea) {
            var tareaDiv = document.createElement('div');
            tareaDiv.className = 'tarea';
            tareaDiv.innerHTML = `
                <h3>${tarea.nombre_tarea}</h3>
                <p>Asignada a: ${tarea.nombre_usuario}</p>
                <p>Estado: ${tarea.realizada ? 'Completada' : 'Pendiente'}</p>
                <button class="completar-tarea" onclick="completarTarea(${tarea.tarea_id})">Completar Tarea</button>
                <button class="eliminar-tarea" onclick="eliminarTarea(${tarea.tarea_id})">Eliminar Tarea</button>
            `;
            container.appendChild(tareaDiv);
        });
    })
    .catch(error => console.error('Error:', error));
}
function eliminarTarea(tareaId) {
  if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
        fetch('eliminar_tarea.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `tarea_id=${tareaId}`,
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Recargar la lista de tareas después de eliminar una tarea
            cargarTareas(salaId);
        })
        .catch(error => console.error('Error:', error));
    }
}

cargarTareas(salaId);

function completarTarea(tareaId) {
  fetch('completar_tarea.php', {
      method: 'POST',
      body: 'tarea_id=' + encodeURIComponent(tareaId),
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      }
  })
  .then(response => response.text())
  .then(data => {
      alert(data);
      location.reload();
  })
  .catch(error => console.error('Error:', error));
}

function editarZona(salaId) {
  sessionStorage.setItem('salaIdAEditar', salaId);
  window.location.href = 'editar_zona.html';
}



