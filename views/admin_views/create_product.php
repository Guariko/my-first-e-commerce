<?php

session_start();

if (!isset($_SESSION["adminUsing"])) {
    header("location: ../../index.php");
}


$model = "Criar novo Produto";
$style = "../../css/admin_styles.css";
$normalizeCss = "../../css/normalize.css";
$homeLocation = "../admin_index.php";

$imagesFolderPath = "../../images/";

require_once("../../configs/classes.php");
require_once("../../configs/dataBaseConfig.php");


include("../templates/head__foot/head.php");

require_once("../../configs/create_product_configs.php");

?>

<main class="create__edit__main">

    <div class="product__image__container">

        <img src="<?= $imagesFolderPath . $imageName ?>" alt="">

        <form action="" method="POST" class="product__image__buttons" enctype="multipart/form-data">
            <label for="product__image__file">escolher imagem</label>
            <input type="file" name="image" id="product__image__file" accept="image/*" value="<?= $imageValue ?>">
            <button type="submit" class="button" name="update__image">atualizar imagem</button>
            <p class="error__message <?= $productImageError ?>"><?= $productImageErrorMessage ?></p>
        </form>



    </div>

    <form action="" method="POST" class="create__edit__form">

        <?php if (isset($productData["image"])) : ?>

            <input type="hidden" value="<?= $productData["image"] ?>" name="product__image">

        <?php endif; ?>


        <div class="product__informations__container">
            <div class="product__input__container">
                <label for="name">nome do produto</label>
                <input type="text" name="name" id="name" autocomplete="off" value="<?= $productNameValue ?>">
                <p class="error__message <?= $productNameError ?>"><?= $productNameErrorMessage ?></p>
            </div>

            <div class="product__input__container">
                <label for="content">descrição do produto</label>
                <textarea name="content" id="content" cols="30" rows="10" autocomplete="off"><?= $productContentValue ?></textarea>
                <p class="error__message <?= $productContentError ?>"><?= $productContentErrorMessage ?></p>
            </div>

            <div class="product__input__container">
                <label for="price">preço</label>
                <input type="text" name="price" id="price" autocomplete="off" value="<?= $productPriceValue ?>">
                <p class="error__message <?= $productPriceError ?>"><?= $productPriceErrorMessage ?></p>
            </div>

            <div class="product__input__container">
                <h2>O produto é destinado para: </h2>

                <div class="product__choices__container">
                    <div>

                        <input type="radio" value="men" name="genre" id="men" autocomplete="off" <?= $menSelected ?>>
                        <label for="men">homens</label>
                    </div>

                    <div>

                        <input type="radio" value="women" name="genre" id="women" autocomplete="off" <?= $womenSelected ?>>
                        <label for="women">mulheres</label>
                    </div>

                    <div>
                        <input type="radio" value="children" name="genre" id="children" autocomplete="off" <?= $childrenSelected ?>>
                        <label for="children">crianças</label>
                    </div>

                </div>
                <p class="error__message <?= $productGenreError ?>"><?= $productGenreErrorMessage ?></p>

            </div>

        </div>

        <div class="button__container">
            <button class="button" type="submit" name="create__product">criar produto</button>
        </div>

    </form>



</main>

<?php

include("../templates/head__foot/foot.php");
