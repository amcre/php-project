<?php
 session_start();
 include "config.php";
 include "header.php";
?>

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

    <?php

    $username = $_SESSION['username'];

        if ($_GET['id']) {
            $recipeId = $_GET['id'];
        } else if ($_GET['ida']) {
            $recipeId = $_GET['ida'];
        }

    ?>

    <div id="recipeBox">

    <?php

        if ($_GET['id']) {

            $query = "SELECT * FROM `recipes` WHERE `recipeId` = $recipeId";

            $stmt = $db->prepare($query);
            $stmt->bind_result($id, $title, $ingredients, $instructions, $img, $authorId);
            $stmt->execute();

            while($stmt->fetch()) {

                echo "<img id='recipeImg' src='recipeImg/$img'>";
                echo "<h3>$Title</h3>";

                echo "<div id='instructionsBox'>";
                    echo "<p id='ingredientsDiv'>";
                        echo nl2br($ingredients);
                    echo "</p>";
                    echo "<p id='instructionsDiv'>";
                        echo nl2br($instructions);
                    echo "</p>";
                echo "</div>";

            }

            $stmt->close();

        }
    ?>

<?php

if ($_GET['ida']) {

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://tasty.p.rapidapi.com/recipes/detail?id=$recipeId",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: tasty.p.rapidapi.com",
            "x-rapidapi-key: 69b4d33628msh948b836e6dd1e71p161975jsn3ffca358d60f"
        ],
    ]);

    $response = curl_exec($curl);
    $jsonArrayResponse = json_decode($response, true);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $imgName = $jsonArrayResponse[thumbnail_url];
        $recipeTitle = $jsonArrayResponse[name];

        echo "<img id='recipeImg' src='$imgName'>";
        echo "<h3>$recipeTitle</h3>";

        echo "<div id='instructionsBox'>";
            echo "<p id='ingredientsDiv'>";
                foreach($jsonArrayResponse[sections] as $i) {
                    foreach($i[components] as $a) {
                        echo $a[raw_text];
                        echo "<br>";
                    }
                }
            echo "</p>";
            echo "<p id='instructionsDiv'>";
                foreach ($jsonArrayResponse[instructions] as $i) {
                    echo $i[display_text];
                    echo '<br>';
                }
            echo "</p>";
        echo "</div>";

    }  
}

?>
        <div id="recipeButton">
            <form action="includes/saveRecipe.php" method="POST">
                <?php
                    if ($_GET['id']) {
                        echo "<input type='hidden' name='id' value='$recipeId'>";
                    } else if ($_GET['ida']) {
                        echo "<input type='hidden' name='ida' value='$recipeId'>";
                    }
                ?>
                
                <input id="saveRecipe" name="saveBtn" type="submit" value="SAVE RECIPE">
            </form>
        </div>
    </div>
           
    <div class="commentDiv">
        <div>
        <h3 class="comment_h">Leave a comment about the recipe!</h3>
            <form class="commentForm" action="includes/create_comment.php" method="POST">
                    <?php 
                    if ($_GET['id']) {
                        echo "<input type='hidden' name='id' value='$recipeId'>";
                    } else if ($_GET['ida']) {
                        echo "<input type='hidden' name='ida' value='$recipeId'>";
                    }
                    ?>
                <input name="comment" id="comment" type="text" placeholder="What do you think...">
                <input id="saveRecipe" name="saveBtn" type="submit" value="PUBLISH COMMENT">
            </form> 
        </div> 
        
        <h3 class="comment_h">Comments:</h3>
        <div class="otherComments">

        <?php
        
        if ($_GET['id']) {
            $query = "SELECT commentId, authorId, recipeId, comment FROM `comments` WHERE recipeId = $recipeId";
        } else if ($_GET['ida']) {
            $query = "SELECT commentId, authorId, recipeIdAPI, comment FROM `comments` WHERE recipeIdAPI = $recipeId";
        }
        
        $stmt = $db->prepare($query);
        $stmt->bind_result($commentId, $authorId, $recipeId, $comment);
        $stmt->execute();
        
        while($stmt->fetch()) {
        
            echo "<div class='written_comment_message'><p>$comment<p></div>";        
        
        }
        
        ?>
            

        </div>        
    </div>

  </body>
</html>
<?php
include "footer.php";
?>