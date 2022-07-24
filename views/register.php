<?php

$model = "Registrar-se";
$style = "../css/login_register.css";
$normalizeCss = "../css/normalize.css";
$script = "../javascript/login_register.js";

$loginPath = "login.php";

include("templates/head__foot/head.php");

$classesPath = "../configs/classes.php";
$dataBaseConfigPath = "../configs/dataBaseConfig.php";

$emailError = "";
$emailErrorMessage = "";
$nameError = "";
$nameErrorMessage = "";
$passwordError = "";
$passwordErrorMessage = "";

$emailValue = "";
$nameValue = "";

require("../configs/register_controller.php");


?>

<main class="login__register__main">

    <div class="form__container">

        <div class="logo__container">
            <mark class="logo">registrar-se</mark>
        </div>

        <form action="" method="POST" class="login__register__form">

            <div class="login__register__input__container">
                <input type="text" maxlength="300" name="name" placeholder="nome" class="not__password" value="<?= $nameValue ?>">
            </div>
            <p class="error__message <?= $nameError ?> "><?= $nameErrorMessage ?></p>
            <div class="login__register__input__container">
                <input type="text" maxlength="300" name="email" placeholder="email" class="not__password" value="<?= $emailValue ?>">
            </div>
            <p class="error__message <?= $emailError ?> "><?= $emailErrorMessage ?></p>

            <div class="login__register__input__container">
                <input type="password" maxlength="300" name="password" placeholder="senha" id="password">
                <i class="fas fa-eye"></i>
                <i class="fa-solid fa-eye-slash active"></i>
            </div>
            <p class="error__message <?= $passwordError ?> "><?= $passwordErrorMessage ?></p>

            <div class="button__container">
                <button type="submit" name="register">registrar-se</button>
            </div>
        </form>

        <div class="redirect__container">
            <p>Já tem uma conta? <a href="<?= $loginPath ?>">entrar</a></p>
        </div>

    </div>

</main>


<?php

include("templates/head__foot/foot.php");
