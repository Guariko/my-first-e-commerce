# my-first-e-commerce

I've coded this e-commerce website to practice my php skills. The design was made by me.
I'm not a designer so it may not be that good. You can apply all the changes that you want to. 
Also, all the content in this project has been written in brazillian protuguese because I've built it for a brazillian friend of mine,
but all the source code in writting in english.

You can check out the project in this link -> http://notmart.great-site.net/
The admin account is login: creatingsomething2021@gmail.com password: testing1

You're allow to download and use the code.

If you do so, you have to set up your database in configs/dataBaseConfig.php
and also set up your database in configs/classes.php on the method dataBaseConnection. 

After that you have to create the following tables and columns in your database.

Table: recommendations
Columns:
id int AI PK 
name varchar(250) 
genre varchar(45) 
content varchar(3000) 
datetime varchar(45) 
image varchar(250) 
price varchar(20)

Table: faqs
Columns:
id int AI PK 
question varchar(1000) 
answer varchar(1000)

Table: clients
Columns:
id int AI PK 
email varchar(250) 
name varchar(250) 
datetime varchar(45) 
password varchar(250)

Table: carts
Columns:
id int AI PK 
product varchar(250) 
amount int 
total varchar(45) 
datetime varchar(45) 
clientId varchar(250) 
productId int

Feel free to change all of the tables, but if you do so, you have to change their names at configs/classes.php.
Here you will find all the methods that I've used to work with the database.

The last thing but not least is the email sending. 

at configs/contact_controller.php you will find the configuration that I've used to send emails. You can change and place all of your informations
in the if (isset($_POST["send__question"])) statement.

If you have any question let me know.

