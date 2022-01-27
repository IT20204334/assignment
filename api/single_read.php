<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database.php';
include_once '../blogs.php';
$database = new Database();
$db = $database->getConnection();
$item = new Blog($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->getSingleBlog();
if($item->author != null){

// create array
$blo_arr = array(
"id" => $item->id,
"author" => $item->author,
//"email" => $item->email,
"post" => $item->post,
"created" => $item->created
);

http_response_code(200);
echo json_encode($blo_arr);
}
else{
http_response_code(404);
echo json_encode("Employee not found.");
}
?>