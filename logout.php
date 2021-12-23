<?php
if(isset($_GET['varname'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location:login.php');
}
?>