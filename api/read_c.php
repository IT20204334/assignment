<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../database.php';
include_once '../comments.php';
$database = new Database();

$db = $database->getConnection();
$items = new Comment($db);
$items->blog_id = $_GET['blog_id'];
$records = $items->getComments();
//echo json_encode(array("sql" => $records));
$itemCount = $records->num_rows;
echo json_encode($itemCount);
if($itemCount > 0){
$comArr = array();
$comArr["body"] = array();
$comArr["itemCount"] = $itemCount;
while ($row = $records->fetch_assoc())
{
array_push($comArr["body"], $row);
}
echo json_encode($comArr);
}
else{
http_response_code(404);
echo json_encode(
array("message" => "No record found.")
);
} 
?>