<?php

if (!isset($classesPath)) {
    die();
}

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$adminEmail = "creatingsomething2021@gmail.com";

if (isset($_POST["login"])) {

    $isEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = strip_tags($_POST["password"]);

    if (!$isEmail || strlen($password) < 8) {
        $loginError = "loginError";
    }

    if ($isEmail && strlen($password) >= 8) {
        if (!DataBase::emailAvaliable($isEmail)) {

            $emailPassword = DataBase::selectUserPasswordByEmail($isEmail);

            if ($password === $emailPassword) {
                if ($isEmail === $adminEmail) {
                    $_SESSION["adminUsing"] = true;
                    header("location: $adminInterfacePath");
                    die();
                }
                $_SESSION["userLogged"] = true;
                $_SESSION["userId"] = DataBase::getUserId($isEmail);
                header("location: $homePath");
            } else {
                $loginError = "loginError";
            }
        }
    }
}
