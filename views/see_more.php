<?php

session_start();

// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1)) {
//     // request 30 minates ago
//     session_unset();
//     session_destroy();
// }


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
$scrollTestimonial = "$userInterfacePath#testimonial";

$cartPath = "cart.php";

include("templates/header.php");

$dataBaseConfigPath = "../configs/dataBaseConfig.php";
$classesPath = "../configs/classes.php";

$homePath = "../index.php";
require_once("../configs/see_more_controller.php");

?>

<main class="see__more__main main">

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
                        <button class="button cart " type="submit" name="add__to__cart">adicinar ao carrinho <i class="fa-solid fa-cart-shopping"></i>
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                        <button type="submit" name="buy__now" class="button">comprar agora</button>
                    </div>
                </form>
            </div>

        </div>


    </div>

</main>

<script src="<?= $seeModeScript ?>"></script>

<?php

include("templates/head__foot/foot.php");
