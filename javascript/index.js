/* TODO: Functions start */

function toggleClass(elementToUse, classToToggle) {
  elementToUse.classList.toggle(classToToggle);
}

function removeClass(elementToUse, classToRemove) {
  elementToUse.classList.remove(classToRemove);
}

function addClass(elementToUse, classToAdd) {
  elementToUse.classList.add(classToAdd);
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

const headerNavBarItemsMobile = document.querySelectorAll(
  ".header__nav__bar__item__mobile"
);

headerNavBarItemsMobile.forEach((headerNavBarItemMobile) => {
  headerNavBarItemMobile.addEventListener("click", (e) => {
    removeClass(barsInformations, classToShowElement);
  });
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

/* TODO: Cart starts */

const lessOneItems = document.querySelectorAll(
  ".change__quantity .fa-circle-minus"
);
const plusOneItems = document.querySelectorAll(
  ".change__quantity .fa-circle-plus"
);
const quantities = document.querySelectorAll(".quantities");

const minAmountProducts = 1;
const maxAmountProducts = 9999;

const prices = document.querySelectorAll(".cart__product__informations .price");
const totals = document.querySelectorAll(".totals");
const cartsProductContainer = document.querySelectorAll(
  ".cart__product__container"
);
const finalPrice = document.querySelector(".final__price mark");
let finalPriceValue = 0;

const saveChangesButtons = document.querySelectorAll(
  ".save__changes__container"
);

quantities.forEach((quantity) => {
  quantity.addEventListener("keydown", (e) => {
    e.preventDefault();
  });
});

totals.forEach((total) => {
  total.addEventListener("keydown", (e) => {
    e.preventDefault();
  });
});

lessOneItems.forEach((lessOneItem) => {
  lessOneItem.addEventListener("click", (e) => {
    cartsProductContainer.forEach((cartProductContainer) => {
      if (cartProductContainer.contains(lessOneItem)) {
        quantities.forEach((quantity) => {
          if (cartProductContainer.contains(quantity)) {
            if (quantity.value > minAmountProducts) {
              prices.forEach((price) => {
                if (cartProductContainer.contains(price)) {
                  finalPriceValue = 0;
                  totals.forEach((total) => {
                    if (cartProductContainer.contains(total)) {
                      quantity.value--;
                      price.innerHTML = price.innerHTML.replace("r$", "");
                      price.innerHTML = parseFloat(
                        price.innerHTML.replace(",", ".")
                      );

                      total.value = price.innerHTML * quantity.value;
                      total.value = Math.floor(total.value * 1000) / 1000;
                      if (total.value.includes(".")) {
                        decimals = total.value.split(".");

                        if (decimals[1].length > 2) {
                          total.value = total.value.slice(0, -1);
                        }
                      }

                      total.value = total.value.toString();
                      total.value = total.value.replace(".", ",");
                      if (!total.value.includes(",")) {
                        total.value += ",00";
                      }
                      price.innerHTML = price.innerHTML
                        .toString()
                        .replace(".", ",");

                      if (!price.innerHTML.includes(",")) {
                        price.innerHTML += ",00 r$";
                      } else {
                        price.innerHTML += " r$";
                      }
                    }

                    finalPriceValue += parseFloat(
                      total.value.toString().replace(",", ".")
                    );
                    finalPriceValue = Math.floor(finalPriceValue * 1000) / 1000;

                    finalPrice.innerHTML = finalPriceValue
                      .toString()
                      .replace(".", ",");
                    if (finalPrice.innerHTML.includes(",")) {
                      decimals = finalPrice.innerHTML.split(",");

                      if (decimals[1].length > 2) {
                        finalPrice.innerHTML = finalPrice.innerHTML.slice(
                          0,
                          -1
                        );
                      }
                    } else {
                      finalPrice.innerHTML += ",00";
                    }
                    saveChangesButtons.forEach((saveChangesButton) => {
                      if (cartProductContainer.contains(saveChangesButton)) {
                        if (
                          !saveChangesButton.classList.contains(
                            classToShowElement
                          )
                        ) {
                          addClass(saveChangesButton, classToShowElement);
                          console.log(saveChangesButton.classList);
                        }
                      }
                    });
                  });
                }
              });
            }
          }
        });
      }
    });
  });
});

plusOneItems.forEach((plusOneItem) => {
  plusOneItem.addEventListener("click", (e) => {
    cartsProductContainer.forEach((cartProductContainer) => {
      if (cartProductContainer.contains(plusOneItem)) {
        quantities.forEach((quantity) => {
          if (cartProductContainer.contains(quantity)) {
            if (quantity.value < maxAmountProducts) {
              prices.forEach((price) => {
                if (cartProductContainer.contains(price)) {
                  finalPriceValue = 0;
                  totals.forEach((total) => {
                    if (cartProductContainer.contains(total)) {
                      quantity.value++;
                      price.innerHTML = price.innerHTML.replace("r$", "");
                      price.innerHTML = parseFloat(
                        price.innerHTML.replace(",", ".")
                      );

                      total.value = price.innerHTML * quantity.value;
                      total.value = Math.floor(total.value * 1000) / 1000;
                      if (total.value.includes(".")) {
                        decimals = total.value.split(".");

                        if (decimals[1].length > 2) {
                          total.value = total.value.slice(0, -1);
                        }
                      }

                      total.value = total.value.replace(".", ",");
                      total.value = total.value.toString();
                      if (!total.value.includes(",")) {
                        total.value += ",00";
                      }
                      price.innerHTML = price.innerHTML
                        .toString()
                        .replace(".", ",");

                      if (!price.innerHTML.includes(",")) {
                        price.innerHTML += ",00 r$";
                      } else {
                        price.innerHTML += " r$";
                      }
                    }

                    finalPriceValue += parseFloat(
                      total.value.toString().replace(",", ".")
                    );
                    finalPriceValue = Math.floor(finalPriceValue * 1000) / 1000;

                    finalPrice.innerHTML = finalPriceValue
                      .toString()
                      .replace(".", ",");
                    if (finalPrice.innerHTML.includes(",")) {
                      decimals = finalPrice.innerHTML.split(",");

                      if (decimals[1].length > 2) {
                        finalPrice.innerHTML = finalPrice.innerHTML.slice(
                          0,
                          -1
                        );
                      }
                    } else {
                      finalPrice.innerHTML += ",00";
                    }

                    saveChangesButtons.forEach((saveChangesButton) => {
                      if (cartProductContainer.contains(saveChangesButton)) {
                        if (
                          !saveChangesButton.classList.contains(
                            classToShowElement
                          )
                        ) {
                          addClass(saveChangesButton, classToShowElement);
                          console.log(saveChangesButton.classList);
                        }
                      }
                    });
                  });
                }
              });
            }
          }
        });
      }
    });
  });
});

const pricesInformations = document.querySelectorAll(".prices__information");
const buttonsDeleteFromCart = document.querySelectorAll(
  ".prices__informations__button__container .open__delete__container"
);
const removeProduct = document.querySelectorAll(".button__to__remove__product");
const containersToConfirmDeletation = document.querySelectorAll(
  ".confirm__deletation__container"
);

buttonsDeleteFromCart.forEach((buttonDeleteFromCart) => {
  buttonDeleteFromCart.addEventListener("click", (e) => {
    pricesInformations.forEach((priceInformation) => {
      if (priceInformation.contains(buttonDeleteFromCart)) {
        containersToConfirmDeletation.forEach(
          (containerToConfirmDeletation) => {
            if (priceInformation.contains(containerToConfirmDeletation)) {
              addClass(containerToConfirmDeletation, classToShowElement);
            }
          }
        );
      }
    });
  });
});

const notRemoveProducts = document.querySelectorAll(
  ".confirm__deletation mark"
);

notRemoveProducts.forEach((notRemoveProduct) => {
  notRemoveProduct.addEventListener("click", (e) => {
    containersToConfirmDeletation.forEach((containerToConfirmDeletation) => {
      if (containerToConfirmDeletation.classList.contains(classToShowElement)) {
        removeClass(containerToConfirmDeletation, classToShowElement);
      }
    });
  });
});

/* FIXME: Carts end */

/* TODO: Contact starts */

const messageSentContainer = document.querySelector(
  ".message__sent__container"
);
const closeMessageSentContainer = document.querySelector(".ok");

if (closeMessageSentContainer !== null) {
  closeMessageSentContainer.addEventListener("click", (e) => {
    removeClass(messageSentContainer, classToShowElement);
  });
}

/* FIXME: Contact ends */
