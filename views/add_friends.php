<?php include ('views/header.php'); ?>

<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">Search/Add Friend</h2>

  <form action="" method="POST">
    <div class="row p-4">
      <input class="col-4 form-control w-25" type="text" id="keyword" name="keyword"/>
      <button class="col-1 mx-4 btn btn-dark" type="submit">Search</button>
      <a class="col-2 btn btn-warning" href="<?=$this->base_url?>/index.php?page=account&command=friends">Return to list</a>
      <label for="dspName" class="form-text">Add a new friend to the list below by searching with a display name or an email</label>
    </div>
    <div>
    </div>
  </form>
  <div class="ps-2">
    <ul class="list-group">
<?php
foreach ($search_result as $pair) {
  echo "<li class='list-group-item w-50 d-flex align-items-center justify-content-between'>";
  foreach ($pair as $attr => $value) {
    echo "<p>{$value}</p>";
  }
  echo "<a class='badge btn btn-dark' href='{$this->base_url}/index.php?page=account&command=add_friends&name={$pair['displayname']}'> Add </a>";
  echo "</li>";
}
?>
    </ul>
  </div>
</section>

<?php include ('views/footer.php'); ?>
