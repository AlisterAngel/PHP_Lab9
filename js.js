//JavaScript

const btn = document.querySelector("#loginBtn");
btn.disabled = true;
const userName = document.querySelector("#username");
const passwordInput = document.querySelector("#password");

function submitForm(event) {
  if(userName.value !== ""&&passwordInput.value !== ""){
    btn.disabled = false;
  }else {
    btn.disabled = true;
  }
}

userName.addEventListener("change", submitForm);
passwordInput.addEventListener("change", submitForm);