const form = document.querySelector(".form");
const sendButton = form.querySelector("button");
const input = form.querySelector(".sendMessageInput");



sendButton.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/insert_message.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            input.value = "";
            let data =xhr.response;
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
