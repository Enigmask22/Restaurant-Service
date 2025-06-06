const togglePassword1 = document.querySelector("#togglePassword1");
const password1 = document.querySelector("#password1");

togglePassword1.addEventListener("click", function () {
  // toggle the type attribute
  const type =
    password1.getAttribute("type") === "password" ? "text" : "password";
  password1.setAttribute("type", type);

  // toggle the icon
  this.classList.toggle("bi-eye");
});

// prevent form submit
const form = document.querySelector("form");
form.addEventListener("submit", function (e) {
  e.preventDefault();
});

const togglePassword2 = document.querySelector("#togglePassword2");
const password2 = document.querySelector("#password2");

togglePassword2.addEventListener("click", function () {
  // toggle the type attribute
  const type =
    password2.getAttribute("type") === "password" ? "text" : "password";
  password2.setAttribute("type", type);

  // toggle the icon
  this.classList.toggle("bi-eye");
});

const togglePassword3 = document.querySelector("#togglePassword3");
const password3 = document.querySelector("#password3");

togglePassword3.addEventListener("click", function () {
  // toggle the type attribute
  const type =
    password3.getAttribute("type") === "password" ? "text" : "password";
  password3.setAttribute("type", type);

  // toggle the icon
  this.classList.toggle("bi-eye");
});
