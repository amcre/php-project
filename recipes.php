<?php
 session_start();
 include "config.php";
?>

<!doctype html>
<html>
<head> 
<title>Recipes</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
    <div class="homeDiv">
        <h1>RECIPES</h1>
        <h2>Find new delicious recipes!</h2>
    </div>
    <div id="searchField">
        <form action="" method=GET>
            <input id="searchRecipe" type="text" name="query" placeholder="Search...">
            <button id="search" type="search" name="search" value="Search">SEARCH</button>
        </form>
    </div>

    <div class="recipeContainer">

        <?php

        if ($_GET['query'] == null) {
            
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://tasty.p.rapidapi.com/recipes/list?from=0&size=20&tags=under_30_minutes",
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
            for ($i = 0; $i <= 20; $i++) {
     
                $imgName = $jsonArrayResponse[results][$i][thumbnail_url];
                $recipeId = $jsonArrayResponse[results][$i][id];
                $recipeTitle = $jsonArrayResponse[results][$i][name];


                echo "<a href='one_recipe.php?ida=$recipeId'>";
                    echo "<div style=\"background-image: url('$imgName'); background-repeat: no-repeat; background-size: cover;\" class='recipeBox'>";
                        echo "<div>";
                            echo "<h3>$recipeTitle</h3>";
                        echo "</div>";
                    echo "</div>";
                echo "</a>";
            }
            
        }    
        }
        
        ?>

        <?php
        if(isset($_GET['search'])) {
            $search = $_GET['query'];
            
            $search = htmlentities($string);
            $search = mysqli_real_escape_string($db, $string);
            
            $query = "SELECT * FROM `recipes` WHERE `title` LIKE '%$search%'";
        
            $stmt = $db->prepare($query);
            $stmt->bind_result($id, $title, $ingredients, $instructions, $img, $author);
            $stmt->execute();
        
            while($stmt->fetch()) {
                $imgName = "<a href='one_recipe.php?id=$id'><img src='recipeImg/$img' ></a>";
                $style = "background-image: url('recipeImg/$img')";


                echo "<a href='one_recipe.php?id=$id'>";
                    echo "<div style=\"background-image: url('recipeImg/$img'); background-repeat: no-repeat; background-size: cover;\" class='recipeBox'>";
                        echo "<div>";
                            echo "<h3>$title</h3>";
                        echo "</div>";
                    echo "</div>";
                echo "</a>";
                
            }
        
            $stmt->close();
        
            ?>
            <?php
            
            $curl = curl_init();
        
            $search = str_replace(' ', '%20', $search);
        
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://tasty.p.rapidapi.com/recipes/list?from=0&size=50&q=$search",
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
                for ($i = 0; $i <= 20; $i++) {
                    $imgName = $jsonArrayResponse[results][$i][thumbnail_url];
                    $recipeId = $jsonArrayResponse[results][$i][id];
                    $recipeTitle = $jsonArrayResponse[results][$i][name];

                    echo "<a href='one_recipe.php?ida=$recipeId'>";
                        echo "<div style=\"background-image: url('$imgName'); background-repeat: no-repeat; background-size: cover;\" class='recipeBox'>";
                            echo "<div>";
                                echo "<h3>$recipeTitle</h3>";
                            echo "</div>";
                        echo "</div>";
                    echo "</a>";
                }
                
            }    
        
        
        
        }

        ?>


    </div>

  </body>
</html>
