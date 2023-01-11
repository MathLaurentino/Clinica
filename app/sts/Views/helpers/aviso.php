<?php
if (isset($_SESSION['msg'])) {
    echo 
    
    "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </button>" 
    . $_SESSION['msg'] 
    . "</div>";

    unset($_SESSION['msg']);
}


?>