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
    total.value = Math.floor(total.value * 100) / 100;
    total.value = total.value.replace(".", ",");
  }
});

decreaseAmount.addEventListener("click", () => {
  if (amount.value > minAmountOfProduct) {
    amount.value--;
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 100) / 100;
    total.value = total.value.replace(".", ",");
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
    total.value = Math.floor(total.value * 100) / 100;
    total.value = total.value.replace(".", ",");
  }
});

amount.addEventListener("keyup", (e) => {
  if (amount.value < minLength) {
    amount.value = minAmountOfProduct;
  }

  if (amount.value >= minLength && amount.value.length <= maxLength) {
    total.value = productPrice * amount.value;
    total.value = Math.floor(total.value * 100) / 100;
    total.value = total.value.replace(".", ",");
  }

  if (amount.value.length <= maxLength) {
    currentAmount = amount.value;
  }

  if (amount.value.length > maxLength) {
    amount.value = currentAmount;
  }
});

/* FIXME: See more ends */

// cartInformations.addEventListener("submit", (e) => {
//   e.preventDefault();
//   total.value = productPrice * amount.value;
//   total.value = Math.floor(total.value * 100) / 100;
//   total.value = total.value.replace(".", ",");
// });
