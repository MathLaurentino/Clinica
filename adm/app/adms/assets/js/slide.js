

// var div1 = document.getElementById("btInfo");
// div1.addEventListener("click", function(event){

//     var div2 = document.getElementById("agendamentos");

//     if (div2.class == "collapse show") {
//         link2.aria-expanded = false;
//     } 

//     if (botao12.classList[1] == "btn-outline-danger" || botao12.classList[1] == "btn-danger") {
//         alert("Horário indisponível");
//     } else {
//         window.open("<?= URL ?>Agendamento/agendar?dia=" + info.startStr + "&horario=" + botao12.value + "&servico=" + <?= $_GET['servico'] ?>,"_self");
//     }

// })
console.log("aqui");
document.getElementById("btInfo").onclick  = function() {

    var divInfo = document.getElementById("infoPessoais");

    if (divInfo.class == "collapse show") {
        console.log("oi");
    }
    
}