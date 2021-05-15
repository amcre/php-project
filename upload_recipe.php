<!doctype html>
<html>
<head> 
<title>Upload recipe</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
    <div id="uploadDiv">
        <h2>Upload a recipe of your<br>own for others to try out!</h2>
        <form action="" id="uploadForm">
          <label class="label" for="title"><b>TITLE:</b></label><br>
          <input type="text" id="title" name="title" placeholder=""><br><br>
          
          <label class="label" for="ingredients"><b>INGREDIENTS:</b></label><br>
          <input class="input" type="text" id="ingredients" name="ingredients" placeholder=""><br><br>

          <label class="label" for="instructions"><b>INSTRUCTIONS:</b></label><br>
          <input class="input" id="instructions" type="text" name="instructions" placeholder="" ><br>
          
          <button id="submit" type="submit" value="Submit">Upload recipe</button>
        </form> 
      </div>
  </body>
</html>