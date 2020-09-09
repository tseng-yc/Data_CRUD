<?php
require __DIR__ . '/parts/__connect_db.php';

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'events.php';

if (empty($_GET['sid'])) {
    header('Location:' . $referer);
    exit;
}
$sid = intval($_GET['sid']) ?? 0;
$pdo->query("DELETE FROM events WHERE sid=$sid");
header('Location: ' . $referer);
