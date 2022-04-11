const chatBox = form.querySelector("#textarea");

chatBox.onmouseenter = ()=>{
  chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
  chatBox.classList.remove("active");
}

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "includes/select_message.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          chatBox.innerHTML = data;
        }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);
