<?php
if (isset($_SESSION['msg'])) {
?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert"> <!-- alert-success --> <!-- alert-danger --> <!-- alert-warning -->

        <?= $_SESSION['msg'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php
    unset($_SESSION['msg']);

} if (isset($_SESSION['msgGreen'])) {
?>

    <div class="alert alert-success alert-dismissible fade show" role="alert"> <!-- alert-success --> <!-- alert-danger --> <!-- alert-warning -->

        <?= $_SESSION['msgGreen'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php
    unset($_SESSION['msgGreen']);

} if (isset($_SESSION['msgRed'])) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"> <!-- alert-success --> <!-- alert-danger --> <!-- alert-warning -->

        <?= $_SESSION['msgRed'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php
    unset($_SESSION['msgRed']);
} 
?>

