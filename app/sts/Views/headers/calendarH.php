<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>

    <link href='<?= CSS ?>core/main.min.css' rel='stylesheet' />
    <link href='<?= CSS ?>daygrid/main.min.css' rel='stylesheet' />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                //eventLimit: true, 
                weekends: false, // tira o fim de semana
                //events:  //echo $this->data,

                
                
                extraParams: function () {
                    return {
                        cachebuster: new Date().valueOf()
                    };
                },



                select: function(info) {

                    var events = <?= $this->data ?>;

                    $('#horarios').modal('show'); // hide -> para fechar

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

                    var hourNow = new Date().toLocaleTimeString();
                    var hourNow = hourNow.slice(0,2);

                    // caso tenha clicado em um dia que já passou - deixa o botao vermelho tranparente
                    if (difInD > 0) {

                        for (y = 12; y <= 18; y++) {
                            document.getElementById("bnt"+y).classList = "btn btn-outline-danger";
                        }

                    } else {

                        for (y = 12; y <= 18; y++) {
                            document.getElementById("bnt"+y).classList = "btn btn-outline-success";
                        }

                        for (y = 0; y < events.length; y++) {

                            event = events[y];
                            
                            dateEvent = event["data_consulta"];
                            hourEvent = event["horario_consulta"];

                            yearEvent = dateEvent.slice(0,4);
                            monthEvent = dateEvent.slice(5,7);
                            dayEvent = dateEvent.slice(8,10);
                            hourEvent = hourEvent.slice(0,2);

                            // caso exista um evento na data selecionada - deixa o botao vermelho total
                            if (yearForm == yearEvent && monthForm == monthEvent && dayForm == dayEvent) {
                                document.getElementById("bnt"+hourEvent).classList = "btn btn-danger";
                            } 

                        }

                        // caso já tenha passado do horario do primeiro botão
                        if (hourNow >= 12 && yearForm == yearNow && monthForm == monthNow && dayForm == dayNow) {
                            for (x = 12; x <= hourNow; x++) {
                                document.getElementById("bnt"+x).classList = "btn btn-outline-danger";
                                if (x == 18) { x = hourNow; }
                            }
                        }

                    } 

                    
                    var botao12 = document.getElementById("bnt12");
                    botao12.addEventListener("click", function(event){

                        if (botao12.classList[1] == "btn-outline-danger" || botao12.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao12.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao13 = document.getElementById("bnt13");
                    botao13.addEventListener("click", function(event){

                        if (botao13.classList[1] == "btn-outline-danger" || botao13.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao13.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao14 = document.getElementById("bnt14");
                    botao14.addEventListener("click", function(event){

                        if (botao14.classList[1] == "btn-outline-danger" || botao14.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao14.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao15 = document.getElementById("bnt15");
                    botao15.addEventListener("click", function(event){

                        if (botao15.classList[1] == "btn-outline-danger" || botao15.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao15.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao16 = document.getElementById("bnt16");
                    botao16.addEventListener("click", function(event){

                        if (botao16.classList[1] == "btn-outline-danger" || botao16.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao16.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao17 = document.getElementById("bnt17");
                    botao17.addEventListener("click", function(event){

                        if (botao17.classList[1] == "btn-outline-danger" || botao17.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao17.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    var botao18 = document.getElementById("bnt18");
                    botao18.addEventListener("click", function(event){

                        if (botao18.classList[1] == "btn-outline-danger" || botao18.classList[1] == "btn-danger") {
                            alert("Horário indisponível");
                        } else {
                            window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao18.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
                        }

                    })

                    const refrech = document.querySelector('#refresh') 
                    
                    refresh.addEventListener('click', () =>{
                        location.reload()
                    })

                },

            });

            calendar.render();

        });

    </script>

    <link rel="stylesheet" type="text/css" href='<?= CSS ?>agendamento.css'>

</head>

<body>
    


