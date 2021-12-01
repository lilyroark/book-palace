<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Palace</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Sehoan (Mike) Choi">
    <meta name="description" content="friends list">
    <meta name="keywords" content="friends">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$this->base_url?>/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light p-3">
      <div class="container-fluid">
        <a class="navbar-brand fs-2" href="<?=$this->base_url?>" style="color: var(--dark-theme-color)">The Book Palace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenus" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenus">
          <ul class="navbar-nav pe-4">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?=$this->base_url?>">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Personal
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?=$this->base_url?>/index.php?page=account&command=mybooks">My Books</a></li>
                <li><a class="dropdown-item" href="<?=$this->base_url?>/index.php?page=account&command=friends">My Friends</a></li>
                <li><a class="dropdown-item" href="<?=$this->base_url?>/index.php?page=account&command=logout">Log Out</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="modal" href="#bookModalToggle" role="button" aria-label="Add Book" id="addBook">
                Add Book
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">By Popularity</a>
            </li>
          </ul
        </div>
      </div>
    </nav>
  </header>

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
                        <input type="text" name="bookName" class="form-control" id="bookNameormLabel" placeholder="Book Name"
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
      </div>
    </div>
  </div>
