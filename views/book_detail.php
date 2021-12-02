<?php include ('views/header.php'); ?>

<section class="container mt-3 d-flex flex-row">
    <section class="col-7 mt-3 p-4 d-flex flex-column" style="border: solid 2px var(--light-theme-color);border-radius: 10px;">
        <h1 style="text-decoration: none;color: var(--dark-theme-color);"><?=$book_result1["title"]?></h1>
        <div class="ps-3 mt-2" style="color: var(--medium-theme-color)">
          <p>By <?=$author["author_name"]?></p>
          <p>ISBN: <?=$book_result1["isbn"]?></p>
          <p>Published <?=$book_result1["published_date"]?></p>
          <p>Genre: <?=$book_result2["genre"]?></p>
          <p><?=$book_result1["available_count"]?> available</p>
        </div>
        <div class="ps-3 mt-2" style="color: var(--medium-theme-color)">
          <button class="btn btn-dark w-50" type="button" id="edit">Edit</button>
          <button class="btn btn-dark w-50 mt-2" type="button" id="remove">
            <a href="<?=$this->base_url?>/index.php?page=book&command=remove_book&book=<?=$isbn?>" style="text-decoration: none;color:white;">
              Remove Book
            </a>
          </button>
          <button class="btn btn-dark w-50 mt-2" type="button" id="checkout">Check out</button>
          <button class="btn btn-dark w-50 mt-2" type="button" id="review">Rate/Review</button>
        </div>
    </section>
    <section class="col-5 mt-3 d-flex flex-column ms-3 p-4" style="border-top: solid 2px var(--light-theme-color);">
        <h1 style="color: var(--dark-theme-color)">Reviews</h1>
        <?php 
        foreach ($reviews as $review) {
            echo "
                <div class='card col-4 mb-2' style='width: 18rem;'>
                    <div class='card-body'>
                    <h5 class='card-title'>{$review['username']}</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>{$review['date']}</h6>
                    <h6 class='card-subtitle mb-2 text-muted'>Rating: {$review['rating']}</h6>
                    <p class='card-text'>
                        Comment: {$review['comments']}
                    </p>
                    </div>
                </div>
            ";
        }
        ?>
    </section>

</section>
<script>
</script>
<?php include ('views/footer.php'); ?>
