<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Palace | Friends</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Team">
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
      <form>
        user can search for new friends here
      </form>
      <ul>
      <?php
      for (friend in friends) {
      ?>
        <li>friend</li>
        <p> make each li friend clickable to view the friend's books </p>
      <?php
      }
      ?>
      </ul>
    </section>
  </body>
</html>
