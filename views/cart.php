<?php

session_start();

if (isset($_SESSION["adminUsing"])) {
    header("location: admin_index.php");
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

$model = "Carrinho";
$style = "../css/styles.css";
$normalizeCss = "../css/normalize.css";
$script = "../javascript/index.js";

$dataBaseConfigPath = "../configs/dataBaseConfig.php";
$classesPath = "../configs/classes.php";

$recommendationControllerPath = "../configs/recommendations_config.php";

$productsPath = "../index.php#recommendations";

$scrollHome = "../index.php";

require_once("../configs/cart_controller.php");

include("templates/head__foot/head.php");

$cartPath = "#";

$scrollRecommendations = "../index.php#recommendations";
$scrollFaqs = "../index.php#faqs";

$loginPath = "login.php";
$registerPath = "register.php";
$logOutPath = "../configs/log_out.php";

include("templates/header.php");

?>

<main class="main  cart__main">
    <h1>meu carrinho <i class="fas fa-bag-shopping"></i> </h1>

    <?php if ($userCart) : ?>

        <div class="final__price__container">
            <h2 class="final__price"> total: <mark><?= $finalPrice ?></mark> r$ </h2>
        </div>

        <section class="my__cart">


            <?php foreach ($userCart as $productData) : ?>

                <?php

                $productInformations = DataBase::getProductById($productData["productId"]);

                ?>

                <div class="cart__product__container">
                    <div class="product__image__name__container">

                        <div class="cart__product__image__container">
                            <img src="../images/<?= $productInformations["image"] ?>" alt="">

                        </div>
                        <div class="cart__product__informations" method="POST">
                            <h2> <?= $productInformations["name"] ?> </h2>
                            <mark class="price"><?= $productInformations["price"] ?> r$</mark>
                        </div>
                    </div>
                    <form action="" method="POST" class="prices__information">
                        <div class="quantity__container">
                            <label>quantity</label>
                            <div class="change__quantity">


                                <i class="fa-solid fa-circle-minus"></i>

                                <input type="number" readonly name="quantity" class="quantities" value="<?= $productData["amount"] ?>">
                                <i class="fa-solid fa-circle-plus"></i>
                            </div>

                        </div>
                        <div class="cart__total__container">
                            <label>total</label>
                            <input type="text" readonly class="totals" name="total" value="<?= $productData["total"] ?>">
                        </div>

                        <div class="prices__informations__button__container">
                            <div class="save__changes__container">
                                <button type="submit" name="save">salvar</button>

                            </div>
                            <button class="open__delete__container" type="button">deletar</button>
                        </div>
                        <div class="confirm__deletation__container">
                            <div class="confirm__deletation__informations__container ">

                                <h2>Vocês tem certeza que quer remover o produto <mark>
                                        <?= $productInformations["name"] ?>
                                    </mark> do seu carrinho?
                                </h2>
                                <div class="confirm__deletation">
                                    <mark> não remover </mark>
                                    <input type="hidden" name="product__to__be__removed" value="<?= $productData["id"] ?>">
                                    <button type="submit" name="remove__product" class="button__to__remove__product">remover produto</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            <?php endforeach; ?>

        </section>


    <?php else : ?>
        <section class="no__product__cart">
            <h2>O seu carrinho está vazio <i class="fa-solid fa-heart-crack"></i> </h2>
            <a href="<?= $productsPath ?>" class="button">ver produtos <i class="fa-solid fa-heart-circle-plus"></i></a>

        </section>

    <?php endif; ?>

</main>

<?php

include("templates/head__foot/foot.php");
