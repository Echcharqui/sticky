<?php ob_start(); ?>

<div class="error-page">

    <div class="error-page container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel center-align">
                    <h1 class="black-text"><i class="material-icons large">error_outline</i></h1>
                    <h4 class="black-text">403 Not Found</h4>
                    <p class="black-text">Sorry, access rights do not allow the client to access the resource.</p>
                    <a href="/" class="btn waves-effect waves-light light-blue accent-3">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>