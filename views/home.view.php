
<?php $title = generateHeadTitle(""); ?>

<?php ob_start(); ?>

<!-- secction button to add a note -->
<section class="section add">
    <div class="row">
        <div class="button-add col s12">
            <a class="waves-effect waves-light light-blue accent-3 btn" href="/add-note">
                <i class="material-icons left">add</i>
                Add new note
            </a>
        </div>
</section>
<!--  -->

<!-- colors groupe of cards 
  yellow accent-4 
  light-blue
  pink lighten-1
  blue-grey darken-1
  orange lighten-1
  -->

<?php if (empty($notes)) : ?>

    <!-- no notes on the board ui -->
    <div class="container">
        <p class="center-align amber-text text-accent-4"><i class="large material-icons">info_outline</i></p>
        <h3 class="center-align">Your board is empty !</h3>
    </div>
    <!--  -->

<?php else : ?>

    <!-- notes rendering -->
    <section>
        <div class="row">

            <?php foreach ($notes as $note) : ?>

                <div class="card-container col xl3 l4 s12 m6" data-id="<?= $note['id'] ?>">

                    <div class="card z-depth-4 <?= in_array($note['color'], $colorsGroupe) === true ? $note['color'] . " white-text" : $note['color'] ?>">

                        <span class="activator"><i class="material-icons right">mode_edit</i></span>

                        <div class="card-content">
                            <span class="card-title"><?= $note['title'] ?></span>
                            <p><?= nl2br(htmlspecialchars($note['content'])) ?></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><?= $note['title'] ?><i class="material-icons right">close</i></span>

                            <div class="wraper">
                                <a class="waves-effect waves-light blue-grey darken-1 btn-large" href="/edit-note?id=<?= $note["id"] ?>"><i class="material-icons left">mode_edit</i>Edit</a>
                                <a class="waves-effect waves-light red btn-large modal-trigger" href="#delete-modal"><i class="material-icons left">delete</i>Remove</a>
                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </section>

<?php endif; ?>
<!--  -->

<div id="delete-modal" class="modal">
    <div class="modal-content">
        <h4 id="note-title"></h4>
        <p>Are you sure about deleting this note !</p>
    </div>
    <div class="modal-footer">
        <a id="delete-note-confirm" class="modal-close waves-effect waves-green btn-flat green-text">Agree</a>
        <a href="#!" class="modal-close waves-effect waves-red btn-flat red-text">Cancel</a>
    </div>
</div>

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

<?php $content = ob_get_clean(); ?>

<?php require_once(__DIR__ . "../../template/layout/layout.php") ?>