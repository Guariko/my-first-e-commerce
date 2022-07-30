<?php

if (!isset($imagesFolderPath)) {
    die();
}

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$productData = DataBase::getProductById($productId);


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

if (isset($_POST["update__image"])) {

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
    }
}

if (isset($_POST["update__product"])) {

    $error = false;

    $productName =  strip_tags($_POST["name"]);
    $productContent = strip_tags($_POST["content"]);
    $productPrice = strip_tags($_POST["price"]);

    if (strlen($productName) < $minProductNameLength) {
        $error = true;
        $productNameError = "active";
        $productNameErrorMessage = "O nome do produto tem que ter pelo menos 5 characters.";
    }

    if (strlen($productName) > $maxProductNameLength) {
        $error = true;
        $productNameError = "active";
        $productNameErrorMessage = "O nome do produto não pode ter mais do que 50 characters.";
    }

    if (strlen($productContent) < $minProductContentLength) {
        $error = true;
        $productContentError = "active";
        $productContentErrorMessage = "A descrição do produto tem que ter pelo menos 10 characters.";
    }

    if (strlen($productContent) > $maxProductContentLength) {
        $error = true;
        $productContentError = "active";
        $productContentErrorMessage = "A descrição do produto não pode ter mais do que 1000 characters.";
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
    }

    if ($productPrice) {

        if (strpos($productPrice, ",")) {
            $productPrice = str_replace(",", ".", $productPrice);
        }

        if (!floatval($productPrice)) {
            $error = true;
            $productPriceError = "active";
            $productPriceErrorMessage = "O preço tem que ter ser um número válido.";
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

    if (strlen($productPrice) > $maxPriceLegth) {
        $error = true;
        $productPriceError = "active";
        $productPriceErrorMessage = "O preço não pode ter mais do que 7 characters, sendo 2 deles decimais com uma virgula.";
    }

    if (!isset($_POST["product__image"])) {
        $error = true;
        $productImageError = "active";
        $productImageErrorMessage = "Por favor, selecione uma imagem para o seu produto";
    }

    if (!$error) {

        $productData["name"] = $productName;
        $productData["content"] = $productContent;
        $productData["genre"] = $_POST["genre"];
        $productData["price"] = $productPrice;
        $productData["image"] = $_POST["product__image"];

        DataBase::updateProduct($productData, $productId);

        header("location: $homeLocation");
    }
}
