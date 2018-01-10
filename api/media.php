<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db.php';

$database = new Database();
$db = $database->getConnection();

function findById($db, $id) {
  $query = 'SELECT * FROM Media WHERE MediaID = ?';
  $stmt = $db->prepare($query);
  $stmt->execute([$id]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return $result;
}

function findAll($db) {
  $query = 'SELECT * FROM Media';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function createOne($db, $values) {
  $query = 'INSERT INTO Media(path, year, type, uploaded, keywords) VALUES (?, ?, ?, ?, ?)';
  $stmt = $db->prepare($query);
  $stmt->execute($values);
}

// $result = findAll($db);
// echo json_encode($result);

createOne($db, array('path/ye', '2018', 'image', date('Y-m-d H:i:s'),'test keywords'))

?>