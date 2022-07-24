<?php

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$userId = $_SESSION["userId"];

$userCart = DataBase::getUserCart($userId);
