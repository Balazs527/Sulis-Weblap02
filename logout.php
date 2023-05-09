<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    setcookie("user_id", "", time() - 3600, "/");
    setcookie("username", "", time() - 3600, "/");
}

header("Location: index.php");
exit;

