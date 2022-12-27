(function(win,doc){
    'use strict';

  function getCalendar(perfil, div)
  {
      let calendarEl = doc.querySelector(div);
      let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        headerToolbar:{
            start: 'prev,next,today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText:{
            today:    'Hoje',
            month:    'Mês',
            week:     'Semana',
            day:      'Dia'
        },

        locale: 'pt-br',

        dateClick: function(info) {
          if (perfil == 'manager') {
            win.location.href = 'http://localhost/Clinica/Home' + info.dateStr;
            console.log("Clicou em " + info.dataStr);
          } else {
            if(info.view.type == 'dayGridMonth') {
              calendar.changeView('timeGrid', info.dateStr);
            } else {
              win.location.href = 'http://localhost/Clinica/Home';
            }
          }
            /*alert('Clicked on: ' + info.dateStr);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('Current view: ' + info.view.type);
            info.dayEl.style.backgroundColor = 'grey';*/
          },

          events: 'http://localhost/php/calendario2022/controller/ControllerEvents.php',

          eventClick: function(info) {
            if (perfil == 'manager') {
              win.location.href=`../../view/manager/editar.php?id=${info.event.id}`
            }
          },
          extraParams: function() {
            return {
              cachebuster: new Date().valueOf()
            };
          }
      });
    calendar.render();
  }

    if (doc.querySelector('.calendarUser')) {
      getCalendar('user', '.calendarUser');
    } else if (doc.querySelector('.calendarManager')) {
      getCalendar('manager', '.calendarManager');
    }

    if(doc.querySelector('#delete')) {
      let btn=doc.querySelector('#delete');

      btn.addEventListener('click', (event) => {
        event.preventDefault();

        if(confirm("Deseja mesmo apagar este dado?")) {
          win.location.href = event.target.parentNode.href;
        }

      },false);
    }

})(window,document);