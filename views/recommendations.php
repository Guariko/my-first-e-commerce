<?php

if (!isset($recommendationConfigPath) || !isset($imagesPath)) {
    die;
}

require_once($recommendationConfigPath);

if (isset($_SESSION["allRecommendations"])) {
    $allRecommendations = $_SESSION["allRecommendations"];
}

?>

<?php if (isset($allRecommendations) && count($allRecommendations) > 0) : ?>

    <section class="recommendations" id="recommendations">

        <?php

        foreach ($allRecommendations as $recommendation) :   ?>


            <div class="recommendation">
                <div class="recommendation__new__container">
                    <h3 class="recommendation__new">
                        novo
                    </h3>
                </div>

                <div class="recommendation__image__container">
                    <img class="recommendation__image" src="<?= $imagesPath . $recommendation["image"] ?>" alt="">
                </div>

                <div class="recommendation__informations">

                    <div class="recommendation__title__container">
                        <h2 class="recommendation__title"> <?= $recommendation["name"] ?> </h2>
                    </div>

                </div>

                <div class="price__stars__container">

                    <div class="recommendation__stars__container">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="recommendation__content__container">
                        <mark class="recommendation__price">
                            <?= $recommendation["price"] ?> r$
                        </mark>
                    </div>
                </div>

                <div class="recommendation__button__container">
                    <a class="button" href="<?= $seeMoreOrEdit ?>?id=<?= $recommendation["id"] ?>"><?= $recommendation__button__content ?></a>
                    <?php if ($recommendation__button__content === "editar") : ?>
                        <a href="<?= $deleteView ?>?id=<?= $recommendation["id"] ?>" class="button">deletar</a>



                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; ?>

    </section>

<?php endif; ?>

<?php

if (count($allRecommendations) === 0) : ?>

    <section class="no__product__found" id="recommendations">
        <p>Nenhum produto foi encontrado</p>
    </section>

<?php endif; ?>

<!-- <pre>
    <?php

    if (isset($allRecommendations)) {

        print_r($allRecommendations);
    }
    ?>
</pre> -->