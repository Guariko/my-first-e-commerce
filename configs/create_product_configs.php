<?php

if (!isset($imagesFolderPath)) {
    die();
}

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productData = [];
$imageName = "image.jpg";

if (isset($_SESSION["imageValue"])) {
    $imageName = $_SESSION["imageValue"];
    $productData["image"] = $imageName;
}

$minProductNameLength = 5;
$maxProductNameLength = 50;
$minProductContentLength = 10;
$maxProductContentLength = 1000;
$minPriceLength = 1;
$maxPriceLegth = 7;
$maxDecimalsLength = 2;

$productNameError = null;
$productContentError = null;
$productGenreError = null;
$productPriceError = null;
$productImageError = null;

$productNameErrorMessage = null;
$productContentErrorMessage = null;
$productPriceErrorMessage = null;
$productGenreErrorMessage = null;
$productImageErrorMessage = null;

$productNameValue = null;
$productContentValue = null;
$productPriceValue = null;
$menSelected = null;
$womenSelected = null;
$childrenSelected = null;

if (isset($_POST["update__image"])) {

    if (isset($_SESSION["productNameValue"])) {
        $productNameValue = $_SESSION["productNameValue"];
    }

    if (isset($_SESSION["productContentValue"])) {
        $productContentValue = $_SESSION["productContentValue"];
    }

    if (isset($_SESSION["productPriceValue"])) {
        $productPriceValue = $_SESSION["productPriceValue"];
    }

    if (isset($_SESSION["menSelected"])) {
        $menSelected =  $_SESSION["menSelected"];
    }

    if (isset($_SESSION["womenSelected"])) {
        $womenSelected = $_SESSION["womenSelected"];
    }

    if (isset($_SESSION["childrenSelected"])) {
        $childrenSelected = $_SESSION["childrenSelected"];
    }

    if ($_FILES['image']['name'] === "") {
        $productImageError = "active";
        $productImageErrorMessage = "Por favor, selecione uma imagem para o seu produto";
    } else {

        $productImage = $_FILES["image"]["name"];
        $imageTmpName = $_FILES["image"]["tmp_name"];
        $imageExtension = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));
        $newImageName = uniqid("IMG-", true) . "." . $imageExtension;
        $imageUploadPath = $imagesFolderPath . $newImageName;
        move_uploaded_file($imageTmpName, $imageUploadPath);

        $productData["image"] = $newImageName;

        $imageName = $productData["image"];
        $_SESSION["imageValue"] = $imageName;
    }
}

if (isset($_POST["create__product"])) {

    $error = false;

    $productName =  strip_tags($_POST["name"]);
    $productContent = strip_tags($_POST["content"]);
    $productPrice = strip_tags($_POST["price"]);

    if (strlen($productName) < $minProductNameLength) {
        $error = true;
        $productNameError = "active";
        $productNameErrorMessage = "O nome do produto tem que ter pelo menos 5 characters.";
        unset($_SESSION["productNameValue"]);
    }

    if (strlen($productName) > $maxProductNameLength) {
        $error = true;
        $productNameError = "active";
        $productNameErrorMessage = "O nome do produto não pode ter mais do que 50 characters.";
        unset($_SESSION["productNameValue"]);
    }

    if (strlen($productContent) < $minProductContentLength) {
        $error = true;
        $productContentError = "active";
        $productContentErrorMessage = "A descrição do produto tem que ter pelo menos 10 characters.";
        unset($_SESSION["productContentValue"]);
    }

    if (strlen($productContent) > $maxProductContentLength) {
        $error = true;
        $productContentError = "active";
        $productContentErrorMessage = "A descrição do produto não pode ter mais do que 1000 characters.";
        unset($_SESSION["productContentValue"]);
    }

    if (!isset($_POST["genre"])) {
        $error = true;
        $productGenreError = "active";
        $productGenreErrorMessage = "Por favor, selecione uma categoria para o seu produto.";
    }

    if (strlen($productPrice) < $minPriceLength) {
        $error = true;
        $productPriceError = "active";
        $productPriceErrorMessage = "O preço tem que ter pelo menos 1 character.";
        unset($_SESSION["productPriceValue"]);
    }

    if ($productPrice) {

        if (strpos($productPrice, ",")) {
            $productPrice = str_replace(",", ".", $productPrice);
        }

        if (!floatval($productPrice)) {
            $error = true;
            $productPriceError = "active";
            $productPriceErrorMessage = "O preço tem que ter ser um número válido.";
            unset($_SESSION["productPriceValue"]);
        } else {

            if (!strpos($productPrice, ".")) {
                $productPrice .= ",00";
            } else {
                $productPrice = str_replace(".", ",", $productPrice);
            }

            $priceArray = explode(",", $productPrice);
            $decimals = $priceArray[1];

            if (strlen($decimals) > $maxDecimalsLength) {
                $productPrice = "9999,9999";
            }
        }
    }

    if ($productPrice === "0" || $productPrice === 0) {
        $error = true;
        $productPriceError = "active";
        $productPriceErrorMessage = "O preço não pode ser 0.";
        unset($_SESSION["productPriceValue"]);
    }

    if (strlen($productPrice) > $maxPriceLegth) {
        $error = true;
        $productPriceError = "active";
        $productPriceErrorMessage = "O preço não pode ter mais do que 7 characters, sendo 2 deles decimais com uma virgula.";
        unset($_SESSION["productPriceValue"]);
    }

    if (!isset($_POST["product__image"])) {
        $error = true;
        $productImageError = "active";
        $productImageErrorMessage = "Por favor, selecione uma imagem para o seu produto";
    }

    if ($productNameError !== "active") {
        $productNameValue = $productName;
        $_SESSION["productNameValue"] = $productNameValue;
    }

    if ($productContentError !== "active") {
        $productContentValue = $productContent;
        $_SESSION["productContentValue"] = $productContentValue;
    }

    if ($productPriceError !== "active") {
        $productPriceValue = $productPrice;
        $_SESSION["productPriceValue"] = $productPriceValue;
    }

    if ($productGenreError !== "active") {
        if ($_POST["genre"] === "men") {
            $menSelected = "checked";
            $_SESSION["menSelected"] = $menSelected;
            unset($_SESSION["womenSelected"]);
            unset($_SESSION["childrenSelected"]);
        } else if ($_POST["genre"] === "women") {
            $womenSelected = "checked";
            $_SESSION["womenSelected"] = $womenSelected;
            unset($_SESSION["menSelected"]);
            unset($_SESSION["childrenSelected"]);
        } else {
            $childrenSelected = "checked";
            $_SESSION["childrenSelected"] = $childrenSelected;
            unset($_SESSION["womenSelected"]);
            unset($_SESSION["menSelected"]);
        }
    }

    if (!$error) {

        $productData["name"] = $productName;
        $productData["content"] = $productContent;
        $productData["genre"] = $_POST["genre"];
        $productData["price"] = $productPrice;
        $productData["image"] = $_POST["product__image"];

        DataBase::createProduct($productData);

        header("location: $homeLocation");
    }
}
