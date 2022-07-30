<?php

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
    $userCart = DataBase::getUserCart($userId);
    $finalPrice = 0;

    foreach ($userCart as $cartData) {
        $productToCheckData = DataBase::getProductById($cartData["productId"]);

        if (!$productToCheckData) {
            DataBase::deleteFromCart($cartData["id"]);
        } else {
            $currentAmount = $cartData["amount"];
            $currentTotal = $cartData["total"];
            $currentTotal = floatval(str_replace(",", ".", $currentTotal));

            $newTotal = $currentAmount * floatval(str_replace(",", ".", $productToCheckData["price"]));

            if ($currentTotal !== $newTotal) {
                $newTotal = strval(str_replace(".", ",", $newTotal));
                if (!strpos($newTotal, ",")) {
                    $newTotal .= ",00";
                }
                DataBase::updateTotalCart($cartData["id"], $newTotal);
            }
        }
    }

    $userCart = DataBase::getUserCart($userId);

    foreach ($userCart as $cartData) {
        $totalValue =  str_replace(",", ".", $cartData["total"]);
        $totalValue = floatval($totalValue);
        $finalPrice += $totalValue;
    }

    $finalPrice = strval($finalPrice);
    $finalPrice = str_replace(".", ",", $finalPrice);
    if (!strpos($finalPrice, ",")) {
        $finalPrice .= ",00";
    }
} else {
    $userCart = false;
}

if (isset($_POST["remove__product"])) {

    $finalPrice = 0;

    $productId = filter_input(INPUT_POST, "product__to__be__removed", FILTER_VALIDATE_INT);

    DataBase::deleteFromCart($productId);
    $userCart = DataBase::getUserCart($userId);

    foreach ($userCart as $cartData) {
        $productToCheckData = DataBase::getProductById($cartData["productId"]);

        if (!$productToCheckData) {
            DataBase::deleteFromCart($cartData["id"]);
        } else {
            $currentAmount = $cartData["amount"];
            $currentTotal = $cartData["total"];
            $currentTotal = floatval(str_replace(",", ".", $currentTotal));

            $newTotal = $currentAmount * floatval(str_replace(",", ".", $productToCheckData["price"]));

            if ($currentTotal !== $newTotal) {
                $newTotal = strval(str_replace(".", ",", $newTotal));
                if (!strpos($newTotal, ",")) {
                    $newTotal .= ",00";
                }
                DataBase::updateTotalCart($cartData["id"], $newTotal);
            }
        }
    }


    $userCart = DataBase::getUserCart($userId);

    foreach ($userCart as $cartData) {
        $totalValue =  str_replace(",", ".", $cartData["total"]);
        $totalValue = floatval($totalValue);
        $finalPrice += $totalValue;
    }

    $finalPrice = strval($finalPrice);
    $finalPrice = str_replace(".", ",", $finalPrice);
    if (!strpos($finalPrice, ",")) {
        $finalPrice .= ",00";
    }
}

if (isset($_GET["searching"])) {

    if (isset($_GET["searching__for"])) {

        if (strlen(strip_tags($_GET["searching__for"])) > 0) {

            $searchingFor = strip_tags($_GET["searching__for"]);
            $_SESSION["searchForValue"] = $searchingFor;

            $allRecommendations = DataBase::getProductByName($searchingFor);
            $_SESSION["allRecommendations"] = $allRecommendations;
            header("location: $scrollHome#recommendations");
        } else {
            unset($_SESSION["searchForValue"]);
            unset($_SESSION["allRecommendations"]);
            header("location: $scrollHome#recommendations");
        }
    }
}

if (isset($_POST["save"])) {
    $idProductToBeUpdated = $_POST["product__to__be__removed"];
    $cartDataUpdate = [];
    $cartDataUpdate["total"] = $_POST["total"];
    $cartDataUpdate["amount"] = $_POST["quantity"];

    DataBase::updateCartUsingCartId($idProductToBeUpdated, $cartDataUpdate);

    $finalPrice = 0;

    $userCart = DataBase::getUserCart($userId);

    foreach ($userCart as $cartData) {
        $productToCheckData = DataBase::getProductById($cartData["productId"]);

        if (!$productToCheckData) {
            DataBase::deleteFromCart($cartData["id"]);
        } else {
            $currentAmount = $cartData["amount"];
            $currentTotal = $cartData["total"];
            $currentTotal = floatval(str_replace(",", ".", $currentTotal));

            $newTotal = $currentAmount * floatval(str_replace(",", ".", $productToCheckData["price"]));

            if ($currentTotal !== $newTotal) {
                $newTotal = strval(str_replace(".", ",", $newTotal));
                if (!strpos($newTotal, ",")) {
                    $newTotal .= ",00";
                }
                DataBase::updateTotalCart($cartData["id"], $newTotal);
            }
        }
    }


    $userCart = DataBase::getUserCart($userId);

    foreach ($userCart as $cartData) {
        $totalValue =  str_replace(",", ".", $cartData["total"]);
        $totalValue = floatval($totalValue);
        $finalPrice += $totalValue;
    }

    $finalPrice = strval($finalPrice);
    $finalPrice = str_replace(".", ",", $finalPrice);
    if (!strpos($finalPrice, ",")) {
        $finalPrice .= ",00";
    }
}
