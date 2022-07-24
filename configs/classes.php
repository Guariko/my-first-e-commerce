<?php

class DataBaseClass
{

    public function __construct($dataBaseConnection)
    {
        $this->dataBaseConnection = $dataBaseConnection;
    }

    private function dataBaseConnection()
    {
        $userName = "root";
        $userPassword = "fisscomS1000";

        try {
            $dataBaseConnection =  new PDO($this->dataBaseConnection, $userName, $userPassword);
        } catch (PDOException $e) {
            return false;
        }

        return $dataBaseConnection;
    }

    public function getAllRecommendations()
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT id, name, image, price FROM recommendations";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute();

        return $smt->fetchAll();
    }

    public function getProductByName($productName)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return [];
        }

        $sql = "SELECT id, name, image, price FROM recommendations WHERE name REGEXP(:productName)";

        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":productName" => $productName,
        ]);

        return $smt->fetchAll();
    }

    public function createProduct($productData)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return "There was an error";
        }

        $sql = "INSERT INTO recommendations(name, genre, content, datetime, price, image)
                VALUES (:name, :genre, :content, now(), :price, :image)";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":name" => $productData["name"],
            ":genre" => $productData["genre"],
            ":content" => $productData["content"],
            ":price" => $productData["price"],
            ":image" => $productData["image"],
        ]);
    }

    public function updateProduct($productData, $id)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return "There was an error";
        }

        $sql = "UPDATE recommendations
                SET name = :name, genre = :genre, content = :content, datetime = now(), image = :image, price = :price
                WHERE id = :id";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":name" => $productData["name"],
            ":genre" => $productData["genre"],
            ":content" => $productData["content"],
            ":price" => $productData["price"],
            ":image" => $productData["image"],
            ":id" => $id,
        ]);
    }

    public function getProductById($id)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return [];
        }

        $sql = "SELECT name, genre, content, image, price FROM recommendations WHERE id LIKE (:id)";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":id" => $id,
        ]);

        return $smt->fetch();
    }

    public function deleteProduct($id)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return "There was an error";
        }

        $sql = "DELETE FROM recommendations WHERE id LIKE (:id)";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":id" => $id,
        ]);
    }

    public function createUser($userData)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "INSERT INTO clients(email, name, password, datetime)
                VALUES (:email, :name, :password, now())";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":email" => $userData["email"],
            ":name" => $userData["name"],
            ":password" => $userData["password"],
        ]);
    }

    public function emailAvaliable($email)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT email FROM clients WHERE email LIKE :email";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            "email" => $email,
        ]);

        $userEmail = $smt->fetch();

        if (!$userEmail) {
            return true;
        }

        return false;
    }

    public function selectUserPasswordByEmail($email)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT password FROM clients WHERE email LIKE :email";
        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":email" => $email,
        ]);

        return $smt->fetch()["password"];
    }

    public function getFaqs()
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT id, question, answer FROM faqs";

        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute();

        return $smt->fetchAll();
    }

    public function createFaq($faqData)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "INSERT INTO faqs(question, answer) VALUES (:question, :answer)";

        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":question" => $faqData["question"],
            ":answer" => $faqData["answer"],
        ]);
    }

    public function getFaqDataById($id)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT question, answer FROM faqs WHERE id LIKE :id";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":id" => $id,
        ]);

        return $smt->fetch();
    }

    public function deleteFaq($id)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "DELETE FROM faqs WHERE id LIKE :id";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":id" => $id,
        ]);
    }

    function createUserCart($clientId, $cartData)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "INSERT INTO carts(clientId, product, amount, total, datetime, productId) 
                VALUES(:clientId, :product, :amount, :total, now(), :productId)";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":clientId" => $clientId,
            ":product" => $cartData["product"],
            ":amount" => $cartData["amount"],
            ":total" => $cartData["total"],
            ":productId" => $cartData["productId"],
        ]);
    }

    public function getUserId($email)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT id FROM clients WHERE email LIKE :email";
        $smt = $dataBaseConnection->prepare($sql);
        $smt->execute([
            ":email" => $email,
        ]);

        return $smt->fetch()["id"];
    }

    public function cartHasProduct($productId, $userId)
    {
        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT product FROM carts WHERE productId LIKE :productId AND clientId LIKE :userId";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":productId" => $productId,
            "userId" => $userId,
        ]);

        if ($smt->fetch()) {
            return true;
        }

        return false;
    }

    public function updateCart($clientId, $cartData)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "UPDATE carts SET amount = :amount, total = :total, datetime = now() WHERE clientId LIKE :clientId
        AND productId LIKE :productId";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":amount" => $cartData["amount"],
            ":total" => $cartData["total"],
            ":clientId" => $clientId,
            ":productId" => $cartData["productId"],
        ]);
    }

    public function getOneProductCartData($clientId, $productId)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT * FROM carts WHERE productId LIKE :productId AND clientId LIKE :clientId";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":productId" => $productId,
            ":clientId" => $clientId,
        ]);

        return $smt->fetch();
    }

    public function getUserCart($id)
    {

        $dataBaseConnection = $this->dataBaseConnection();

        if (!$dataBaseConnection) {
            return false;
        }

        $sql = "SELECT * FROM carts WHERE clientId LIKE :id";
        $smt = $dataBaseConnection->prepare($sql);

        $smt->execute([
            ":id" => $id,
        ]);

        return $smt->fetchAll();
    }
}

class DataBase
{

    static private $dataBase;

    static public function initialize(DataBaseClass $dataBaseObject)
    {
        return self::$dataBase = $dataBaseObject;
    }

    static public function getAllRecommendations()
    {

        return self::$dataBase->getAllRecommendations();
    }

    static public function getProductByName($productName)
    {

        return self::$dataBase->getProductByName($productName);
    }

    static public function createProduct($productData)
    {
        return self::$dataBase->createProduct($productData);
    }

    static public function getProductById($id)
    {
        return self::$dataBase->getProductById($id);
    }

    static public function updateProduct($productData, $id)
    {
        return self::$dataBase->updateProduct($productData, $id);
    }

    static public function deleteProduct($id)
    {
        return self::$dataBase->deleteProduct($id);
    }

    static public function createUser($userData)
    {

        return self::$dataBase->createUser($userData);
    }

    static public function emailAvaliable($email)
    {
        return self::$dataBase->emailAvaliable($email);
    }

    static public function selectUserPasswordByEmail($email)
    {
        return self::$dataBase->selectUserPasswordByEmail($email);
    }

    static public function getFaqs()
    {
        return self::$dataBase->getFaqs();
    }

    static public function createFaq($faqData)
    {
        return self::$dataBase->createFaq($faqData);
    }

    static public function getFaqDataById($id)
    {
        return self::$dataBase->getFaqDataById($id);
    }

    static public function deleteFaq($id)
    {
        return self::$dataBase->deleteFaq($id);
    }

    static public function getUserId($email)
    {
        return self::$dataBase->getUserId($email);
    }

    static public function cartHasProduct($productId, $userId)
    {
        return self::$dataBase->cartHasProduct($productId, $userId);
    }

    static public function createUserCart($clientId, $cartData)
    {
        return self::$dataBase->createUserCart($clientId, $cartData);
    }

    static public function updateCart($clientId, $cartData)
    {
        return self::$dataBase->updateCart($clientId, $cartData);
    }

    static public function getOneProductCartData($clientId, $productId)
    {
        return self::$dataBase->getOneProductCartData($clientId, $productId);
    }

    static public function getUserCart($id)
    {
        return self::$dataBase->getUserCart($id);
    }
}
