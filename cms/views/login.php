<?php $_SESSION['notification']['login_error'] = 'Usuário e/ou senha incorretos'?>

<section id="login" class="login">
    <div class="login-box">
        <div class="logo-box">
            <a href="#"><img src="<?= $config->paths->img.'/logo-color.svg' ?>" alt=""></a>
        </div>
        <div class="form">
            <form id="login-form" class="login-form" action="<?= $config->paths->controller."/userController.php" ?>">
                <div class="has-float-label">
                    <input id="login_email" name="login_email" type="text" placeholder="Nome de usuário / Senha" required>
                    <label for="login_email">Nome de usuário / Senha</label>
                </div>
                <div class="has-float-label">
                    <input id="login_password" name="login_password" type="password" placeholder="Senha" required>
                    <label for="login_password">Senha</label>
                </div>
                <input type="submit" value="Entrar">
            </form>
        </div>
        <div class="notification-session">
            <div id="notification" style="display: none"></div>
        </div>
        <div class="esqueci-senha">
            <a href="#">Esqueci minha senha</a>
        </div>
    </div>
</section>

<script src="<?= $config->paths->js.'/admin/login-validate.js' ?>"></script>