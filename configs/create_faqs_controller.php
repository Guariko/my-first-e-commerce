<?php

if (!isset($dataBaseConnectionPath)) {
    die();
}

if (!isset($classesPath)) {
    die();
}

require_once($dataBaseConnectionPath);
require_once($classesPath);

$faqData = [];

$minLength = 10;
$maxLength = 1000;

$error = false;

DataBase::initialize(new DataBaseClass($dataBaseConnection));

if (isset($_POST["create__faq"])) {

    $question = strip_tags($_POST["question"]);
    $answer = strip_tags($_POST["answer"]);

    if (strlen(trim($question)) < $minLength) {
        $displayQuestionError = "active";
        $questionError = "A pergunta tem que ter pelo menos 10 characters.";
        $error = true;
    }

    if (strlen(trim($question)) > $maxLength) {
        $displayQuestionError = "active";
        $questionError = "A pergunta não pode ter mais de 1000 characters.";
        $error = true;
    }

    if (strlen(trim($answer)) < $minLength) {
        $displayAnswerError = "active";
        $answerError = "A resposta tem que ter pelo menos 10 characters.";
        $error = true;
    }

    if (strlen(trim($answer)) > $maxLength) {
        $displayAnswerError = "active";
        $answerError = "A resposta não pode ter mais de 1000 characters.";
        $error = true;
    }

    $questionValue =  trim($question);
    $answerValue = trim($answer);

    if (!$error) {

        $faqData["question"] = trim($question);
        $faqData["answer"] = trim($answer);

        DataBase::createFaq($faqData);

        header("location: $homePath");
    }
}
