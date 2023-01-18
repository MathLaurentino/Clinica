<!-- Mensagens em Verde - ACERTO -->
<?php
    if (isset($_SESSION['msgGreen'])) {
?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <?= $_SESSION['msgGreen'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>


<?php
        unset($_SESSION['msgGreen']);
    }
?>


<!-- Mensagens em vermelho - ERRO -->


<?php
    if (isset($_SESSION['msgRed'])) {
?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <?= $_SESSION['msgRed'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>


<?php
        unset($_SESSION['msgRed']);
    }
?>


<!-- Mensagens em amarelo - NEUTRO -->


<?php
    if (isset($_SESSION['msg'])) {
?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">

            <?= $_SESSION['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>


<?php
        unset($_SESSION['msg']);
    }
?>