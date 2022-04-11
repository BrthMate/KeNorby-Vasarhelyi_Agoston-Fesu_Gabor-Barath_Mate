const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const items = document.querySelectorAll(".container,.sign-up,.sign-in,.sign-in-up,.left-panel,.right-panel,.logo,.image");
const show = document.querySelector(".bx-show-alt");
const showSignUp = document.querySelector("#show-sign-up");
const forgetpass = document.querySelector('.forget-pass');
const pass = document.querySelector('#input-field-pass');
const email = document.querySelector("#sendmail");
const Button = document.querySelector("#Button");

let forget = false;

show.addEventListener("mouseover",() => {
    var SignInPass = document.getElementById("pass"); 
    var hide = document.getElementById("bx-hide"); 
    SignInPass.type = "text";
    hide.style.display = "flex";
    setTimeout(function() {
    SignInPass.type = "password";
    hide.style.display = "none";
  }, 600);
})
showSignUp.addEventListener("mouseover",() => {

    var SignUpPass = document.getElementById("SignUpPass"); 
    var hide = document.getElementById("hide-sign-up"); 
    SignUpPass.type = "text";
    hide.style.display = "flex";
    setTimeout(function() {
    SignUpPass.type = "password";
    hide.style.display = "none";
  }, 600);
})

sign_in_btn.addEventListener("click", () => {
    items.forEach(item=>{
        item.classList.toggle("active")
    })
});

sign_up_btn.addEventListener("click", () => {
    items.forEach(item=>{
        item.classList.remove("active")
    })
});
forgetpass.addEventListener("click",() => {
    const spanTag = document.querySelector(".forget-text");
    if(!forget){
        pass.style.display = "none";
        forget = true;
        email.setAttribute("type","email");
        email.setAttribute("placeholder","email cím");
        Button.setAttribute("name","ForgetEmail");
        Button.setAttribute('value',"Elküld");
        spanTag.innerHTML = "Vissza a Belépéshez";
    }else{
        pass.style.display = "flex";
        email.setAttribute("type","text");
        forget = false;
        email.setAttribute("placeholder","Felhasználó név");
        Button.setAttribute("name","Login");
        Button.setAttribute('value',"Belépés");
        spanTag.innerHTML = "Elfelejtett jelszó?";
    }

})