const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");
const uploadbutton = document.querySelector("#upload-button");
const showPicsButton = document.querySelector("#showPics");
const PicsCont = document.querySelector(".pics-container");
const Pics = document.querySelector(".pics");
const hide = document.querySelector("#hide");

let menuOpen = false;
let picsOpen = false;

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
function view(){
  Pics.innerHTML = "";
  showPicsButton.value = `${uploadbutton.files.length} Kiválasztott file`;
  for(i of uploadbutton.files){
      let reader = new FileReader();
      let figure = document.createElement("figure");
      let figCap = document.createElement("figcaption");
      figCap.innerText = i.name;
      figure.appendChild(figCap);
      reader.onload=()=>{
          let img = document.createElement("img");
          img.setAttribute("src",reader.result);
          figure.insertBefore(img,figCap);
      }
      Pics.appendChild(figure);
      reader.readAsDataURL(i);
  }
};
showPicsButton.addEventListener("click",() =>{
  if(!picsOpen) {
    PicsCont.classList.add('open');
    picsOpen = true;
  } else {
    PicsCont.classList.remove('open');
    picsOpen = false;
  }
});
hide.addEventListener("click",() =>{
  if(!picsOpen) {
    PicsCont.classList.add('open');
    picsOpen = true;
  } else {
    PicsCont.classList.remove('open');
    picsOpen = false;
  }
});
document.querySelector('#showPics').addEventListener('click', function(event) {
  event.preventDefault();
});