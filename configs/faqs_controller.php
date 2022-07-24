<?php

require_once($dataBaseConfigPath);
require_once($classesPath);

DataBase::initialize(new DataBaseClass($dataBaseConnection));

$faqsData = DataBase::getFaqs();
