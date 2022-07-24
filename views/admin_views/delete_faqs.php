<?php

require_once("../../configs/classes.php");
require_once("../../configs/dataBaseConfig.php");

$model = "Deletar pergunta frequente";
$style = "../../css/styles.css";
$normalizeCss = "../../css/normalize.css";

include("../templates/head__foot/head.php");

$faqId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$faqData = DataBase::getFaqDataById($faqId);

if (isset($_POST["delete__faq"])) {
    DataBase::deleteFaq($faqId);
    header("location: ../admin_index.php");
}

?>

<main class="delete__main">
    <p>Você tem certeza que quer apagar a FAQ <br> <mark> <?= $faqData["question"]  ?>? </mark> </p>
    <div class="choose__delete">
        <a href="<?= "../admin_index.php" ?>">Não apagar</a>
        <form action="" method="POST">
            <button type="submit" name="delete__faq">Sim! delete essa FAQ</button>
        </form>
    </div>
</main>

<?php

include("../templates/head__foot/foot.php");
