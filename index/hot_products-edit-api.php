<?php
require __DIR__ . '/parts/__connect_db.php';

header('Content-Type:application/json');

$output = [
    'success' => false,
    'postData'  => $_POST,
    'code' => 0,
    'error' => ''
];

$sql = "UPDATE `hot_products` SET 
    `name`=?,
    `picture`=?,
    `calories`=?,
    `introduction`=?
    WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['picture'],
    $_POST['calories'],
    $_POST['introduction'],
    $_POST['sid'],
]);


if ($stmt->rowCount()) {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
