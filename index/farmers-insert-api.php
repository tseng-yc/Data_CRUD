<?php
require __DIR__ . '/parts/__connect_db.php';


header('Content-Type:application/json');

$output = [
    'success' => false,
    'postData'  => $_POST,
    'code' => 0,
    'error' => ''
];


$sql = "INSERT INTO `farmers`(
`name`, `picture`, `introduction`
 ) VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['picture'],
    $_POST['introduction'],
]);


if ($stmt->rowCount()) {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
