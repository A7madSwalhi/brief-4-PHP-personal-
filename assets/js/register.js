let form = document.forms[2];
let username = document.querySelector('input[name="name"]');
let email = document.querySelector('input[name="email"]');
let password = document.querySelector('input[name="pass"]');
let conpassword = document.querySelector('input[name="cpass"]');
let btn = document.querySelector('button[type="submit"]');
let cpass_error = document.getElementById("cpass_error");
let pass_error = document.getElementById("pass_error");
let email_error = document.getElementById("email_error");
let user_error = document.getElementById("user_error");

let usernamereg = /^[a-zA-z0-9_-]{3,16}$/;
let emailreg = /^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
let passwordreg =
  /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/;

email.addEventListener("blur", () => {
  if (!emailreg.test(email.value)) {
    email_error.innerHTML = "Invalid Email";
  } else {
    email_error.innerHTML = "";
  }
});

username.addEventListener("blur", () => {
  if (!usernamereg.test(username.value)) {
    user_error.innerHTML = "Invalid Username";
  } else {
    user_error.innerHTML = "";
  }
});

password.addEventListener("blur", () => {
  if (!passwordreg.test(password.value)) {
    pass_error.innerHTML =
      "Your Password Must Contain At Least One Uppercase And Lowercase And Special character";
  } else {
    pass_error.innerHTML = "";
  }
});

conpassword.addEventListener("blur", () => {
  if (password.value !== conpassword.value) {
    cpass_error.innerHTML = "Passwords do not match";
  } else {
    cpass_error.innerHTML = "";
  }
});

form.onsubmit = (e) => {
  let validation = true;

  if (!emailreg.test(email.value)) {
    console.log("Invalid email");
    validation = false;
  }

  if (!usernamereg.test(username.value)) {
    console.log("Invalid username");
    validation = false;
  }

  if (!passwordreg.test(password.value)) {
    console.log("Invalid password");
    validation = false;
  }

  if (password.value !== conpassword.value) {
    console.log("Passwords do not match");
    validation = false;
  }

  if (validation) {
    btn.disabled = true;
  } else {
    e.preventDefault();
  }
};

console.log(form);
console.log(username);
console.log(email);
console.log(password);
console.log(conpassword);
console.log(btn);
console.log("*****************************");
console.log(cpass_error);
console.log(pass_error);
console.log(email_error);
console.log(user_error);
