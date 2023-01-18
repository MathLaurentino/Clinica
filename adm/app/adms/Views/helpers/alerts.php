<?php
if (isset($_SESSION['msg'])) {
?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">

        <?= $_SESSION['msg'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php
    unset($_SESSION['msg']);
}
?>