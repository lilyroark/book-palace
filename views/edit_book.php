<?php
  
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

    <form method="POST" action="<?=$this->base_url?>/index.php?page=book&command=edit_book&book=<?=$isbn?>">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-7">
            <div class="mb-3">
              <label for="bookTitleFormLabel" class="form-label">Book Title</label>
              <input type="text" name="title" class="form-control" id="bookTitleFormLabel" placeholder="<?=$book1["title"]?>"
                >
                <label for="bookISBNFormLabel" class="form-label">Book ISBN</label>
              <input type="text" name="isbn" class="form-control" id="bookISBNFormLabel" placeholder="<?=$book1["isbn"]?>"
                >
                <label for="bookAuthorFormLabel" class="form-label">Book Author</label>
              <input type="text" name="author_name" class="form-control" id="bookAuthorFormLabel" placeholder="<?=$book3["author_name"]?>"
                >
                <label for="bookDateFormLabel" class="form-label">Book Publishing Date</label>
              <input type="date" name="published_date" class="form-control" id="bookDateFormLabel" placeholder="<?=$book1["published_date"]?>"
              >
              <label for="bookGenreFormLabel" class="form-label">Book Genre</label>
            <input type="text" name="genre" class="form-control" id="bookGenreFormLabel" placeholder="<?=$book2["genre"]?>"
              >
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  </body>
  
</html>
