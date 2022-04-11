const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");
const BigImages = document.querySelector(".bannner-img");
const Img = document.querySelectorAll(".other-images");
const arrows = document.querySelectorAll(".bxs-right-arrow");
const imagesLists = document.querySelectorAll(".images");

let menuOpen = false;


Img.forEach(item=>{
  item.addEventListener("click",()=>{
    var image = item.src;
    BigImages.setAttribute("src", image);
  });
});

arrows.forEach((arrow, i) => {
  const itemNumber = imagesLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  let minusz = 0;
  arrow.addEventListener("click", () => {
    if(window.innerWidth< 768){
      minusz = 54;
    }else{
      minusz = (window.innerWidth*0.05)+35;
    }
    const ratio = Math.floor(window.innerWidth / (window.innerWidth/4));
    clickCounter++;
    if (itemNumber - (4 + clickCounter) + (4 - ratio) >= 0) {
      imagesLists[i].style.transform = `translateX(${
        imagesLists[i].computedStyleMap().get("transform")[0].x.value - ((window.innerWidth-minusz)/4)
      }px)`;
    } else {
      imagesLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });
});
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
