<?php
 session_start();
 include "config.php";
?>

<!doctype html>
<html>
<head> 
<title>My Page</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body> <!--Ta bort bilden?-->
    <div id="imageDiv">
        <img id="image" src="img/persona.png">
    </div>
    <div class="mypageDiv">
        <div class="profile">
            <h3 >@USER_NAME</h3>
            <h2>My saved recipes</h2>
        </div>
        <div class="upload">
            <h2>Upload your own recipe<br>for others to try!</h2>
            <button class="uploadButton">UPLOAD</button>
        </div>
    </div>

    <?php
    
    $user = $_SESSION["username"];
    $userId = $_SESSION["userId"];

    if ($_SESSION["username"] != "") {
        echo "You are logged in as $user";
        echo $_SESSION['userip'];
        echo $_SERVER['REMOTE_ADDR'];
        if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) {
            echo "ip adress is not correct";
            header("LOCATION: login.php");
        }
    } else {
        header("LOCATION: login.php");
        echo "You are not logged in";
    }

?>

<div class="savedContainer">

<?php

    $query = "SELECT * FROM `userRecipes` LEFT OUTER JOIN `recipes` ON recipes.recipeId = userRecipes.recipeId WHERE `userID` = $userId";

    $stmt = $db->prepare($query);
    $stmt->bind_result($userId, $recipeId, $recipeApi, $recipeId, $title, $ingredients, $instructions, $image, $authorId);
    $stmt->execute();
    
        while($stmt->fetch()) {
    
            if ($recipeApi != null) {
                $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://tasty.p.rapidapi.com/recipes/detail?id=$recipeApi",
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

                echo "<a href='one_recipe.php?ida=$recipeApi'>";
                    echo "<div style=\"background-image: url('$imgName'); background-repeat: no-repeat; background-size: cover;\" class='savedBox'>";
                        echo "<div>";
                            echo "<h3>$recipeTitle</h3>";
                        echo "</div>";
                    echo "</div>";
                echo "</a>";
    
        }  
            } else if ($recipeId != null) {
    
                $imgName = "<a href='single.php?id=$recipeId'><img src='recipeImg/$image' ></a>";


                echo "<a href='one_recipe.php?id=$recipeId'>";
                    echo "<div style=\"background-image: url('recipeImg/$image'); background-repeat: no-repeat; background-size: cover;\" class='savedBox'>";
                        echo "<div>";
                            echo "<h3>$title</h3>";
                        echo "</div>";
                    echo "</div>";
                echo "</a>";
    
            }
    
        }
    
    $stmt->close();




    ?>

</div>


  </body>
</html>
