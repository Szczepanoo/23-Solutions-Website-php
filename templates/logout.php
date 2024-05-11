<?php
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    unset($_SESSION['surname']);
    unset($_SESSION['email']);
    unset($_SESSION['tel']);
    header("Location: logowanie.php?wylogowano=1");
    exit();
