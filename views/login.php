<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Palace</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lily Roark">
    <meta name="description" content="Check out, view books">
    <meta name="keywords" content="Learning">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">
  </head>
  <body>
  <!--Top Navigation / Header bar-->
    <header>
    </header>
    <!--Main Content-->
    <section>
      <h1><a href="<?=$this->base_url?>">The Book Palace</a></h1>

      <form id="login_form" name='login' action="<?=$this->base_url?>/index.php?page=account&command=login" onsubmit="return validate();" method="post">
        <div>
          <label for="dspName">Display Name</label>
          <input type="text" id="dspName" name="dspName"/>
        </div>
        <div>
          <label for="username">Username</label>
          <input type="text" id="username" name="username"/>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email"/>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" id="password" name="password"/>
        </div>
        <div>
          <button type="submit">Log in / Create Account</button>
        </div>
      </form>
      <p style="color: red;"><?= $error_msg ?></p>
      <p id="welcome-msg">Browse and checkout books!</p>
    </section>
    <!--Footer-->
    <footer>
      <div>
        <small>
          © 2021 Lily Roark, Mike Choi, Areeba Kausar, Selena Johnson
        </small>
      </div>
    </footer>
    <script>
      function validate() { // validates login form username
        let user = document.forms['login']['username'].value;
        var reg = new RegExp("[ -~]"); // checks all ASCii characters
        if(!reg.test(user)) {
          alert("Please don't use unicode characters!!"); //non ascii characters are not allowed
          return false;
        } else {
          return true;
        }
      }
    </script>
  </body>
</html>
