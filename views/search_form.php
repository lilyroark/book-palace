<?php include ('views/header.php'); ?>

<section class="container mt-3">
  <div>
    <form id='search-form' action="" method="post">
      <div class="d-flex justify-content-end align-items-center">
        <div class="me-3 form-check form-switch">
          <input class="form-check-input" id='available_only' name='available_only' type="checkbox" <?= $available_only ? "checked" : ""?>/>
          <label for="available_only" class="form-label me-1">Available only</label>
        </div>

        <input class="form-control w-75 me-3" type="text" name="keyword" id="keyword" style="border-color: var(--light-theme-color);color: var(--dark-theme-color)">

        <!-- Search Authors    : <input type="text" name="keyword" id="keyword"> -->
        <!-- Display Name: <input type="text" name="displayName">
        Last Name: <input type="text" name="password">
        Age: <input type="text" name="email"> -->
        <input class="btn btn-dark" type="submit" value="Search"/>
      </div>
      <div class="d-flex justify-content-end mt-2">
        <span class="me-3">Search By : </span>
        <input class="form-check-input" id='by-title' name='by' type="radio" checked="true" value="title"/>
        <label for="by-title" class="form-label mx-1">Title</label>
        <input class="form-check-input" id='by-author' name='by' type="radio" value="author"/>
        <label for="by-author" class="form-label mx-1">Author</label>
      </div>
    </form>

    <div class="d-flex justify-content-end">
      <button class="btn btn-dark" id="back5" onclick="decrement5()" ><<</button>
      <button class="btn btn-dark mx-1" id="back" onclick="decrement()" ><</button>
      <button class="btn btn-dark mx-1" id="next" onclick="increment()" >></button>
      <button class="btn btn-dark" id="next5" onclick="increment5()" >>></button>
    </div>
  </div>

  <div class="container-fluid p-0 row mt-3">
    <div class="col-2">
      <div>
        <h6 style="color: var(--dark-theme-color)">Order By:</h6>
        <input class="form-check-input" id="pub-date" name="order" type="radio" value="pub_date"/>
        <label for="pub-date" class="form-label mx-1">Publication Date</label></br>
        <input class="form-check-input" id="popularity" name="order" type="radio" value="popularity"/>
        <label for="popularity" class="form-label mx-1">Popularity</label>
      </div>
      <div>
        <h6 style="color: var(--dark-theme-color)">Filter By:</h6>
        <input class="form-check-input" id="available" name="available" type="checkbox" value="available"/>
        <label for="available" class="form-label mx-1">Available Only</label></br>
        <input class="form-check-input" id="not-in-mybooks" name="not-in-mybooks" type="checkbox" value="not-in-mybooks"/>
        <label for="not-in-mybooks" class="form-label mx-1">Not in My Books</label>
      </div>
    </div>
    <div class="col-10 row justify-content-between" id='search_results'>
    <?php
    foreach($search_result as $book) {
      $isbn = $book["isbn"];
      echo "
          <div class='card col-4 mb-2' style='width: 18rem;'>
            <div class='card-body'>
              <h5 class='card-title'>{$book["title"]}</h5>
              <h6 class='card-subtitle mb-2 text-muted'>ISBN: {$book["isbn"]}</h6>
              <p class='card-text'>
                published date: {$book["isbn"]}</br>
                available count: {$book["available_count"]}
              </p>
              <a href='{$this->base_url}/index.php?page=book&command=book_detail&book={$isbn}' class='card-link' style='color: var(--medium-theme-color)'>Detail</a>
            </div>
          </div>
      ";
    }
    ?>
    </div>
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript">
var page=1;

// add favorites and list favorite view, copy setup or areeba;s displays, select by author
var searchBy = $('input[name=by]:checked').val();
var input = $('#keyword').val();
var available = document.getElementById('available_only').checked;

function addFav(x){
  var isbn = x.value;
  var username ="AbelMaclead";
  console.log(x.checked);
  $.post('../controllers/addFavorite.php',{checked:x.checked,isbn:isbn, username:username}, function(data){
    // $("#search_results").html(data);
    console.log(data);
    console.log("returned");

           }); 
    }
    function increment() {
      console.log(page);
      var currPage =document.getElementById('search_results').innerHTML
        // console.log(currPage);
        // document.getElementById("button_results").innerHTML = page+1;
        page = page +1
        var username ="AbelMaclead";



      console.log(searchBy);
      console.log(available);
      $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy, input:input, available:available, page:page}, function(data){
        $("#search_results").html(data);
        var newPage =document.getElementById('search_results').innerHTML
          //  console.log("new data");
          //  console.log(data);
          if(currPage ==newPage){
            page = page -1           }
              //  page=data
           });      
      };

      function increment5() {
        console.log(page);
        // document.getElementById("button_results").innerHTML = page+5;
        var currPage =document.getElementById('search_results').innerHTML
          page = page +5
          var username ="AbelMaclead";

        $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data, data2){
          $("#search_results").html(data);
          var newPage =document.getElementById('search_results').innerHTML
            //  var a = JSON.parse(data);
            if(currPage ==newPage){
              console.log("same stuff");
              page = page -5           }
              //  page=data
           });      
      };
      function decrement() {
        var username ="AbelMaclead";
        console.log(page);
        var currPage =document.getElementById('search_results').innerHTML.replace(/&amp;/g, "&")
          // document.getElementById("button_results").innerHTML = page-1;
          page = page -1
          if(page <1){
            page=1
      }
      // console.log(page);


           $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data){
             $("#search_results").html(data);
             //  page=data
           });
      };
      function decrement5() {
        var username ="AbelMaclead";
        console.log(page)
          var currPage =document.getElementById('search_results').innerHTML.replace(/&amp;/g, "&")
          // document.getElementById("button_results").innerHTML = page-5;
          page = page -5
          if(page <1){
            page=1
      }


           $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data){
             $("#search_results").html(data);
             //  page=data
           });
      };

      $(document).ready(function(){
        var input = "";
        var page=1
          var username ="AbelMaclead";
        $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data){
          $("#search_results").html(data);
           });
           return false;
      });

      /*
       * $(function () {
       *   $("#search-form").bind('submit',function() {
       *     input = $('#keyword').val();
       *     available = document.getElementById('available_only').checked;
       *     searchBy = $('input[name=by]:checked').val()
       *       var page=1;
       *     var username ="AbelMaclead";
       *     $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data){
       *       $("#search_results").html(data);
       *      });
       *      return false;
       *   });
       * });
       */
  </script>
</section>

<?php include ('views/footer.php'); ?>
