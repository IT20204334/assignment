<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../database.php';
include_once '../comments.php';
$database = new Database();
$db = $database->getConnection();
$item = new Comment($db);
$item->user_id = $_GET['user_id'];
$item->blog_id = $_GET['blog_id'];

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

if($item->deleteBlogComment()){
echo json_encode("Comment deleted.");
} else{
echo json_encode("Data could not be deleted");
}
?>