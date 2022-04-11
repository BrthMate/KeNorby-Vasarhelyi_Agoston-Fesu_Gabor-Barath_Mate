const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");

const card = document.querySelectorAll(".card");
const view = document.querySelector(".view");

let menuOpen = false;
let viewActive =false;



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
view.addEventListener("click",()=>{
  if(!viewActive) {
    card.forEach(item=>{
      item.classList.toggle("open")
    });
    viewActive = true;
  } else {
    card.forEach(item=>{
      item.classList.remove("open")
    });    
    viewActive = false;
    
  }
});

