<?php

session_start();

unset($_SESSION["errorMessageEmail"]);
unset($_SESSION["errorMessageName"]);
unset($_SESSION["errorMessageSubject"]);
unset($_SESSION["contactUserName"]);
unset($_SESSION["contactUserSubject"]);
unset($_SESSION["contactUserEmail"]);
unset($_SESSION["displayMessageSent"]);
unset($_SESSION["productNameValue"]);
unset($_SESSION["productContentValue"]);
unset($_SESSION["productPriceValue"]);
unset($_SESSION["imageValue"]);

if (!isset($_SESSION["adminUsing"])) {
    header("location: ../index.php");
}

$model = "Admin";
$style = "../css/admin_styles.css";
$normalizeCss = "../css/normalize.css";
$script = "../javascript/index.js";
$adminScript = "../javascript/admin.js";
$loginPath = "login.php";
$registerPath = "register.php";

$adminUsing = true;

$logOutPath = "../configs/log_out.php";
$homePath = "admin_index.php";

$userInterfacePath = "../index.php";

$deleteFaqPath  = "admin_views/delete_faqs.php";

include("templates/head__foot/head.php");

$scrollHome = "$userInterfacePath#home";
$scrollRecommendations = "#recommendations";
$scrollFaqs = "#faqs";
$scrollTestimonial = "$userInterfacePath#testimonial";

$cartPath = "cart.php";

include("templates/header.php");

?>

<main class="main main__recommendation">

    <section class="admin__administration">

        <a href="<?= "admin_views/create_product.php" ?>" class="button"> criar novo produto </a>
        <a href="<?= "admin_views/create_faqs.php" ?>" class="button"> criar uma nova pergunta frequente. </a>

    </section>

    <?php

    $recommendationConfigPath = "../configs/recommendations_config.php";
    $dataBaseConfigPath = "../configs/dataBaseConfig.php";
    $classesPath = "../configs/classes.php";
    $imagesPath = "../images/";
    $seeMoreOrEdit = "admin_views/edit_product.php";
    $recommendation__button__content = "editar";
    $deleteView = "admin_views/delete_view.php";

    include("recommendations.php");

    $faqsControllerPath = "../configs/faqs_controller.php";
    include("faqs.php");

    ?>

</main>

<?php

include("templates/head__foot/foot.php");
