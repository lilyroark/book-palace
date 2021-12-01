<?php include ('views/header.php'); ?>

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
              <li><a class="dropdown-item" href="<?=$this->base_url?>/index.php?page=account&command=reviews">My Reviews</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add New Book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">By Popularity</a>
          </li>
        </ul
      </div>
    </div>
  </nav>
</header>
<section class="container mt-3">
  <h2 class="pb-3 w-50 border-bottom border-3 fit-content" style="color: var(--medium-theme-color);border-color: var(--light-theme-color) !important;">Search/Add Friend</h2>

  <form action="" method="POST">
    <div class="row p-4">
      <input class="col-4 form-control w-25" type="text" id="keyword" name="keyword"/>
      <button class="col-1 mx-4 btn btn-primary" type="submit">Search</button>
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
