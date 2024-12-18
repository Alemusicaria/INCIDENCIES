document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    firstDay: 1,
    locale: 'ca',
    buttonText: {
      today: 'Avui'
    },
    events: function (fetchInfo, successCallback, failureCallback) {
      // Obtenir les incidències d'un endpoint PHP
      fetch('app/views/php/get_incidencies.php')
        .then(response => response.json())
        .then(data => {
          // Transformar les incidències en esdeveniments del calendari
          const events = data.map(incidencia => ({
            id: incidencia.id,
            title: incidencia.titol_fallo,
            start: incidencia.data,
            extendedProps: {
              count: incidencia.count // Número d'incidències per aquell dia
            }
          }));
          successCallback(events);
        })
        .catch(error => {
          console.error('Error carregant incidències:', error);
          failureCallback(error);
        });
    },
    dayCellDidMount: function (info) {
      // Comprovar si el dia té esdeveniments (incidències)
      const eventsForDay = calendar.getEvents().filter(event =>
        FullCalendar.formatDate(event.start, { year: 'numeric', month: '2-digit', day: '2-digit' }) ===
        FullCalendar.formatDate(info.date, { year: 'numeric', month: '2-digit', day: '2-digit' })
      );

      if (eventsForDay.length > 0) {
        let indicator;
        if (eventsForDay.length <= 2) {
          // Mostra un punt per cada incidència
          indicator = '<span style="color: red;">' + '• '.repeat(eventsForDay.length) + '</span>';
        } else {
          // Mostra un punt amb un comptador
          indicator = `<span style="color: red;">•</span><span style="font-size: 12px;">(${eventsForDay.length})</span>`;
        }

        // Afegir l'indicador al dia
        info.el.innerHTML += `<div style="text-align: center;">${indicator}</div>`;
      }
      
      // Seleccionar automàticament el dia d'avui
      const today = new Date();
      const todayStr = FullCalendar.formatDate(today, { year: 'numeric', month: '2-digit', day: '2-digit' });
      const cellDateStr = FullCalendar.formatDate(info.date, { year: 'numeric', month: '2-digit', day: '2-digit' });

      if (cellDateStr === todayStr) {
        info.el.classList.add('selected-day');
        document.getElementById('date-text').innerText = todayStr;
        const selectedDateElement = document.getElementById('selected-date');
        selectedDateElement.style.display = 'block';
        selectedDateElement.style.width = '100%';
      }
    },

    dateClick: function (info) {
      const dateText = info.dateStr; // Data clicada
      /*
      document.getElementById('date-text').innerText = dateText;
      document.getElementById('selected-date').style.display = 'block';
      selectedDateElement.style.width = '100%';
*/
      const selectedDateElement = document.getElementById('selected-date'); // Define el elemento
      document.getElementById('date-text').innerText = dateText;

      // Ajustar estilo para mostrar y expandir al 100%
      selectedDateElement.style.display = 'block';
      selectedDateElement.style.width = '100%';

      const previouslySelected = document.querySelector('.selected-day');
      if (previouslySelected) {
        previouslySelected.classList.remove('selected-day');
      }

      const dayEl = info.dayEl;
      dayEl.classList.add('selected-day');

      // Obtenir incidències del dia
      fetch('app/views/php/get_incidencies.php?data=' + dateText)
        .then(response => response.json())
        .then(data => {
          const incidenciesContainer = document.getElementById('incidencies-container');
          incidenciesContainer.innerHTML = '';

          if (data.length === 0) {
            incidenciesContainer.innerHTML = '<div>No hi ha incidències per aquest dia.</div>';
          } else {
            data.forEach(incidencia => {
              const div = document.createElement('div');
              div.classList.add('incidencia');
              div.innerHTML = `
                <strong>${incidencia.titol_fallo}</strong>
                <span>Ubicació: <em>${incidencia.ubicacio.replace(':', '   •   ')}</em></span>
                <a href="index.php?controller=Info_Incidencias&method=mostrar_incidencia&id=${incidencia.id}" class="btn-masinfo btn btn-primary btn-sm">
                    Mas Informació
                </a>
              `;
              incidenciesContainer.appendChild(div);
            });
          }
        })
        .catch(error => console.error('Error:', error));
    }
  });

  calendar.render();
});
