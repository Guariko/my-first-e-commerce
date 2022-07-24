<?php

require_once("../../configs/classes.php");
require_once("../../configs/dataBaseConfig.php");

$model = "Deletar Produto";
$style = "../../css/styles.css";
$normalizeCss = "../../css/normalize.css";

include("../templates/head__foot/head.php");

$productId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productData = DataBase::getProductById($productId);

if (isset($_POST["delete__product"])) {
    DataBase::deleteProduct($productId);
    header("location: ../admin_index.php");
}

?>

<main class="delete__main">
    <p>Você tem certeza que quer apagar o produto <br> <mark> <?= $productData["name"]  ?>? </mark> </p>
    <div class="choose__delete">
        <a href="<?= "../admin_index.php" ?>">Não apagar</a>
        <form action="" method="POST">
            <button type="submit" name="delete__product">Sim! delete o produto</button>
        </form>
    </div>
</main>

<?php

include("../templates/head__foot/foot.php");
