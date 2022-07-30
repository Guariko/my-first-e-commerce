<?php

require_once($faqsControllerPath);

if (!isset($faqsData)) {
    die();
}


?>

<section class="faqs__section" id="faqs">


    <header class="faqs__header">
        <h2>dúvidas <br> frequentes</h2>
    </header>

    <main class="faqs">

        <?php foreach ($faqsData as $faqData) : ?>

            <div class="faq">
                <div class="question__container">
                    <h3 class="question"> <?= $faqData["question"] ?> </h3>
                    <i class="fa-solid fa-caret-down"></i>
                    <i class="fa-solid fa-caret-up"></i>
                </div>
                <p class="answer"> <?= $faqData["answer"] ?>
                    <?php
                    if (isset($adminUsing)) : ?>
                <div class="delete__faq__button__container">
                    <a href="<?= $deleteFaqPath ?>?id=<?= $faqData["id"] ?>" class="button">deletar</a>
                </div>

            <?php endif; ?>
            </p>
            </div>

        <?php endforeach; ?>

    </main>


</section>