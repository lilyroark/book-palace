<?php include ('views/header.php');
$user = $_SESSION["username"]; ?>

<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">Checked Out</h2>
  <div>
    <?php
    if (empty($mybooks)) {
      echo "No Book";
    } else {
      foreach($mybooks as $book) {
        echo "
            <div class='card col-4 mb-2' style='width: 18rem;'>
              <div class='card-body'>
                <h5 class='card-title'>{$book["title"]}
                <a class='badge btn btn-dark' href='{$this->base_url}/index.php?page=account&command=remove_favorite&name={$book['isbn']}'> Unfavorite </a>
             
                <h6 class='card-subtitle mb-2 text-muted'>ISBN: {$book["isbn"]}</h6>
                <p class='card-text'>
                  published date: {$book["isbn"]}</br>
                  available count: {$book["available_count"]}
                </p>
                <a href='{$this->base_url}/index.php?page=book&command=book_detail' class='card-link' style='color: var(--medium-theme-color)'>Detail</a>
                  <a class='badge btn btn-dark' href='{$this->base_url}/index.php?page=account&command=add_reviews&name={$book['isbn']}'> Leave Review </a>
                </div>
            </div>
        ";
      }
    }
    ?>
  </div>
</section>

<script>
function addFav(x){
 
  var isbn = x.value;
  var username = "<?php echo $user; ?>";
 
  $.post('../book-palace/controllers/addFavorite.php',{checked:'false',isbn:isbn, username:username}, function(data){
    // $("#search_results").html(data);
    console.log(data);
    console.log("returned");

           }); 
    }
  </script>

<?php include ('views/footer.php'); ?>
