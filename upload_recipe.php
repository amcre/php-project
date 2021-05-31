<!doctype html>
<html>
<head> 
<title>Upload recipe</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
<script>


</script>
  <body>
    <div id="uploadDiv">
        <h2>Upload a recipe of your<br>own for others to try out!</h2>
        <form action="includes/upload_recipe.php" id="uploadForm" method="POST" enctype="multipart/form-data">
          <label class="label" for="title"><b>TITLE:</b></label><br>
          <input type="text" id="title" name="title" placeholder=""><br><br>
          
          <label class="label" for="ingredients"><b>INGREDIENTS:</b></label><br>
          <textarea class="input" type="text" id="ingredients" name="ingredients" placeholder=""></textarea><br><br>

          <label class="label" for="instructions"><b>INSTRUCTIONS:</b></label><br>
          <textarea class="input" id="instructions" type="text" name="instructions" placeholder="" ></textarea><br>

          <label class="label" for="image"><b>IMAGE:</b></label><br>
          <input class="input" id="image" type="file" name="image">
          
          <button id="submit" type="submit" name="submit" value="Submit">Upload recipe</button>
        </form> 
      </div>

<?php

/* if (isset($_POST['submit']) && $_POST['title'] != null && $_POST['ingredients'] != null && $_POST['instructions'] != null) {

  $title = $_POST['title'];
  $ingredients = $_POST['ingredients'];
  $instructions = $_POST['instructions'];

  $query = "INSERT INTO `recipes` (title, ingredients, instructions) VALUES ('$title', '$ingredients', '$instructions')";

} */


?>

<!-- <script>
function myFunction(event) {
  var x = event.which || event.keyCode;
  if (x == 13) {
    event.preventDefault();
    var test = document.querySelector('#ingredients');
    test.value = test.value + '\n';
    console.log(test.value);
  }
  
}
</script> -->

  </body>
</html>