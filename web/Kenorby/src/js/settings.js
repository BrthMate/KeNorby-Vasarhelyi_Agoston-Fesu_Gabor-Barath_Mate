const show = document.querySelector(".bx-show-alt");
const showSignUp = document.querySelector("#show-sign-up");

showSignUp.addEventListener("mouseover",() => {

    var SignUpPass = document.getElementById("SignUpPass"); 
    var SignUpPassAgain = document.getElementById("SignUpPassAgain"); 
    var hide = document.getElementById("hide-sign-up"); 
    SignUpPass.type = "text";
    SignUpPassAgain.type = "text";
    hide.style.display = "flex";
    setTimeout(function() {
    SignUpPass.type = "password";
    SignUpPassAgain.type = "password";
    hide.style.display = "none";
  }, 600);
});

const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");

let menuOpen = false;

menuBtn.addEventListener('click', () => {
  if(!menuOpen) {
    menuBtn.classList.add('open');
    menu.classList.add('open');
    container.classList.add('open');
    ul.classList.add('open');
    menuOpen = true;
  } else {
    menuBtn.classList.remove('open');
    menu.classList.remove('open');
    container.classList.remove('open');
    ul.classList.remove('open');
    menuOpen = false;
  }
});

