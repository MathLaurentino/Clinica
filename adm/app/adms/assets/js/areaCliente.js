var btnAgendamento = document.querySelector("#bntAgendamento");
var btnHistorico = document.querySelector("#bntHistorico");
var bntCancelamento = document.querySelector("#bntCancelamento");

var divAgendamentos = document.querySelector("#agendamentos");
var divHistoricos = document.querySelector("#historico");
var divCancelamentos = document.querySelector("#cancelamento");


btnAgendamento.addEventListener("click", function(){
    divHistoricos.className = "collapse";
    divCancelamentos.className = "collapse";
});

btnHistorico.addEventListener("click", function(){
    divAgendamentos.className = "collapse";
    divCancelamentos.className = "collapse";
});

bntCancelamento.addEventListener("click", function(){
    divAgendamentos.className = "collapse";
    divHistoricos.className = "collapse";
});