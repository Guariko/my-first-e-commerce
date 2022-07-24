<?php

if (!isset($imagesFolderPath)) {
    die();
}

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$productId = $_GET["id"];

$productData = DataBase::getProductById($productId);


if (isset($_POST["update__image"])) {

    $productImage = $_FILES["image"]["name"];
    $imageTmpName = $_FILES["image"]["tmp_name"];
    $imageExtension = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));
    $newImageName = uniqid("IMG-", true) . "." . $imageExtension;
    $imageUploadPath = $imagesFolderPath . $newImageName;
    move_uploaded_file($imageTmpName, $imageUploadPath);

    $productData["image"] = $newImageName;
}

if (isset($_POST["update__product"])) {

    $productData["name"] = $_POST["name"];
    $productData["content"] = $_POST["content"];
    $productData["genre"] = $_POST["genre"];
    $productData["price"] = $_POST["price"];
    $productData["image"] = $_POST["product__image"];


    DataBase::updateProduct($productData, $productId);

    header("location: $homeLocation");
}
