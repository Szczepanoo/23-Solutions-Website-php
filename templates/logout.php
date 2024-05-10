<?php
    unset($_SESSION['user_id']);
    header("Location: logowanie.php?wylogowano=1");
    exit();
?>