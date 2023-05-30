
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
  
  // Función para mostrar los datos en la consola y actualizar la página
  function displayData(data) {
    console.log('Datos leídos:');
    console.log(data);
    
    const pnombreEspecialista = document.getElementById('primer-nombre');
    pnombreEspecialista.value = data.primer_nombre;

    const snombreEspecialista = document.getElementById('segundo-nombre');
    snombreEspecialista.value = data.segundo_nombre;

    const papellidoEspecialista = document.getElementById('primer-apellido');
    papellidoEspecialista.value = data.primer_apellido;

    const sapellidoEspecialista = document.getElementById('segundo-apellido');
    sapellidoEspecialista.value = data.segundo_apellido;

    const tipoDocumento = document.getElementById('tipo-documento');
    const tipoDocumentoValue = data.tipo_documento;

    for (let i = 0; i < tipoDocumento.options.length; i++) {
    const option = tipoDocumento.options[i];

        if (option.value === tipoDocumentoValue) {
            // Establecemos la opción como seleccionada
            option.selected = true;
            break;
        }
    }

    const nDocumento = document.getElementById('numero-documento');
    nDocumento.value = data.num_documento;

    const cExpedicion = document.getElementById('ciudad-expedicion');
    cExpedicion.value = data.ciudad_expedicion;

    const fNacimiento = document.getElementById('fecha-nacimiento');
    fNacimiento.value = data.fecha_nacimiento;

    const telefono1 = document.getElementById('telefono1');
    telefono1.value = data.telefono1;
    
    const telefono2 = document.getElementById('telefono2');
    telefono2.value = data.telefono2;
}
  
  // Llamada a la función para obtener los datos del servidor
getData('../php/readEspecialista.php')
    .then(data => {
      displayData(data);
});
  