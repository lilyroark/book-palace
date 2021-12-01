<?php

include_once("../database_connection.php"); 
//  add to favorites needs users, add to checkout

 $con = new mysqli($dbserver, $dbuser, $dbpass, $dbdatabase);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

 $user = $_POST['username'];
 $isbn = $_POST['isbn'];
 $copies = $_POST['copies'];
 $date = date("Y-m-d");
 //get number of copies available

// add book to checkout table 
if($copies > 0){
    $stmt = $con->prepare("INSERT INTO checks_out1(username, isbn, date) VALUES (?, ?,?)");
    $stmt->bind_param("sss", $user, $isbn, $date);
    $stmt->execute();

    $copies_after_checkout = $copies -1;
    $stmt2 = $con->prepare("UPDATE book1 SET available_count=? WHERE isbn=?");
    $stmt2->bind_param("ss", $copies_after_checkout, $isbn);
    $stmt2->execute();
}else{
    echo "<script>alert('No available copies to check out. Please check back later')</script>";
}
 



 mysqli_close($con);

    
    // when you checkout, refresh page and show count has gone down
    // maybe add reviews page to only checkedout not fav
?>