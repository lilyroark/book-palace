<?php include ('views/header.php'); ?>

<section class="container mt-3 d-flex flex-row">
    <section class="container mt-3 d-flex flex-column">
        <h1 style="text-decoration: none;color: var(--dark-theme-color);"><?=$book_result1["title"]?></h1>
        <p>By <?=$author["author_name"]?></p>
        <p>ISBN: <?=$book_result1["isbn"]?></p>
        <p>Published <?=$book_result1["published_date"]?></p>
        <p>Genre: <?=$book_result2["genre"]?></p>
        <p><?=$book_result1["available_count"]?> available</p>
    </section>
    <section class="container mt-3 d-flex flex-column">
        <button type="button" id="edit"><a 
        href="<?=$this->base_url?>/index.php?page=book&command=edit_book&book=<?=$isbn?>">Edit</a></button>
        <button type="button" id="remove"><a 
        href="<?=$this->base_url?>/index.php?page=book&command=remove_book&book=<?=$isbn?>">Remove Book</a></button>
        <button type="button" id="checkout">Check out</button>
        <button type="button" id="review">Rate/Review</button>
    </section>
    <section class="container mt-3 d-flex flex-column">
        <h1>Reviews</h1>
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
