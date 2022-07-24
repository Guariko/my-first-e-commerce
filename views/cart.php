<?php

session_start();

$model = "Carrinho";
$style = "../css/styles.css";
$normalizeCss = "../css/normalize.css";
$script = "../javascript/index.js";

$dataBaseConfigPath = "../configs/dataBaseConfig.php";
$classesPath = "../configs/classes.php";

require_once("../configs/cart_controller.php");

include("templates/head__foot/head.php");

$cartPath = "#";

include("templates/header.php");

?>

<main class="main  cart__main">
    <h1>meu carrinho <i class="fas fa-bag-shopping"></i> </h1>

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
                        <label for="quantity">quantify</label>
                        <div class="change__quantity">

                            <i class="fa-solid fa-circle-minus"></i>

                            <input type="number" readonly id="quantity" name="quantify" value="<?= $productData["amount"] ?>">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>

                    </div>
                    <div class="cart__total__container">
                        <label for="total">total</label>
                        <input type="text" readonly id="total" name="total" value="<?= $productData["total"] ?>">
                    </div>
                    <div class="prices__informations__button__container">
                        <button type="submit" name="remove__product">deletar</button>
                    </div>
                </form>
            </div>

        <?php endforeach; ?>

    </section>

</main>

<?php

include("templates/head__foot/foot.php");
