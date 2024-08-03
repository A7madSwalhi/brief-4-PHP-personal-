let form = document.forms[2];
let email = document.querySelector('input[name="email"]');
let password = document.querySelector('input[name="pass"]');
let emailer = document.getElementById("email_error");
let stateer = document.getElementById("state");

let emailreg = /^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
let passwordreg =
  /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/;

email.addEventListener("blur", () => {
  if (!emailreg.test(email.value)) {
    emailer.innerHTML = "Invalid Email !";
  } else {
    emailer.innerHTML = "";
  }
});

form.onsubmit = (e) => {
  let validation = true;

  if (!emailreg.test(email.value)) {
    console.log("Invalid email");
    validation = false;
  }

  if (validation) {
    btn.disabled = true;
  } else {
    e.preventDefault();
  }
};

console.log(form);
console.log(email);
console.log(password);
