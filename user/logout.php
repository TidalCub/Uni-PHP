<?php
    require "../views/shared/_head.php";
    session_destroy();
    header("Location: /");
?>