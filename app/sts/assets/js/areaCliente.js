var btnInfoP = document.querySelector("#infoP");
var btnAgenda = document.querySelector("#agenda");

var divInfo = document.querySelector("#infoPessoais");
var divAgendamentos = document.querySelector("#agendamentos");


btnInfoP.addEventListener("click", function(){
    divAgendamentos.className = "collapse";

});

btnAgenda.addEventListener("click", function(){
    divInfo.className = "collapse";
});