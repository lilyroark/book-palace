<?php
include_once("../controllers/database_connection.php"); 
//  add to favorites needs users, add to checkout

 $con = new mysqli($dbserver, $dbuser, $dbpass, $dbdatabase);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

 $user = $_POST['username'];
 $isbn = $_POST['isbn'];
 $checked = $_POST['checked'];

if($checked=="true"){
    
    $stmt = $con->prepare("INSERT INTO favorites(username, isbn) VALUES (?, ?)");
 $stmt->bind_param("ss", $user, $isbn);
 $stmt->execute();
}else{
    
    $stmt = $con->prepare("DELETE FROM favorites where username=? and isbn=?");
 $stmt->bind_param("ss", $user, $isbn);
 $stmt->execute();
}
 

 mysqli_close($con);
?>