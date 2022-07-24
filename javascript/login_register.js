/* TODO: Functions start */

function removeClass(elementToUse, classToRemove) {
  elementToUse.classList.remove(classToRemove);
}

function insertClass(elementToUse, classToInsert) {
  elementToUse.classList.add(classToInsert);
}

/* FIXME: Functions end */

/* TODO: Login and register starts */

const classToShowElement = "active";

const hidePassword = document.querySelector(".fa-eye");
const showingPassword = document.querySelector(".fa-eye-slash");
const passwordElement = document.querySelector("#password");

showingPassword.addEventListener("click", () => {
  removeClass(showingPassword, classToShowElement);
  insertClass(hidePassword, classToShowElement);
  passwordElement.setAttribute("type", "text");
});

hidePassword.addEventListener("click", () => {
  removeClass(hidePassword, classToShowElement);
  insertClass(showingPassword, classToShowElement);
  passwordElement.setAttribute("type", "password");
});

/* FIXME: Login and register ends */
