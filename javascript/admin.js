/* TODO: Functions start */

function toggleClass(elementToUse, classToToggle) {
  elementToUse.classList.toggle(classToToggle);
}

function removeClass(elementToUse, classToRemove) {
  elementToUse.classList.remove(classToRemove);
}

/* FIXME: Functions end */

const deleteForms = document.querySelectorAll(".delete__form");

deleteForms.forEach((deleteForm) => {
  deleteForm.addEventListener("submit", (e) => {
    e.preventDefault();
  });
});
