<?php
 session_start();
 include "config.php";
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
            "x-rapidapi-key: 75e932243fmshedc0c556d804bd0p11e5f6jsn391573816b46"
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

    <!---ska läggas till kommentarsektion-->
  </body>
</html>