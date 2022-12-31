<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>

    <link href='<?= CSS ?>core/main.min.css' rel='stylesheet' />
    <link href='<?= CSS ?>daygrid/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" type="text/css" href='<?= CSS ?>agendamento.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <script src='<?= URL ?>app/sts/assets/js/core/main.min.js'></script>
    <script src='<?= URL ?>app/sts/assets/js/interaction/main.min.js'></script>
    <script src='<?= URL ?>app/sts/assets/js/daygrid/main.min.js'></script>
    <script src='<?= URL ?>app/sts/assets/js/core/locales/pt-br.js'></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





    <script>

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                locale: 'pt-br',
                plugins: [ 'interaction', 'dayGrid' ],
                selectable: true,
                editable: true,
                eventLimit: true, 
                //weekends: false, // tira o fim de semana
                events: <?= $this->data ?>,
                




                extraParams: function () {
                    return {
                        cachebuster: new Date().valueOf()
                    };
                },





                select: function(info) {

                    events = <?= $this->data ?>;

                    $('#cadastrar').modal('show');

                    var dateNow = new Date();
                    var dayNow = String(dateNow.getDate()).padStart(2, '0');
                    var monthNow = String(dateNow.getMonth() + 1).padStart(2, '0');
                    var yearNow = dateNow.getFullYear();

                    var dateForm = info.start.toLocaleString();
                    var dayForm = dateForm.slice(0,2);
                    var monthForm = dateForm.slice(3,5);
                    var yearForm = dateForm.slice(6,10);

                    var dateNowCount = yearNow + "-" + monthNow + "-" + dayNow;
                    var dateFormCount = yearForm + "-" + monthForm + "-" + dayForm;

                    var difInM = new Date(dateNowCount) - new Date(dateFormCount);
                    var difInD = difInM / (1000 * 60 * 60 * 24);

                    if (difInD > 0) {

                        for (y = 8; y <=16; y++) {
                            document.getElementById("bnt"+y).classList = "btn btn-outline-danger";
                        }

                    } else {

                        for (y = 8; y <=16; y++) {
                            document.getElementById("bnt"+y).classList = "btn btn-outline-success";
                        }

                        for (y = 0; y < events.length; y++) {

                            event = events[y];
                            dateEvent = event['start'];

                            yearEvent = dateEvent.slice(0,4);
                            monthEvent = dateEvent.slice(5,7);
                            dayEvent = dateEvent.slice(8,10);

                            hourEvent = dateEvent.slice(11,13);

                            if (yearForm == yearEvent && monthForm == monthEvent && dayForm == dayEvent) {
                                document.getElementById("bnt"+hourEvent).classList = "btn btn-danger";

                                hourNow = new Date().toLocaleTimeString();
                                hourNow = hourNow.slice(0,2);

                                if (hourNow >= 8 && yearForm == yearNow && monthForm == monthNow && dayForm == dayNow) {
                                    for (x = 8; x <= hourNow; x++) {
                                        document.getElementById("bnt"+x).classList = "btn btn-outline-danger";
                                        if (x == 16) { x = hourNow; }
                                    }
                                }

                            } else {
                                document.getElementById("bnt"+hourEvent).classList = "btn btn-outline-success";
                            }
                        }
                    } 
                    
                },





                eventClick: function(info) { // info = informações do evento

                    info.jsEvent.preventDefault(); // don't let the browser navigate

                    $('#visualizar #id').text(info.event.id)
                    $('#visualizar #title').text(info.event.title)
                    $('#visualizar #start').text(info.event.start.toLocaleString())
                    $('#visualizar #end').text(info.event.end.toLocaleString())
                    $('#visualizar').modal('show');
                 

                    str = info.event.start.toLocaleString();
                    data = str.split(" ");
                    data = data[1].split(":"); // data[0] = hora // data[1] = minutos // data[2] = segundos 
                    
                    

                    

                    // if (info.event.url) {
                    //     window.open(info.event.url,"_self");
                    // } else {
                    //     alert("sem URL");
                    // }

                },

            });

            calendar.render();

        });

        function DataHora(evento, objeto) {

            var keypress = (window.event) ? event.keyCode : evento.which;
            campo = eval(objeto);
            if (campo.value == '00/00/0000 00:00:00') {
                campo.value = "";
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;
            if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto3)
                    campo.value = campo.value + separacao2;
                else if (campo.value.length == conjunto4)
                    campo.value = campo.value + separacao3;
                else if (campo.value.length == conjunto5)
                    campo.value = campo.value + separacao3;
            } else {
                event.returnValue = false;
            }
        }

    </script>




</head>

<body>
    


