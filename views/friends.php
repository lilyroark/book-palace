<?php include ('views/header.php'); ?>

<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">My Friends</h2>
  <div class="row">
    <div class="col-5">
      <ul class="list-group list-group-flush w-75 p-3">
      <?php
      if (empty($friends)) {
        echo "<p class='list-group-item'>No Friend</p>";
      } else {
        foreach ($friends as $friend) {
          echo "<li class='friend-list-item list-group-item list-group-item-action'>{$friend['friend_username']}</li>";
        }
      }
      ?>
      </ul>
      <a class="btn btn-dark mt-2" href="<?=$this->base_url?>/index.php?page=account&command=add_friends">Add new friend</a>
    </div>
    <div id="friend-books" class="col-7 d-flex flex-wrap">
    </div>
  </div>
</section>
<script>
$(".friend-list-item").click(function() {
  const username = $(this)[0].innerHTML;
  $("#friend-books").empty();
  let friendBooks = [];
  $.getJSON(`?page=account&command=export&friend_username=${username}`, (result) => {
    friendBooks = result;
    if (friendBooks.length === 0) {
      $("#friend-books").append("<p>This user doesn't any favorited book</p>")
    } else {
      for (const book of friendBooks) {
        $("#friend-books").append(`
          <div class='card col-4 ms-3 mb-3' style='width: 18rem;'>
            <div class='card-body'>
              <h5 class='card-title'>${book["title"]}</h5>
              <h6 class='card-subtitle mb-2 text-muted'>ISBN: ${book["isbn"]}</h6>
              <p class='card-text'>
                published date: ${book["isbn"]}</br>
                available count: ${book["available_count"]}
              </p>
              <a href='<?=$this->base_url?>/index.php?page=book&command=book_detail&book=${book["isbn"]}' class='card-link' style='color: var(--medium-theme-color)'>Detail</a>
            </div>
          </div>
        `);
      }
    }
  });
})
</script>

<?php include ('views/footer.php'); ?>
