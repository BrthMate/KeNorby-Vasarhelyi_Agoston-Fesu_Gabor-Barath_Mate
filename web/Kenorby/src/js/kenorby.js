const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const container = document.querySelector(".container");
const ul = document.querySelector(".ul-li");
const filter = document.querySelector(".filter");
const search = document.querySelector(".search-rest");
const card = document.querySelectorAll(".card");
const col = document.querySelectorAll(".col-md-4, .col-lg-3, .col-xl-2")
const view = document.querySelector(".view");
const sort = document.querySelector(".sort");
const blur = document.querySelector(".items > .container");
const sorted = document.querySelector("#sorted-items");
const carouselImg = document.querySelectorAll(".carousel-img");

var inputLeft = document.getElementById("input-left");
var inputRight = document.getElementById("input-right");
var thumbLeft = document.querySelector(".slider  .thumb.left");
var thumbRight = document.querySelector(".slider .thumb.right");
var range = document.querySelector(".slider .range");

let menuOpen = false;
let filterActive = false;
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

function setLeftValue() {
	var _this = inputLeft,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

	var percent = ((_this.value - min) / (max - min)) * 100;
  var value = (_this.value) ;

	thumbLeft.style.left = percent + "%";
	range.style.left = percent + "%";
  document.getElementById('rangeValuemin').setAttribute('value',Math.floor(value));
}
setLeftValue();

function setRightValue() {
	var _this = inputRight,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

	var percent = ((_this.value - min) / (max - min)) * 100;
  var value = (_this.value) ;
  
	thumbRight.style.right = (100 - percent) + "%";
	range.style.right = (100 - percent) + "%";
  document.getElementById('rangeValuemax').setAttribute('value',Math.floor(value));
}
setRightValue();

inputLeft.addEventListener("input", setLeftValue);
inputRight.addEventListener("input", setRightValue);

filter.addEventListener("click",()=>{
  if(!filterActive) {
    search.classList.add('open');
    blur.style.filter = "blur(3px)";
    filterActive = true;
  } else {
    search.classList.remove('open');
    blur.style.filter = "blur(0)";
    filterActive = false;
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
    carouselImg.forEach(item=>{item.classList.add("open")});
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
      carouselImg.forEach(item=>{item.classList.remove("open")});
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
function reportWindowSize() {
  console.log(window.innerWidth);
  if(window.innerWidth>992){
    blur.style.filter = "blur(0px)";
  }if(filterActive && window.innerWidth<992){
    blur.style.filter = "blur(3px)";
  }
}

window.onresize = reportWindowSize;