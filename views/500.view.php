<?php ob_start(); ?>

<div class="error-page">

    <div class="error-page container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel center-align">
                    <h1 class="black-text"><i class="material-icons large">error_outline</i></h1>
                    <h4 class="black-text">500 Internal Server Error </h4>
                    <p class="black-text">Sorry, erreur interne du serveur.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>