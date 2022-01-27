<?php
class Blog{
// dbection
private $db;
// Table
private $db_table = "blog";
// Columns
public $id;
public $user_id;
public $author;
public $post;
public $created;
public $result;


// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getBlogs(){
$sqlQuery = "SELECT id, user_id, post, created FROM " . $this->db_table . "";
$this->result = $this->db->query($sqlQuery);
return $this->result;
}



// CREATE
public function createBlog(){
// sanitize
$this->user_id=htmlspecialchars(strip_tags($this->user_id));
//$this->email=htmlspecialchars(strip_tags($this->email));
$this->post=htmlspecialchars(strip_tags($this->post));
$this->created=htmlspecialchars(strip_tags($this->created));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET user_id = '".$this->user_id."',
post = '".$this->post."',created = '".$this->created."'";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// UPDATE
public function getSingleBlog(){
$sqlQuery = "SELECT id, user_id, post, created FROM
". $this->db_table ." WHERE id = ".$this->id;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();
//$this->author = $dataRow['author'];
$this->user_id = $dataRow['user_id'];
$this->post = $dataRow['post'];
$this->created = $dataRow['created'];

$sqlQuery = "SELECT id, name FROM
user WHERE id = ".$this->user_id;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();
$this->author = $dataRow['name'];
}

// UPDATE
public function updateBlog(){
$this->author=htmlspecialchars(strip_tags($this->author));
//$this->email=htmlspecialchars(strip_tags($this->email));
$this->post=htmlspecialchars(strip_tags($this->post));
$this->created=htmlspecialchars(strip_tags($this->created));
$this->id=htmlspecialchars(strip_tags($this->id));

$sqlQuery = "UPDATE ". $this->db_table ." SET post = '".$this->post."',created = '".$this->created."'
WHERE id = ".$this->id;

$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deleteBlog(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}
}
?>