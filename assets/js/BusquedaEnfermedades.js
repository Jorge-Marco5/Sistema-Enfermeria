// Arreglos de opciones 
  let enfermedades = [], alergias = [], medicamentos = [], cirugias = [], discapacidad = [];

  // Función genérica para cargar datos desde PHP y aplicar Tagify
  function cargarTagify(inputId, archivoPHP, listaArray) {
    fetch(archivoPHP)
      .then(res => res.text())
      .then(data => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(`<datalist>${data}</datalist>`, 'text/html');
        listaArray.push(...Array.from(doc.querySelectorAll('option')).map(opt => opt.value));

        // Inicializar Tagify con salida de texto plano
        new Tagify(document.getElementById(inputId), {
          whitelist: listaArray,
          originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(", "),
          dropdown: {
            maxItems: 10,
            enabled: 0,
            closeOnSelect: false
          }
        });
      });
  }

  // Llamadas para cada input
  cargarTagify("enfermedades", "../Controllers/enfermedades.php", enfermedades);
  cargarTagify("alergias", "../Controllers/alergias.php", alergias);
  cargarTagify("medicamentos", "../Controllers/medicamentos.php", medicamentos);
  cargarTagify("cirugias", "../Controllers/cirugias.php", cirugias);
  cargarTagify("discapacidad", "../Controllers/discapacidad.php", discapacidad);
