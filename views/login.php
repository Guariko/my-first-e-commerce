<?php

session_start();

$model = "Login";
$style = "../css/login_register.css";
$normalizeCss = "../css/normalize.css";
$script = "../javascript/login_register.js";
$registerPath = "register.php";

include("templates/head__foot/head.php");

$classesPath = "../configs/classes.php";
$dataBaseConfigPath = "../configs/dataBaseConfig.php";

$loginError = "";
$homePath = "../index.php";
$adminInterfacePath = "admin_index.php";

require_once("../configs/login_controller.php");

?>

<main class="login__register__main">

    <div class="form__container">

        <div class="logo__container">
            <mark class="logo">login</mark>
        </div>

        <form action="" method="POST" class="login__register__form">
            <div class="login__register__input__container">
                <input type="text" maxlength="300" name="email" placeholder="email" class="not__password">
            </div>

            <div class="login__register__input__container">
                <input type="password" maxlength="300" name="password" placeholder="senha" id="password">
                <i class="fas fa-eye "></i>
                <i class="fa-solid fa-eye-slash active"></i>
            </div>
            <p class="error__message <?= $loginError ?> ">Email ou senha inválidos.</p>
            <div class="button__container">
                <button type="submit" name="login">logar</button>
            </div>
        </form>

        <div class="redirect__container">
            <p>Ainda não tem uma conta? <a href="<?= $registerPath ?>">registrar-se</a></p>
        </div>

    </div>


</main>


<?php

include("templates/head__foot/foot.php");
