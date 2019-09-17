<?php 
 
class StoreImage{
 
 private $con; 
 
 public function __construct(){
 //getting the connection file
 require_once dirname(__FILE__) . '/DbConnect.php';
 
 //creating the object of the dbconnect class
 $db = new DbConnect; 
 
 //getting the connection
 $this->con = $db->connect();
 }
 
 //this method will return the actual image content 
 public function getImageContent($imageid){
 $stmt = $this->con->prepare("SELECT image FROM list_student WHERE id = ?");
 $stmt->bind_param("i", $imageid);
 $stmt->execute();
 $stmt->bind_result($image);
 $stmt->fetch();
 return $image; 
 }
 
}