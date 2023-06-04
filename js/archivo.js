document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.fecha');
    const url = '../../php/archivo.php';
    let data = []; // Variable para almacenar los datos
  
    // Obtener los datos del paciente actual al cargar la página
    getData(url)
      .then(resultData => {
        data = resultData; // Almacenar los datos en la variable
        displayData(data); // Mostrar los datos en la tabla
      });
  
    const abrirBoton = document.getElementById('abrirBtn');
    abrirBoton.addEventListener('click', function() {
      const checkboxSeleccionado = document.querySelector('.table__body input[type="checkbox"]:checked');
      if (checkboxSeleccionado) {
        const pacienteSeleccionado = data.find(paciente => paciente.tiene_ECG === 'Sí');
        if (pacienteSeleccionado) {
          window.location.href = 'documento.html';
        } else {
          alert('No hay pacientes con ECG disponible');
        }
      } else {
        alert('Debes seleccionar un paciente');
      }
    });
  });
  
  function getData(url) {
    return fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Error en la solicitud: ' + response.status);
        }
        return response.json();
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
  
  function displayData(data) {
    const tableBody = document.querySelector('.table__body tbody');
    tableBody.innerHTML = '';
  
    if (data.length === 0) {
      console.log('No hay datos disponibles');
      alert('No hay datos disponibles');
      return;
    }
  
    data.forEach(paciente => {
      if (paciente.tiene_ECG === 'Sí') {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td><input type="checkbox"></td>
          <td>${paciente.primer_nombre}</td>
          <td>${paciente.primer_apellido}</td>
          <td>${paciente.num_documento}</td>
          <td>${paciente.fecha_consulta}</td>
        `;
        tableBody.appendChild(row);
      }
    });
  }
  