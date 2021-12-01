
<?php
include_once("../database_connection.php"); 
//  add to favorites needs users, add to checkout
 $con = new mysqli($dbserver, $dbuser, $dbpass, $dbdatabase);
 $user = $_POST['username'];
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

$results_per_page = 20;
$page = $_POST['page'];
if($page > 0){
    $page_first_result = ($page-1) * $results_per_page;

    echo '<br>';
    if($_POST['searchBy'] == 'title'){
        $fullSelect = 'SELECT * FROM book1 NATURAL JOIN book2 NATURAL JOIN writes
        WHERE title LIKE ? ';
    }else{
        $fullSelect = 'SELECT * FROM book1 NATURAL JOIN book2 NATURAL JOIN writes
        WHERE author_name LIKE ?';
    }
    
    if($_POST['available'] =='true'){
        $fullSelect = $fullSelect . ' and available_count > 0 ';
    };

    $select = $fullSelect.' Limit '.$page_first_result.', '.$results_per_page;
    $data = "%".$_POST['input']."%";
    
    $stmt = $con->prepare($select);
    $stmt->bind_param("s", $data);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt2 = $con->prepare($fullSelect);
    $stmt2->bind_param("s", $data);
    $stmt2->execute();
    $fullResult = $stmt2->get_result();
    
    if($fullResult->num_rows ==0){
        if($_POST['searchBy'] =='title'){
            echo "No results for books titled: '".$_POST['input']."'";
        }else{
            echo "No results for author: '".$_POST['input']."'";
        }
        
    }else{
        $number_of_page = ceil ($fullResult->num_rows / $results_per_page); 
        if($page > $number_of_page){
            echo "Showing page ". $number_of_page." of ". $number_of_page."<br>";
            $page = $number_of_page;
            $page_first_result = ($number_of_page-1) * $results_per_page;
            
            $select = $fullSelect . ' Limit '.$page_first_result.', '.$results_per_page;
            $stmt4=$con->prepare($select);

            $stmt4->bind_param("s", $data);
            $stmt4->execute();
            $result =$stmt4->get_result();
            while ($row = mysqli_fetch_assoc($result)){
                // make query to see if book is favorited, set toggle accordingly
                $query="Select * from favorites where username=? and isbn=?";
                $stmt3 = $con->prepare($query);
                $stmt3->bind_param("ss", $user, $row['isbn']);
                $stmt3->execute();
                $result2 = $stmt3->get_result();
                // mysqli_fetch_assoc($res);
                $isFav = $result2->num_rows;
            
                if($isFav == 1){
                    echo '
                    <div class="col-lg-4">
                        <div class="card mx-auto" style="width: 100%; margin: 1rem; radius: 1rem" id="class-card">
                            <div class="card-header header">
                                <h5 class="class-name">'.$row['title'].'</h5>
                                <input type="checkbox" checked="true" onclick="addFav(this)"  style="float:right"  value='.$row['isbn'].'>
                                    <b style="float:right">favorite</b>
                                </input></div>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"> Author: '.$row['author_name'].'</h6>
                                <h6 class="card-subtitle mb-2 text-muted"> ISBN: '.$row['isbn'].'</h6>
                            </div>
                        </div>
                    </div>
                    ';
                }else{
                    echo '
                    <div class="col-lg-4">
                        <div class="card mx-auto" style="width: 100%; margin: 1rem; radius: 1rem" id="class-card">
                            <div class="card-header header">
                                <h5 class="class-name">'.$row['title'].'</h5>
                                <input type="checkbox" onclick="addFav(this)"  style="float:right"  value='.$row['isbn'].'>
                                    <b style="float:right">favorite</b>
                                </input></div>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"> Author: '.$row['author_name'].'</h6>
                                <h6 class="card-subtitle mb-2 text-muted"> ISBN: '.$row['isbn'].'</h6>
                            </div>
                        </div>
                    </div>
                    ';
                }
                
            }

        }else{
            echo "Showing page ". $_POST['page']." of ". $number_of_page."<br>";
            while ($row = mysqli_fetch_assoc($result)){
                $query="Select * from favorites where username=? and isbn=?";
                $stmt3 = $con->prepare($query);
                $stmt3->bind_param("ss", $user, $row['isbn']);
                $stmt3->execute();
                $result2 = $stmt3->get_result();
                $isFav = $result2->num_rows;
                if($isFav == 1){
                    echo '
                    <div class="col-lg-4">
                        <div class="card mx-auto" style="width: 100%; margin: 1rem; radius: 1rem" id="class-card">
                            <div class="card-header header">
                                <h5 class="class-name">'.$row['title'].'</h5>
                                <input type="checkbox" checked="true" onclick="addFav(this)"  style="float:right"  value='.$row['isbn'].'>
                                    <b style="float:right">favorite</b>
                                </input></div>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"> Author: '.$row['author_name'].'</h6>
                                <h6 class="card-subtitle mb-2 text-muted"> ISBN: '.$row['isbn'].'</h6>
                            </div>
                        </div>
                    </div>
                    ';
                }else{
                    echo '
                    <div class="col-lg-4">
                        <div class="card mx-auto" style="width: 100%; margin: 1rem; radius: 1rem" id="class-card">
                            <div class="card-header header">
                                <h5 class="class-name">'.$row['title'].'</h5>
                                <input type="checkbox" onclick="addFav(this)"  style="float:right"  value='.$row['isbn'].'>
                                    <b style="float:right">favorite</b>
                                </input></div>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"> Author: '.$row['author_name'].'</h6>
                                <h6 class="card-subtitle mb-2 text-muted"> ISBN: '.$row['isbn'].'</h6>
                            </div>
                        </div>
                    </div>
                    ';
                }
                
            }
        }
    }
}echo "hi";

 mysqli_close($con);
?>