<?php include ('views/header.php'); ?>

<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">My Friends</h2>
  <div>
    <ul class="list-group list-group-flush w-25 p-3">
    <?php
    if (empty($friends)) {
      echo "<p class='list-group-item'>No Friend</p>";
    } else {
      foreach ($friends as $friend) {
        echo "<a class='list-group-item list-group-item-action'>{$friend['friend_username']}</a>";
      }
    }
    ?>
    </ul>
    <a class="btn btn-dark mt-2" href="<?=$this->base_url?>/index.php?page=account&command=add_friends">Add new friend</a>
  </div>
</section>

<?php include ('views/footer.php'); ?>
