<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Palace</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Sehoan (Mike) Choi">
    <meta name="description" content="friends list">
    <meta name="keywords" content="friends">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">
  </head>
  <body>
  <!--Top Navigation / Header bar-->
    <header>
      <h1>The Book Palace</h1>
      <nav>
        <li>Home</li>
        <li>My Books</li>
        <li>Add New Book</li>
        <li>By Popularity</li>
      </nav>
    </header>
    <!--Main Content-->
    <section>
      <a href="<?=$this->base_url?>/index.php?page=account&command=friends">Return to list</a>
      <form action="" method="POST">
        <div>
          <label for="dspName">Add a new friend to the list below by searching with a display name or an email</label>
          <input type="text" id="keyword" name="keyword"/>
        </div>
        <div>
          <button type="submit">Search</button>
        </div>
      </form>
      <div id="content">
        <ul>
          <?php
          foreach ($search_result as $pair) {
          ?>
          <li>
          <?php
            foreach ($pair as $attr => $value) {
          ?>
            <p><?=$attr?>: <?=$value?></p>
          <?php
            }
          ?>
            <a href="<?=$this->base_url?>/index.php?page=account&command=add_friends&name=<?=$pair["displayname"]?>">Add</a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </section>
  </body>
</html>
