<?php

if (!isset($dataBaseConfigPath) || !isset($classesPath) || !isset($homePath)) {

    die();
}


require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));



if (isset($_GET["searching"])) {

    if (isset($_GET["searching__for"])) {

        if (strlen(strip_tags($_GET["searching__for"])) > 0) {

            $searchingFor = strip_tags($_GET["searching__for"]);
            $_SESSION["searchForValue"] = $searchingFor;

            $allRecommendations = DataBase::getProductByName($searchingFor);
            $_SESSION["allRecommendations"] = $allRecommendations;
            header("location: $homePath#recommendations");
        } else {
            unset($_SESSION["searchForValue"]);
            unset($_SESSION["allRecommendations"]);
            header("location: $homePath#recommendations");
        }
    }
}

if (!isset($_GET["searching"])) {
    $allRecommendations = DataBase::getAllRecommendations();
}
