<?php

require_once($dataBaseConfigPath);
require_once($classesPath);


DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$productData = DataBase::getProductById($productId);

$productName = $productData["name"];

$cartData = [];

$addedToCart = "";

$maxNumberOfProducts = 9999;
$cannotAddMore = null;

if (isset($_SESSION["userLogged"])) {
    $checkUserLogged = $_SESSION["userLogged"];
} else {
    $checkUserLogged = false;
}

if (isset($_POST["add__to__cart"])) {

    if (isset($_SESSION["userId"])) {

        $userId = $_SESSION["userId"];
    }

    $currentAmount = DataBase::getProductAmount($userId, $productId);

    $currentAmount = $currentAmount["amount"];

    $amount = filter_input(INPUT_POST, "amount", FILTER_VALIDATE_INT);
    $total = strip_tags($_POST["total"]);

    if (!(($currentAmount + $amount) > $maxNumberOfProducts)) {
        if (DataBase::cartHasProduct($productId, $userId)) {
            $cartData = DataBase::getOneProductCartData($userId, $productId);

            $priceData = $productData["price"];
            $priceData = str_replace(",", ".", $priceData);
            $priceData = floatval($priceData);

            $cartData["amount"] = ($cartData["amount"]) + $amount;
            $cartData["total"] = $cartData["amount"] *  $priceData;

            $cartData["total"] = str_replace(".", ",", $cartData["total"]);
            if (!strpos($cartData["total"], ",")) {
                $cartData["total"] .= ",00";
            }

            DataBase::updateCart($userId, $cartData);
            $addedToCart = "added";
        } else {
            $cartData["productId"] = $productId;
            $cartData["amount"] = $amount;
            $cartData["total"] = $total;
            $cartData["product"] = $productName;

            DataBase::createUserCart($userId, $cartData);
            $addedToCart = "added";
        }
    } else {
        $cannotAddMore = "active";
    }
}

if (isset($_POST["buy__now"])) {
    header("location: $homePath#recommendations");
}

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
