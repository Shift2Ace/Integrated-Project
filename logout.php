<?php
    session_start();
    if (isset($_COOKIE['s_id'])) {
        setcookie('s_id', null);
    }
    if (isset($_COOKIE['user_id'])) {
        setcookie('user_id', null);
    }
    session_destroy();
    header("Location: routes.php");
?>