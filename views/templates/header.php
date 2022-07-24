<?php

if (!isset($loginPath)) {
    $loginPath = "#";
}

if (!isset($registerPath)) {
    $registerPath = "#";
}

$searchedValue = "";

if (isset($_SESSION["searchForValue"])) {
    $searchedValue = $_SESSION["searchForValue"];
}

?>

<header class="header">

    <div class="search__nav__logo__container">

        <div class="logo__container">
            <mark class="logo"> luana </mark>
        </div>

        <form action="" class="search__here" method="GET">
            <input type="text" name="searching__for" placeholder="O que você está procurando?" value="<?= $searchedValue ?>">
            <button type="submit" name="searching"> <i class="fas fa-search"></i> </button>

        </form>

        <nav class="header__nav__bar__container__desktop">
            <ul class="header__nav__bar__desktop">
                <li>
                    <a class="header__nav__bar__item__desktop" href="<?= $scrollHome ?>">home</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__desktop" href="<?= $scrollRecommendations ?>">produtos</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__desktop" href="<?= $scrollFaqs ?>">dúvidas</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__desktop" href="<?= $scrollTestimonial ?>">tertimonial</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="header__bars">
        <i class="fas fa-bars"></i>
    </div>

    <div class="bars__informations">

        <nav class="header__nav__bar__container__mobile">
            <ul class="header__nav__bar__mobile">
                <li class="logo__container">
                    <mark class="logo">luana</mark>
                    <i class="fas fa-times"></i>
                </li>
                <li>
                    <a class="header__nav__bar__item__mobile" href="#">homens</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__mobile" href="#">mulhers</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__mobile" href="#">crianças</a>
                </li>
                <li>
                    <a class="header__nav__bar__item__mobile" href="#">sobre nós</a>
                </li>
            </ul>
        </nav>

        <nav class="login__register__nav__bar__container">

            <?php if (isset($_SESSION["userLogged"]) || isset($_SESSION["adminUsing"])) : ?>
                <ul class="login__register__nav__bar">

                    <li><a href="<?= $logOutPath ?>" class="login__register__item login">sair</a></li>
                </ul>

            <?php else : ?>

                <ul class="login__register__nav__bar">
                    <li><a href="<?= $registerPath ?>" class="login__register__item register">register</a></li>
                    <li><a href="<?= $loginPath ?>" class="login__register__item login">login</a></li>
                </ul>
            <?php endif; ?>

        </nav>
    </div>

</header>