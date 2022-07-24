<?php

if (!isset($imagesPath)) {
    $imagesPath = "";
}

?>

<section class="hero" id="home">

    <div class="hero__image__container">
        <img src="<?= $imagesPath ?>hero.png" alt="">
    </div>

    <div class="hero__content">
        <h1>A pessoa que disse <br> <mark>dinheiro não traz felicidade</mark> <br> concerteza não sabe onde ir fazer compras.</h1>
        <a href="#recommendations" class="button">vêr produtos <i class="fas fa-arrow-down"></i> </a>
    </div>

</section>