<?php

session_start();


$_SESSION["cart"] = [];

$model = "Home";
$style = "css/styles.css";
$normalizeCss = "css/normalize.css";
$script = "javascript/index.js";
$loginPath = "views/login.php";
$registerPath = "views/register.php";
$logOutPath = "configs/log_out.php";

include("views/templates/head__foot/head.php");

$scrollHome = "#home";
$scrollRecommendations = "#recommendations";
$scrollFaqs = "#faqs";
$scrollTestimonial = "#testimonial";

$cartPath = "views/cart.php";

include("views/templates/header.php");
?>

<main class="main__recommendation main">

    <?php

    $recommendationConfigPath = "configs/recommendations_config.php";
    $dataBaseConfigPath = "configs/dataBaseConfig.php";
    $classesPath = "configs/classes.php";
    $imagesPath = "images/";
    $homePath = "index.php";
    $seeMoreOrEdit = "views/see_more.php";
    $recommendation__button__content = "vêr mais";

    include("views/hero.php");

    include("views/recommendations.php");

    $faqsControllerPath = "configs/faqs_controller.php";

    include("views/faqs.php");

    include("views/testimonial.php");
    ?>

</main>

<?php

include("views/templates/head__foot/foot.php");
