<?php

use HotelEcho\Php\Utilities\Utilities;
?>
<?php $title = Utilities::generateHeadTitle("registration successful"); ?>

<?php ob_start(); ?>

<div class="error-page">

    <div class="error-page container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel center-align">
                    <h1 class="green-text"><i class="material-icons large">check_circle</i></h1>
                    <h4 class="black-text">Registration Successful</h4>
                    <p class="black-text">Thank you for registering! Please check your email to confirm your account.</p>
                    <a href="/" class="btn waves-effect waves-light light-blue accent-3">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>

</div>


<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>