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


$item->user_id = $_GET['user_id'];
//$item->email = $_GET['email'];
$item->post = $_GET['post'];
$item->created = date('Y-m-d H:i:s');
if($item->createBlog()){
echo 'Blog created successfully.';
} else{
echo 'Blog could not be created.';
}
?>