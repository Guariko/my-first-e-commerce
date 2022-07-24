<?php

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$productData = DataBase::getProductById($productId);

$productName = $productData["name"];

$cartData = [];

$addedToCart = "";

if (isset($_POST["add__to__cart"])) {

    if (isset($_SESSION["userId"])) {

        $userId = $_SESSION["userId"];
    }

    $amount = filter_input(INPUT_POST, "amount", FILTER_VALIDATE_INT);
    $total = strip_tags($_POST["total"]);



    if (DataBase::cartHasProduct($productId, $userId)) {
        $cartData = DataBase::getOneProductCartData($userId, $productId);

        $priceData = $productData["price"];
        $priceData = str_replace(",", ".", $priceData);
        $priceData = floatval($priceData);

        $cartData["amount"] = ($cartData["amount"]) + $amount;
        $cartData["total"] = $cartData["amount"] *  $priceData;

        $cartData["total"] = str_replace(".", ",", $cartData["total"]);

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
}

if (isset($_POST["buy__now"])) {
    header("location: $homePath#recommendations");
}
