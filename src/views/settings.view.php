<?php

use HotelEcho\Php\Utilities\Utilities;
?>
<?php $title = Utilities::generateHeadTitle("settings"); ?>

<?php ob_start();  ?>

<div class="settings-page container">
    <section class="section">
        <h1>SETTINGS</h1>

        <div class="row">


            <!-- avatar -->
            <form action="/edit-avatar" method="post" class="col s12" enctype="multipart/form-data">
                <h2>Avatar</h2>

                <div class="row">
                    <!-- avatar -->
                    <div class="col xl6 l6 m6 s12">
                        <div class="image-container">
                            <a id="edit-avatar" class="btn-floating btn-large waves-effect waves-light blue-grey darken-3"><i
                                    class="material-icons">edit</i></a>
                            <img class="z-depth-3 avatar"
                                src=<?= $userInfo['avatar'] ? htmlspecialchars($userInfo['avatar']) : "https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=150&name=" . htmlspecialchars($userInfo['username']) ?> alt="avatar">
                            <input hidden type="file" name="avatar" id="avatar" accept="image/png, image/jpeg">
                        </div>

                        <p id="auth-error" class="error-message red-text text-center"><?= isset($errors["avatar"]) ? $errors["avatar"] : "" ?></p>

                    </div>
                </div>

                <div class="row">
                    <div class="btn-submit-container col xl2 l2 m2 s4 offset-xl10 m2 offset-l10 offset-m10 offset-s8 ">
                        <button id="avatar-submit-btn" class="btn waves-effect waves-light light-blue accent-3 disabled" type="submit" name="action">Save
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>

            </form>

            <div class="divider"></div>

            <!-- email & suername -->
            <form action="/edit-user-info" method="POST" enctype="application/x-www-form-urlencoded" class="col s12">
                <h2>User informations</h2>

                <div class="row">
                    <!-- username -->
                    <div class="input-field col xl6 l6 m6 s12">
                        <input
                            id="username"
                            type="text"
                            name="username"
                            class="validate"
                            value="<?= htmlspecialchars($userInfo['username']) ?>"
                            required />
                        <label for="username">Username</label>
                        <span id="username-error" class="error-message red-text"><?= isset($errors["username"]) ? $errors["username"] : "" ?></span>
                    </div>
                </div>

                <div class="row">
                    <!-- email -->
                    <div class="input-field col xl6 l6 m6 s12">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="validate"
                            value="<?= htmlspecialchars($userInfo['email']) ?>"
                            required />
                        <label for="email">Email</label>
                        <span id="email-error" class="error-message red-text"><?= isset($errors["email"]) ? $errors["email"] : "" ?></span>
                    </div>
                </div>

                <div class="row">
                    <div
                        class="btn-submit-container col xl2 l2 m2 s4 offset-xl10 m2 offset-l10 offset-m10 offset-s8">
                        <button
                            class="btn waves-effect waves-light light-blue accent-3 disabled"
                            id="userInfo-submit-btn"
                            type="submit"
                            name="action">
                            Save2
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="divider"></div>

            <!-- password -->
            <form action="/edit-password" method="POST" enctype="application/x-www-form-urlencoded" class="col s12" id="password-form">
                <h2>Password</h2>

                <div class="row">
                    <!-- old password -->
                    <div class="input-field col s12">
                        <input
                            id="old-password"
                            type="password"
                            name="old-password"
                            class="validate"
                            required />
                        <label for="old-password">Old Password</label>
                        <span
                            id="old-password-error"
                            class="error-message red-text"><?= isset($errors["old-password"]) ? $errors["old-password"] : "" ?></span>
                    </div>
                </div>

                <div class="row">
                    <!-- new password -->
                    <div class="input-field col xl6 l6 m6 s12">
                        <input
                            id="new-password"
                            type="password"
                            name="new-password"
                            class="validate"
                            required />
                        <label for="new-password">New Password</label>
                        <span
                            id="new-password-error"
                            class="error-message red-text"><?= isset($errors["new-password"]) ? $errors["new-password"] : "" ?></span>
                    </div>

                    <!-- new password confirmation -->
                    <div class="input-field col xl6 l6 m6 s12">
                        <input
                            id="new-password-confirmation"
                            type="password"
                            name="new-password-confirmation"
                            class="validate"
                            required />
                        <label for="new-password-confirmation">New Password Confirmation</label>
                        <span
                            id="new-password-confirmation-error"
                            class="error-message red-text"><?= isset($errors["new-password-confirmation"]) ? $errors["new-password-confirmation"] : "" ?></span>
                    </div>
                </div>

                <div class="row">
                    <div
                        class="btn-submit-container col xl2 l2 offset-xl10 m2 offset-l10 offset-m10 offset-s8 s4">
                        <button
                            class="btn waves-effect waves-light light-blue accent-3 disabled"
                            id="password-submit-btn"
                            type="submit"
                            name="action">
                            Save
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </section>


    <?php if (isset($_SESSION['success'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.toast({
                    html: '<span><?= htmlspecialchars($_SESSION['success']) ?><i class="material-icons right">check_circle</i></span>',
                    displayLength: 4000, // 2 seconds
                    classes: 'toast-success'
                });
            });
        </script>
        <?php unset($_SESSION['success']); // Clear success message after displaying 
        ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.toast({
                    html: '<span><?= htmlspecialchars($_SESSION['errors']) ?><i class="material-icons right">error</i></span>',
                    displayLength: 4000, // 2 seconds
                    classes: 'toast-errors'
                });
            });
        </script>
        <?php unset($_SESSION['errors']); // Clear errors message after displaying 
        ?>
    <?php endif; ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>