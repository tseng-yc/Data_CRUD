<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['admins'])) {
    header('Location: index.php');
    exit;
}
