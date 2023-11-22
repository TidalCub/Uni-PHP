<?php
// This logs out the user and destroys the session
    require "../views/shared/_head.php";
    session_destroy();
    header("Location: /");
?>