<?php
include ('views/header.php');
$user = $_SESSION["username"];
?>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
  <div>
    <form id='search-form' action="" method="post">
      <div class="d-flex justify-content-end align-items-center">
        <div class="me-3 form-check form-switch">
          <input class="form-check-input" id='available_only' name='available_only' type="checkbox" <?= $available_only ? "checked" : ""?>/>
          <label for="available_only" class="form-label me-1">Available only</label>
        </div>

        <input class="form-control w-75 me-3" type="text" name="keyword" id="keyword" style="border-color: var(--light-theme-color);color: var(--dark-theme-color)">

        <input class="btn btn-dark" type="submit" value="Search"/>
      </div>
      <div class="d-flex justify-content-end mt-2">
        <span class="me-3">Search By : </span>
        <input class="form-check-input" id='by-title' name='by' type="radio" checked="true" value="title"/>
        <label for="by-title" class="form-label mx-1">Title</label>
        <input class="form-check-input" id='by-author' name='by' type="radio" value="author" />
        <label for="by-author" class="form-label mx-1">Author</label>
      </div>
    </form>
  <p id="alerting" class="alerting"></p>
    <!-- <div class="d-flex justify-content-end">
      <button class="btn btn-dark" id="back5" onclick="decrement5()" ><<</button>
      <button class="btn btn-dark mx-1" id="back" onclick="decrement()" ><</button>
      <button class="btn btn-dark mx-1" id="next" onclick="increment()" >></button>
      <button class="btn btn-dark" id="next5" onclick="increment5()" >>></button>
    </div> -->
  </div>

          <?php     echo "Showing ".sizeof($search_result) ." results";
    echo "<br>";?>
    <div class="col-10 row justify-content-between" id='search_results'>

    <?php

      foreach($search_result as $book) {
        $isbn = $book["isbn"];
        echo "
            <div class='card col-4 mb-3' style='width: 18rem;'>
              <div class='card-body'>
                <h5 class='card-title'>{$book["title"]}</h5>
                <h6 class='card-subtitle mb-2 text-muted'>ISBN: {$book["isbn"]}</h6>
                <p class='card-text'>
                  published date: {$book["published_date"]}</br>
                  available count: {$book["available_count"]}
                </p>
                <a href='{$this->base_url}/index.php?page=book&command=book_detail&book={$isbn}' class='card-link' style='color: var(--medium-theme-color)'>Detail</a>
                <a href='{$this->base_url}/index.php?page=book&command=add_favorite&book={$isbn}' class='card-link' style='color: var(--medium-theme-color)'>Add to Mybooks</a>
              </div>
            </div>
        ";
      
    }
    ?>
    </div>
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</section>

<?php include ('views/footer.php'); ?>