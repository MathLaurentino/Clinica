var botaoSignin = document.querySelector("#signin");
var botaoSignup = document.querySelector("#signup");
var body = document.querySelector("body");

botaoSignin.addEventListener("click", function(){
    body.className = "sign-in-js";
});

botaoSignup.addEventListener("click", function(){
    body.className = "sign-up-js";
});