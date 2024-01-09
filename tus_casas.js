function cargarCasas() {
  fetch('obtener_casas.php')
  .then(response => response.json())
  .then(casas => {
      var container = document.querySelector('.casas-container');
      container.innerHTML = '';

      casas.forEach(function(casa) {
          var casaDiv = document.createElement('div');
          casaDiv.className = 'house';
          casaDiv.innerHTML = `
              <div class="image-container">
                  <img src="imagenes/casa.png" alt="Imagen de la casa" />
              </div>
              <p>${casa.nombre_casa}</p>
          `;

          casaDiv.onclick = function() {
              abrirZonas(casa.casa_id);
          };
          container.appendChild(casaDiv);
      });
  })
  .catch(error => console.error('Error:', error));
}

window.onload = cargarCasas;

function abrirZonas(casaId) {
  sessionStorage.setItem('casaIdActual', casaId);
  window.location.href = 'tus_zonas.html';
}







  