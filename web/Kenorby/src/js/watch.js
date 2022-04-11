const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");

const card = document.querySelectorAll(".card");
const col = document.querySelectorAll(".col-md-4, .col-lg-3, .col-xl-2")
const view = document.querySelector(".view");
const sort = document.querySelector(".sort");
const sorted = document.querySelector("#sorted-items");

let menuOpen = false;
let viewActive =false;
let sortedActive =false;


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
    col.forEach(item=>{
        item.classList.remove('col-md-4')
        item.classList.remove('col-lg-3')
        item.classList.remove('col-xl-3')
        item.classList.add('col-xl-6')
    });
    card.forEach(item=>{
      item.classList.toggle("open")
    });
    viewActive = true;
  } else {
    card.forEach(item=>{
      item.classList.remove("open")
    });
    col.forEach(item=>{
      item.classList.add('col-md-4')
      item.classList.add('col-lg-3')
      item.classList.add('col-xl-3')
      item.classList.remove('col-xl-6')
    });
    
    viewActive = false;
    
  }
});
sort.addEventListener("click",()=>{
  if(!sortedActive) {
    sorted.classList.toggle('opens');
    sortedActive = true;
  } else {
    sorted.classList.remove('opens');
    sortedActive = false;
  }
});
