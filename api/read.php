<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../database.php';
include_once '../blogs.php';
$database = new Database();

$db = $database->getConnection();
$items = new Blog($db);
$records = $items->getBlogs();
$itemCount = $records->num_rows;
echo json_encode($itemCount);
if($itemCount > 0){
$blogArr = array();
$blogArr["body"] = array();
$blogArr["itemCount"] = $itemCount;
while ($row = $records->fetch_assoc())
{
array_push($blogArr["body"], $row);
}
echo json_encode($blogArr);
}
else{
http_response_code(404);
echo json_encode(
array("message" => "No record found.")
);
}
?>