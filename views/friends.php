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
