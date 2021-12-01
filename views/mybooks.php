<?php include ('views/header.php'); ?>

<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">My Books</h2>
  <div class="mt-5 d-flex flex-wrap">
    <?php
    if (empty($mybooks)) {
      echo "No Book";
    } else {
      foreach($mybooks as $book) {
        echo "
            <div class='card col-4 ms-3 mb-3' style='width: 18rem;'>
              <div class='card-body'>
                <h5 class='card-title'>{$book["title"]}
                <h6 class='card-subtitle mb-2 text-muted'>ISBN: {$book["isbn"]}</h6>
                <p class='card-text'>
                  published date: {$book["isbn"]}</br>
                  available count: {$book["available_count"]}
                </p>
                <a href='{$this->base_url}/index.php?page=book&command=book_detail&book={$book["isbn"]}' class='card-link' style='color: var(--medium-theme-color)'>Detail</a>
              </div>
            </div>
        ";
      }
    }
    ?>
  </div>
</section>

<?php include ('views/footer.php'); ?>
