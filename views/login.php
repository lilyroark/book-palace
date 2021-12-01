<?php include ('views/header.php'); ?>

<section class="container mt-3 d-flex flex-column align-items-center">
  <h1><a href="<?=$this->base_url?>" style="text-decoration: none;color: var(--dark-theme-color);">The Book Palace</a></h1>
  <h3 class="mb-5" style="color: var(--medium-theme-color)">Welcome to your personalized library</h3>

  <form class="d-flex flex-column align-items-center" id="login_form" name='login' action="<?=$this->base_url?>/index.php?page=account&command=login" onsubmit="return validate();" method="post">
    <div>
      <label class="form-label" for="dspName">Display Name</label>
      <input class="form-control" type="text" id="dspName" name="dspName"/>
    </div>
    <div>
      <label class="form-label" for="username">Username</label>
      <input class="form-control" type="text" id="username" name="username"/>
    </div>
    <div>
      <label class="form-label" for="email">Email</label>
      <input class="form-control" type="email" id="email" name="email"/>
    </div>
    <div>
      <label class="form-label" for="password">Password</label>
      <input class="form-control" type="password" id="password" name="password"/>
    </div>
    <div class="mt-3">
      <button class="btn btn-dark" type="submit">Log in / Create Account</button>
    </div>
  </form>
  <p style="color: red;"><?= $error_msg ?></p>
  <p id="welcome-msg">Browse and checkout books!</p>
</section>
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
<?php include ('views/footer.php'); ?>
