/* TODO: See more starts */

const amount = document.querySelector("#amount");
const total = document.querySelector("#total");
let productPrice = total.value.replace(",", ".");
productPrice = parseFloat(productPrice);

const increaseAmount = document.querySelector(
  ".amount__container .fa-caret-up"
);
const decreaseAmount = document.querySelector(
  ".amount__container .fa-caret-down"
);

const cartInformations = document.querySelector("#cart__informations");

const minAmountOfProduct = 1;
const maxAmountOfProduct = 9999;
const minLength = 0;
const maxLength = 4;
const ctrlPressed = 13;

increaseAmount.addEventListener("click", () => {
  if (amount.value < maxAmountOfProduct) {
    amount.value++;
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 1000) / 1000;

    total.value = total.value.toString().replace(".", ",");
    if (total.value.includes(",")) {
      decimals = total.value.split(",");

      if (decimals[1].length > 2) {
        total.value = total.value.slice(0, -1);
      }
    } else {
      total.value += ",00";
    }
  }
});

decreaseAmount.addEventListener("click", () => {
  if (amount.value > minAmountOfProduct) {
    amount.value--;
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 1000) / 1000;
    total.value = total.value.toString().replace(".", ",");
    if (total.value.includes(",")) {
      decimals = total.value.split(",");

      if (decimals[1].length > 2) {
        total.value = total.value.slice(0, -1);
      }
    } else {
      total.value += ",00";
    }
  }
});

amount.addEventListener("keydown", (e) => {
  if (e.keyCode === ctrlPressed) {
    e.preventDefault();
    if (amount.value <= minLength) {
      amount.value = 1;
    }
  }

  if (amount.value.length <= maxLength) {
    currentAmount = amount.value;
  }

  if (amount.value.length > maxLength) {
    amount.value = currentAmount;
  }

  if (amount.value.length >= minLength || amount.value >= minAmountOfProduct) {
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 1000) / 1000;
    total.value = total.value.toString().replace(".", ",");
    if (total.value.includes(",")) {
      decimals = total.value.split(",");

      if (decimals[1].length > 2) {
        total.value = total.value.slice(0, -1);
      }
    } else {
      total.value += ",00";
    }
  }
});

amount.addEventListener("keyup", (e) => {
  if (amount.value < minLength) {
    amount.value = minAmountOfProduct;
  }

  if (amount.value >= minLength && amount.value.length <= maxLength) {
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 1000) / 1000;
    total.value = total.value.toString().replace(".", ",");
    if (total.value.includes(",")) {
      decimals = total.value.split(",");

      if (decimals[1].length > 2) {
        total.value = total.value.slice(0, -1);
      }
    } else {
      total.value += ",00";
    }
  }

  if (amount.value.length <= maxLength) {
    currentAmount = amount.value;
  }

  if (amount.value.length > maxLength) {
    amount.value = currentAmount;
  }
});

const addToCartButton = document.querySelector("#add__to__cart__button");
const userLogged = document.querySelector("#check__user__logged");
const userNotLoggedContainer = document.querySelector(
  ".user__not__logged__container"
);
const closeUserNotLoggedContainer = document.querySelector(
  ".user__not__logged__container .fa-times"
);

addToCartButton.addEventListener("click", () => {
  cartInformations.addEventListener("submit", (e) => {
    if (!userLogged.value) {
      e.preventDefault();
      addClass(userNotLoggedContainer, classToShowElement);
    }
  });
});

closeUserNotLoggedContainer.addEventListener("click", (e) => {
  removeClass(userNotLoggedContainer, classToShowElement);
});

const cannotAddMoreContainer = document.querySelector(
  ".cannot__add__more__container"
);
const closeCannotAddMoreContainer = document.querySelector(
  ".cannot__add__more__container mark"
);

closeCannotAddMoreContainer.addEventListener("click", (e) => {
  removeClass(cannotAddMoreContainer, classToShowElement);
});

/* FIXME: See more ends */
