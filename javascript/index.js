/* TODO: Functions start */

function toggleClass(elementToUse, classToToggle) {
  elementToUse.classList.toggle(classToToggle);
}

function removeClass(elementToUse, classToRemove) {
  elementToUse.classList.remove(classToRemove);
}

/* FIXME: Functions end */

/* TODO: Header starts */

const homeBars = document.querySelector(".header__bars .fa-bars");
const barsInformations = document.querySelector(".bars__informations");
const closeBarInformations = document.querySelector(
  ".header__nav__bar__mobile .fa-times"
);

const classToShowElement = "active";

homeBars.addEventListener("click", () => {
  toggleClass(barsInformations, classToShowElement);
});

closeBarInformations.addEventListener("click", () => {
  removeClass(barsInformations, classToShowElement);
});

/* FIXME: Header ends */

/* TODO: Faqs start */

const faqs = document.querySelectorAll(".faq");
const answers = document.querySelectorAll(".answer");

faqs.forEach((faq) => {
  faq.addEventListener("click", () => {
    answers.forEach((answer) => {
      if (faq.contains(answer)) {
        toggleClass(faq, classToShowElement);
      }
    });
  });
});

/* FIXME: Faqs end */
