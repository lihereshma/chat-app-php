// password show hide
var visible = document.querySelector('.show');
var password = document.querySelector('.password input');
visible.addEventListener('click',displayPassword);
function displayPassword() {
  if(password.type === "password") {
    password.type = "text";
    visible.classList.toggle('hide');
  } else {
    password.type = "password";
    visible.classList.remove('hide');
  }
}