window.onload = function() {
  var casaId = sessionStorage.getItem('casaIdActual');
  cargarZonas(casaId);
};

function cargarZonas(casaId) {
  fetch(`obtener_zonas.php?casaId=${casaId}`)
  .then(response => response.json())
  .then(data => {
      // Actualiza el nombre de la casa en el header
      document.getElementById('nombreCasa').textContent = data.nombreCasa;
      var container = document.getElementById('zonasContainer');
      container.innerHTML = '';
      data.zonas.forEach(function(zona) {
          var zonaDiv = document.createElement('div');
          zonaDiv.className = 'zona';
          zonaDiv.innerHTML = `
              <div class="image-container">
                  <img src="imagenes/${zona.tipoZona}.png" alt="Imagen de la zona" />
              </div>
              <p>${zona.nombre_sala}</p>
          `;
          zonaDiv.onclick = function() {
              abrirTareas(zona.sala_id);
          };
          container.appendChild(zonaDiv);
      });
  })
  .catch(error => console.error('Error:', error));
}


function abrirTareas(salaId) {
  sessionStorage.setItem('salaIdActual', salaId);
  window.location.href = 'tus_tareas.html';
}

function editarCasa(casaId) {
  sessionStorage.setItem('casaIdAEditar', casaId);
  window.location.href = 'editar_casa.html';
}
