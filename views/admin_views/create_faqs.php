<?php

$model = "Criar pergunta frequênte";
$style = "../../css/admin_styles.css";
$normalizeCss = "../../css/normalize.css";

$dataBaseConnectionPath = "../../configs/dataBaseConfig.php";
$classesPath = "../../configs/classes.php";

$homePath = "../admin_index.php";

$displayQuestionError = "";
$questionError = "";

$displayAnswerError = "";
$answerError = "";

$questionValue = "";
$answerValue = "";

require_once("../../configs/create_faqs_controller.php");

include("../templates/head__foot/head.php");

?>

<main class="create__faqs__main">

    <h1>Crie uma pergunta frequente</h1>

    <form action="" method="POST">

        <div>
            <textarea name="question" cols="30" rows="10" placeholder="pergunta"> <?= $questionValue ?> </textarea>
            <p class="error <?= $displayQuestionError ?> "><?= $questionError ?></p>
        </div>

        <div>
            <textarea name="answer" cols="30" rows="10" placeholder="resposta"> <?= $answerValue ?> </textarea>
            <p class="error <?= $displayAnswerError ?> "><?= $answerError ?></p>
        </div>

        <div class="buttons__container">

            <button class="button" type="submit" name="create__faq">pronto</button>
            <a class="button" href="#">voltar</a>
        </div>
    </form>

</main>

<?php

include("../templates/head__foot/foot.php");
