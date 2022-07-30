<?php

require_once($contactControllerPath);

?>

<section class="contact" id="contact">

    <h2>Mais alguma dúvida? <br> Entre em contato com a gente! </h2>

    <div class="contact__container">


        <form action="" method="POST" class="contact__form">

            <div>
                <label for="name">nome</label>
                <input type="text" id="name" name="name" value="<?= $userName  ?>">
                <p class="error__message <?= $displayNameError ?>"><?= $errorMessageName ?></p>
            </div>

            <div>
                <label for="email">email</label>
                <input type="text" id="email" name="email" value="<?= $userEmail ?>">
                <p class="error__message <?= $displayEmailError ?> "><?= $errorMessageEmail ?></p>
            </div>

            <div>
                <label for="subject">sua dúvida</label>
                <textarea name="subject" id="subject" cols="30" rows="10" placeholder="Olá, eu gostaria de saber se ..."><?= $userSubject ?></textarea>
                <p class="error__message <?= $displaySubjectError ?>"><?= $errorMessageSubject ?></p>
            </div>

            <div class="contact__form__button__container">
                <button type="submit" class="button" name="send__question">enviar</button>
            </div>


        </form>

        <div class="message__sent__container <?= $displayMessageSent ?> ">
            <p class="message__sent">Sua mensagem foi enviada com sucesso.</p>
            <mark class="button ok "> ok </mark>
        </div>

    </div>


</section>