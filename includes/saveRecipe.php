<?php

session_start();
 include "../config.php";
?>

<?php

if ($_POST['id']) {
    $recipeId = $_POST['id'];
} else if ($_POST['ida']) {
    $recipeId = $_POST['ida'];
}

?>

<?php

    $userId = $_SESSION["userId"];
    echo $userId;

    $query = "SELECT * FROM `userRecipes` WHERE `userId` = $userId";

    $stmt = $db->prepare($query);
    $stmt->bind_result($uId, $rId, $raId);
    $stmt->execute();
    

    while($stmt->fetch()) {

        if ($_POST['id']) {
            
            if ($uId == $userId && $rId == $recipeId):
                    $duplicate = "false";
            endif;

        } else if ($_POST['ida']) {
            
            if ($uId == $userId && $raId == $recipeId): 
                $duplicate = "false";
            endif;
        }
    }

    $stmt->close();

    if ($_POST['id'] && $duplicate != "false") {
        $query = "INSERT INTO `UserRecipes` (userId, recipeId) VALUES ('$userId', '$recipeId')";
        mysqli_query($db, $query);
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("LOCATION: $previousPage");  
    }
    else if ($_POST['ida'] && $duplicate != "false") {
        $query = "INSERT INTO `UserRecipes` (userId, recipeIdAPI) VALUES ('$userId', '$recipeId')";
        mysqli_query($db, $query);
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("LOCATION: $previousPage");  
    }

    



?>