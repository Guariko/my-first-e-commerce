<?php

session_start();

if (isset($_SESSION["adminUsing"])) {
    header("location: views/admin_index.php");
    die();
}

unset($_SESSION["searchForValue"]);
unset($_SESSION["allRecommendations"]);
unset($_SESSION["errorMessageEmail"]);
unset($_SESSION["errorMessageName"]);
unset($_SESSION["errorMessageSubject"]);
unset($_SESSION["contactUserName"]);
unset($_SESSION["contactUserSubject"]);
unset($_SESSION["contactUserEmail"]);
unset($_SESSION["displayMessageSent"]);

$model = "Test";
$style = "../css/styles.css";
$normalizeCss = "../css/normalize.css";

$script = "../javascript/index.js";
$seeModeScript = "../javascript/see_more.js";

include("templates/head__foot/head.php");

$userInterfacePath = "../index.php";

$scrollHome = "$userInterfacePath#home";
$scrollRecommendations = "$userInterfacePath#recommendations";
$scrollFaqs = "$userInterfacePath#faqs";

$cartPath = "cart.php";

$loginPath = "login.php";
$registerPath = "register.php";
$logOutPath = "../configs/log_out.php";

include("templates/header.php");

$dataBaseConfigPath = "../configs/dataBaseConfig.php";
$classesPath = "../configs/classes.php";

$homePath = "../index.php";
require_once("../configs/see_more_controller.php");

?>

<main class="see__more__main main">

    <?php if ($productData) : ?>

        <div class="see__more__content__container">

            <div class="see__more__h1__container__mobile">
                <h1 class="see__more__h1"> <?= $productData["name"] ?> </h1>
            </div>


            <div class="product__image__container">
                <img src="../images/<?= $productData["image"] ?>" alt="">
            </div>

            <div class="recommendation__informations">

                <h1 class="see__more__h1 see__more__h1__desktop "><?= $productData["name"] ?></h1>

                <p class="product__content"> <?= $productData["content"] ?> </p>


                <div class="recommendation__stars__container">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>

                <div class="recommendation__content__container">
                    <mark class="recommendation__price">
                        <?= $productData["price"] ?> r$
                    </mark>
                </div>

                <div class="see__more__action__container">
                    <form action="" method="POST" id="cart__informations">
                        <div class="amount__container">
                            <label for="amount">quantidade</label>
                            <input type="number" name="amount" id="amount" value="1">
                            <div class="arrows">
                                <i class="fa-solid fa-caret-up"></i>
                                <i class="fa-solid fa-caret-down"></i>
                            </div>

                        </div>
                        <div class="total__container">
                            <label for="total">total</label>
                            <input type="text" name="total" value="<?= $productData["price"] ?>" readonly id="total">
                            <mark>r$</mark>
                        </div>
                        <div class="see__more__buttons__container <?= $addedToCart ?> ">
                            <input type="hidden" id="check__user__logged" value="<?= $checkUserLogged ?>">
                            <button class="button cart " type="submit" name="add__to__cart" id="add__to__cart__button">adicinar ao carrinho <i class="fa-solid fa-cart-shopping"></i>
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                            <button type="submit" name="buy__now" class="button">comprar agora</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <div class="user__not__logged__container">
            <p>Você precisa estar logado para adicionar ao seu carrinho.</p>
            <a href="<?= $loginPath ?>" class="login__register__item__desktop">logar</a>
            <a href="<?= $registerPath ?>" class="login__register__item__desktop register">criar uma conta</a>
            <i class="fas fa-times"></i>
        </div>

        <div class="cannot__add__more__container <?= $cannotAddMore ?> ">
            <p>Você não pode ter mais do que 9999 de um mesmo produto no seu carrinho.</p>
            <mark class="button">ok</mark>
        </div>

    <?php else : ?>

        <div class="product__not__found__container">
            <p class="not__found__message">Nenhum produto foi encontrado</p>
            <a href="<?= $userInterfacePath ?>" class="button">ir pra home</a>
        </div>

    <?php endif; ?>

</main>

<?php if ($productData) : ?>

    <script src="<?= $seeModeScript ?>"></script>

<?php endif; ?>

<?php

include("templates/head__foot/foot.php");
