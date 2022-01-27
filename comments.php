<?php
class Comment{
// dbection
private $db;
// Table
private $db_table = "comment";
// Columns
public $id;
public $blog_id;
public $user_id;
public $comment;
//public $email;
//public $post;
public $created;
public $result;


// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getComments(){
$sqlQuery = "SELECT * FROM ". $this->db_table ." WHERE blog_id = ".$this->blog_id;
$this->result = $this->db->query($sqlQuery);

//$sqlQuery = "SELECT id, user_id, post, created FROM". $this->db_table ." WHERE id = ".$this->id;
return $this->result;
//return $sqlQuery;
}

// CREATE
public function createComment(){
// sanitize
$this->user_id=htmlspecialchars(strip_tags($this->user_id));
$this->blog_id=htmlspecialchars(strip_tags($this->blog_id));
$this->comment=htmlspecialchars(strip_tags($this->comment));
//$this->created=htmlspecialchars(strip_tags($this->created));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET user_id = '".$this->user_id."', blog_id = '".$this->blog_id."', comment = '".$this->comment."'";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// UPDATE
public function getSingleComment(){
$sqlQuery = "SELECT id, comment, created FROM
". $this->db_table ." WHERE id = ".$this->id;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();


$this->comment = $dataRow['comment'];
$this->created = $dataRow['created'];
}

// UPDATE
public function updateComment(){
//$this->author=htmlspecialchars(strip_tags($this->author));
//$this->email=htmlspecialchars(strip_tags($this->email));
$this->comment=htmlspecialchars(strip_tags($this->comment));
$this->created=htmlspecialchars(strip_tags($this->created));
$this->id=htmlspecialchars(strip_tags($this->id));

$sqlQuery = "UPDATE ". $this->db_table ." SET comment = '".$this->comment."',
created = '".$this->created."'
WHERE id = ".$this->id;

$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deleteComment(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id." and user_id = ".$this->user_id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

function deleteBlogComment(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE comment.id = ".$this->id." and blog_id = ".$this->blog_id. " and (SELECT user_id FROM blog WHERE blog.id = comment.blog_id) = " .$this->user_id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}


}
?>