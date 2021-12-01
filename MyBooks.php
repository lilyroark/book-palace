<?php

function createCard($books_arr) { 
  //print_r($books_arr);
  foreach ($books_arr as $cn){
  ?>
  <div class="col-lg-4">
      <div class="card mx-auto" style="width: 18rem; margin: 1rem; radius: 1rem" id="class-card">
        <div class="card-header header">
          <h5 class="class-name"><?= $cn["title"] ?></h5>
        </div>
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted"> Author: <?= $cn["author_name"] ?> </h6>
          <p class="card-text"> ISBN: <?= $cn["isbn"] ?> </p>
        </div>
      </div>
    </a>
  </div>
<?php }} ?>


<?php
session_start();
$db = new mysqli("mysql01.cs.virginia.edu", "sc8zt", "password123", "sc8zt");
$username = $_SESSION["username"];
$user = null;
$get_useremail = $db->prepare("select email_address from user1 where username = ?;");
$get_useremail->bind_param("s", $username);
if (!$get_useremail->execute()) {
  $error_msg = "Error: User could not be found";
}
$get_useremail_data = $get_useremail->get_result()->fetch_all(MYSQLI_ASSOC);


$user = [
    "email" => $get_useremail_data[0]["email_address"],
    "username" => $username
];

$mybooks_stmt = $db->prepare("select book1.title, writes.author_name, writes.isbn from checks_out1 natural join book1 natural join writes where checks_out1.username = ?;");
$mybooks_stmt->bind_param("s", $user["username"]);
if (!$mybooks_stmt->execute()) {
  die("Error: Database failed");
}
$mybooks_data = $mybooks_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if(isset($_POST["bookName"]) and isset($_POST["bookAuthor"]) and isset($_POST["bookISBN"]) and isset($_POST["bookDate"]) and isset($_POST["bookGenre"])  ){

  $bookname = $_POST["bookName"];
  $bookauthor = $_POST["bookAuthor"];
  $bookisbn = $_POST["bookISBN"];
  $date = $_POST["bookDate"];
  $count = 1;
  $genre = $_POST["bookGenre"];
  
  $add_book2_stmt = $db->prepare("insert into book2 (title, published_date,genre) values (?,?,?)");
  $add_book2_stmt->bind_param("sss", $bookname, $date, $genre);
 
  $add_book1_stmt = $db->prepare("insert into book1 (isbn, title, available_count, published_date) values (?,?,?,?)");
  $add_book1_stmt->bind_param("ssis", $bookisbn, $bookname, $count, $date);

  $bookauthorbday = "0001-01-01";

  $add_author_stmt = $db->prepare("insert into author (name, birthday, primary_genre) values (?,?,?)");
  $add_author_stmt->bind_param("sss", $bookauthor, $bookauthorbday , $genre);

  $add_writes_stmt = $db->prepare("insert into writes (author_name, author_birthday, isbn) values (?,?,?)");
  $add_writes_stmt->bind_param("sss", $bookauthor, $bookauthorbday , $bookisbn);

  $add_checkout_stmt = $db->prepare("insert into checks_out1(username, isbn, date) values (?,?,?)");
  $datetoday = date("Y-m-d");
  $add_checkout_stmt->bind_param("sss", $user["username"], $bookisbn , $datetoday);
  
  if(preg_match('/^\w+@virginia\.edu$/i', $user["email"]) > 0){
      $add_book2_stmt->execute();
      $add_book1_stmt->execute();
      $add_author_stmt->execute();
      $add_writes_stmt->execute();
      $add_checkout_stmt->execute();
  }
  else {echo "You don't have administrative privilige";}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Book Palace</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="R ">
    <meta name="description" content="DB Project">
    <meta name="keywords" content="Learning">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/0604459c37.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
  <body>
      <p>Hello <?=$user["username"]?>  </p>

      <div class="container-fluid" >
      <div class="row">
        <div class="col-12">
          <div class="modal fade" id="bookModalToggle" aria-hidden="true" aria-labelledby="addBookModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addBookModalToggleLabel">Add Book</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="./MyBooks.php">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="mb-3">
                          <label for="bookNameFormLabel" class="form-label">Book Name</label>
                          <input type="text" name="bookName" class="form-control" id="bookNameFormLabel" placeholder="Book Name"
                            required>
                            <label for="bookISBNFormLabel" class="form-label">Book ISBN</label>
                          <input type="text" name="bookISBN" class="form-control" id="bookISBNFormLabel" placeholder="Book ISBN"
                            required>
                            <label for="bookAuthorFormLabel" class="form-label">Book Author</label>
                          <input type="text" name="bookAuthor" class="form-control" id="bookAuthorFormLabel" placeholder="Book Author"
                            required>
                            <label for="bookDateFormLabel" class="form-label">Book Publishing Date</label>
                          <input type="date" name="bookDate" class="form-control" id="bookDateFormLabel" placeholder="Book Date"
                            required>
                            <label for="bookGenreFormLabel" class="form-label">Book Genre</label>
                          <input type="text" name="bookGenre" class="form-control" id="bookGenreFormLabel" placeholder="Book Genre"
                            required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <button class="btn btn-primary my-3">
            <a data-bs-toggle="modal" href="#bookModalToggle" role="button" aria-label="Add Book" id="addBook">
              Add Book
            </a>
          </button>
        </div>
      </div>
    </div>



      <div class="container" id="class-cards">
      <div class="row">
        <?= createCard($mybooks_data)?>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  </body>
  
</html>
