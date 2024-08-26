<?php require_once(__DIR__ . "../../layouts/header.php") ?>
<?php require_once(__DIR__ . "../../partials/navBar.php") ?>

<div class="registration-page container">

    <section class="section">

        <h1>REGISTRATION</h1>

        <div class="row">

            <form action="/registration" method="POST" enctype="application/x-www-form-urlencoded" class="col s-12">

                <div class="row">

                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" class="validate" required>
                        <label for="email">Email</label>
                        <span id="email-error" class="error-message red-text"><?= isset($errors["email"]) ? $errors["email"] : "" ?></span>
                    </div>

                    <div class="input-field col s12">
                        <input id="username" type="text" name="username" class="validate" required>
                        <label for="username">Username</label>
                        <span id="username-error" class="error-message red-text"><?= isset($errors["username"]) ? $errors["username"] : "" ?></span>
                    </div>

                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" class="validate" required>
                        <label for="password">Password</label>
                        <span id="password-error" class="error-message red-text"><?= isset($errors["password"]) ? $errors["password"] : "" ?></span>
                    </div>

                    <div class="input-field col s12">
                        <input id="password-confirmation" type="password" name="password-confirmation" class="validate" required>
                        <label for="password-confirmation">Password Confirmation</label>
                        <span id="password-confirmation-error" class="error-message red-text"><?= isset($errors["password-confirmation"]) ? $errors["password-confirmation"] : "" ?></span>
                    </div>

                    <div class="col s12">
                        <button class="btn waves-effect waves-light light-blue accent-3" type="submit" name="action">Register
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </section>


</div>


<?php require_once(__DIR__ . "../../layouts/footer.php") ?>