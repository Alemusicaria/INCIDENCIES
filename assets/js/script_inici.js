document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    firstDay: 1,
    locale: 'ca',
    buttonText: { // Aquí és on canviem "today" per "avui"
      today: 'Avui'
    },
    dateClick: function (info) {
      var dateText = info.dateStr; // Obtenim la data clicada
      document.getElementById('date-text').innerText = dateText; // Actualitzem el text
      document.getElementById('selected-date').style.display = 'block'; // Mostrem la secció

      // Remove class from previously selected day
      var previouslySelected = document.querySelector('.selected-day');
      if (previouslySelected) {
        previouslySelected.classList.remove('selected-day');
      }

      // Get the clicked date's element and add the class
      var dayEl = info.dayEl; // Element del dia clicat
      dayEl.classList.add('selected-day'); // Afegim la classe per canviar el color

      // Aquí es fa la sol·licitud per obtenir les incidències d'aquell dia
      fetch('app/views/php/get_incidencies.php?data=' + dateText)
        .then(response => response.json())
        .then(data => {
          const incidenciesContainer = document.getElementById('incidencies-container');
          incidenciesContainer.innerHTML = ''; // Netejar el contenidor anterior

          // Comprovar si hi ha incidències
          if (data.length === 0) {
            incidenciesContainer.innerHTML = '<div>No hi ha incidències per aquest dia.</div>';
          } else {
            // Afegir incidències al contenidor
            data.forEach(incidencia => {
              const div = document.createElement('div');
              div.classList.add('incidencia'); // Afegir una classe per a l'estil

              // Crear un enllaç que redirigeixi a la pàgina de detall de la incidència
              div.innerHTML = `
                          <a href="app/views/mostrar_info.php?id=${incidencia.id}" class="incidencia-link">
                              <strong>${incidencia.titol_fallo}</strong>
                              <br><span><em>Ubicació: ${incidencia.ubicacio}</em></span>
                          </a>`;
              incidenciesContainer.appendChild(div);
            });

          }
        })
        .catch(error => console.error('Error:', error));

    }
  });

  calendar.render();

  // Afegir event listener als botons de canvi de vista
  /*
  var viewButtons = document.querySelectorAll('.view-buttons button');
  viewButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var view = this.getAttribute('data-view');
      calendar.changeView(view);
    });
  });*/
  // Agregar event listener a los labels en btn-group para cambiar la vista del calendario
  var viewLabels = document.querySelectorAll('.btn-group label');
  viewLabels.forEach(function (label) {
    label.addEventListener('click', function () {
      var view = this.getAttribute('data-view');
      calendar.changeView(view);

      // Remover la clase 'active' de todos los labels
      viewLabels.forEach(function (lbl) {
        lbl.classList.remove('active');
      });

      // Añadir la clase 'active' al label seleccionado
      this.classList.add('active');
    });
  });
});