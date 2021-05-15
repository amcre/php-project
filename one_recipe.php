<!doctype html>
<html>
<head> 
<title>Recipe</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
    <div class="homeDiv">
        <h1>RECIPES</h1>
        <h2>Find new delicious recipes!</h2>
    </div>

    <button id="goBack" onclick="goBack()"><i>⇦ Go Back</i></button>
    <script>
    function goBack() {
    window.history.back();
    }
    </script>

    <div id="recipeBox">
        <img id="recipeImg" src="img/food.jpeg">
        <h3>Heading of recipe</h3>

        <div id="instructionsBox">
            <p id="ingredientsDiv">
                1 dl milk<br>
                2 cl oil<br>
                2 cl oil<br>
                2 cl oil<br>
                2 cl oil<br>
            </p>
            <p id="instructionsDiv">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta 
                sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia 
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui 
                dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora 
                incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum 
                exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
                vel eum iure reprehenderit qui in ea voluptate velit
                esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
            </p>
        </div>
        <div id="recipeButton">
        <button id="saveRecipe">SAVE RECIPE</button>
        </div>
    </div>

    <!---ska läggas till kommentarsektion-->
  </body>
</html>