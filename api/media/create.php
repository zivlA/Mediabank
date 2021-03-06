<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../auth.php';
include_once '../db.php';

$database = new Database();
$db = $database->getConnection();

function createOne($db, $values) {
  $query = 'INSERT INTO Media(path, year, EventID, type, uploaded, keywords) VALUES (?, ?, ?, ?, ?, ?)';
  $stmt = $db->prepare($query);
  if ($stmt->execute($values) == TRUE) {
    echo json_encode("Success");
  } else {
    echo json_encode("Error");
  }
}

if (isAuth() == TRUE) {
  createOne($db, array(
    htmlspecialchars($_POST['path']), 
    htmlspecialchars($_POST['year']), 
    $_POST['EventID'], 
    htmlspecialchars($_POST['type']), 
    date('Y-m-d H:i:s'), 
    htmlspecialchars($_POST['keywords'])
  ));
} else {
  http_response_code(401);
  echo json_encode('Unauthorized');
}
?>