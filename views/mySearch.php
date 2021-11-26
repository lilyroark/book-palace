
<?php
?>
<html>
  <body >
  <h2>Search Books</h2>
  <BR>
  <form id='lets_search' action="" method="post">
  <input type="text" name="str" id="str">

  <!-- Search Authors    : <input type="text" name="str" id="str"> -->
  <!-- Display Name: <input type="text" name="displayName">
  Last Name: <input type="text" name="password">
  Age: <input type="text" name="email"> -->
  <input type="Submit">
  <input id='avl'name='avl' type="checkbox">available only</input>
  <div>
  Search By: 
  <input id='bytitle'name='by' type="radio" checked="true" value="title">title </input>
  <input id='byauthor'name='by' type="radio" value="author">author</input>
  </div>
  </form>
  <button id="back5" onclick="decrement5()" ><<</button>
  <button id="back" onclick="decrement()" ><</button>
  <!-- <div id='button_results'></div> -->
  <button id="next" onclick="increment()" >></button>
  <button id="next5" onclick="increment5()" >>></button>

  <div id='search_results'></div>
  </body>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <style>
    .card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width:50%;
  }

  /* On mouse-over, add a deeper shadow */
  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  /* Add some padding inside the card container */
  .container {
    padding: 2px 16px;
  }
  </style>
  <script type="text/javascript">
var page=1;

// add favorites and list favorite view, copy setup or areeba;s displays, select by author
var searchBy = $('input[name=by]:checked').val();
var input = $('#str').val();
var available = document.getElementById('avl').checked;

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

    $(function () {
      $("#lets_search").bind('submit',function() {
        input = $('#str').val();
        available = document.getElementById('avl').checked;
        searchBy = $('input[name=by]:checked').val()
          var page=1;
        var username ="AbelMaclead";
        $.post('../controllers/mySearchAction.php',{username:username,searchBy:searchBy,available:available,input:input, page:page}, function(data){
          $("#search_results").html(data);
         });
         return false;
      });
    });
  </script>
</html>
