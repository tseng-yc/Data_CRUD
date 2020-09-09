<?php
require __DIR__ . '/parts/__connect_db.php';

header('Content-Type:application/json');

$output = [
    'success' => false,
    'postData'  => $_POST,
    'code' => 0,
    'error' => ''
];


$sql = "UPDATE `events` SET 
    `title`=?,
    `picture`=?,
    `content`=?,
    `date_from`=?,
    `date_end`=?
    WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['title'],
    $_POST['picture'],
    $_POST['content'],
    $_POST['date_from'],
    $_POST['date_end'],
    $_POST['sid'],
]);

if ($stmt->rowCount()) {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
