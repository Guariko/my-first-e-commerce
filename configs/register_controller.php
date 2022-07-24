<?php

if (!isset($classesPath)) {
    die();
}

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

if (isset($_POST["register"])) {

    $isEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $name = strip_tags($_POST["name"]);
    $password = strip_tags($_POST["password"]);
    $userData = [];

    if (!$isEmail) {
        $emailError = "emailError";
        $emailErrorMessage = "Por favor, insire um email válido";
    }

    if (strlen($name) < 2) {
        $nameError = "nameError";
        $nameErrorMessage = "O nome tem que ter pelo menos 2 characters";
    }

    if (strlen($password) < 8) {
        $passwordError = "passwordError";
        $passwordErrorMessage = "A senha tem que ter pelo menos 8 characters";
    }

    if ($isEmail) {
        $emailValue = $isEmail;
    }

    if (strlen($name) >= 2) {
        $nameValue = $name;
    }

    if ($isEmail && strlen($password) >= 8 && strlen($name) >= 2) {

        if (DataBase::emailAvaliable($isEmail)) {

            $userData["name"] = $name;
            $userData["email"] = $isEmail;
            $userData["password"] = $password;

            DataBase::createUser($userData);
            header("location: $loginPath");
        } else {
            $emailError = "emailError";
            $emailErrorMessage = "Desculpe, mas esse email já está em uso.";
        }
    }
}
