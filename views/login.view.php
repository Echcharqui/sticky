<?php $title = generateHeadTitle("login"); ?>

<?php ob_start(); ?>

<div class="login-page container">
    <section class="section">
        <h1>LOGIN</h1>

        <div class="row">
            <form action="/login" method="post" enctype="application/x-www-form-urlencoded" class="col s-12">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" class="validate" required />
                        <label for="email">Email</label>
                        <span id="email-error" class="error-message red-text"><?= isset($errors["email"]) ? $errors["email"] : "" ?></span>
                    </div>

                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" class="validate" required />
                        <label for="password">Password</label>
                        <span id="password-error" class="error-message red-text"><?= isset($errors["password"]) ? $errors["password"] : "" ?></span>
                    </div>

                    <div class="col s12">
                        <button class="btn waves-effect waves-light light-blue accent-3" type="submit" name="action">
                            Connexion
                            <i class="material-icons right">send</i>
                        </button>

                        <p id="auth-error" class="error-message red-text text-center"><?= isset($errors["login"]) ? $errors["login"] : "" ?></p>

                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>