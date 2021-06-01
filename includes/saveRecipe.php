<?php

session_start();
 include "../config.php";
?>

<?php

$user = $_SESSION["username"];
$userId = $_SESSION["userId"];

if ($_SESSION["username"] != "") {
    echo "You are logged in as $user";
    echo $_SESSION['userip'];
    echo $_SERVER['REMOTE_ADDR'];
    if (session_id() !== $_COOKIE['PHPSESSID']) {
        header("LOCATION: login.php");
    }
    if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) {
        session_unset();
        session_destroy();
        header("LOCATION: login.php");
    }
} else {
    header("LOCATION: login.php");
}



if ($_POST['id']) {
    $recipeId = $_POST['id'];
} else if ($_POST['ida']) {
    $recipeId = $_POST['ida'];
}

?>

<?php

    $userId = $_SESSION["userId"];

    $query = "SELECT * FROM `userRecipes` WHERE `userId` = $userId";

    $stmt = $db->prepare($query);
    $stmt->bind_result($uId, $rId, $raId);
    $stmt->execute();
    

    while($stmt->fetch()) {

        if ($_POST['id']) {
            
            if ($uId == $userId && $rId == $recipeId):
                    $duplicate = "true";
            endif;

        } else if ($_POST['ida']) {
            
            if ($uId == $userId && $raId == $recipeId): 
                $duplicate = "true";
            endif;
        }
    }

    $stmt->close();

    if ($_POST['id'] && $duplicate != "true") {
        $query = "INSERT INTO `UserRecipes` (userId, recipeId) VALUES ('$userId', '$recipeId')";
        mysqli_query($db, $query);
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("LOCATION: $previousPage");  
    }
    else if ($_POST['ida'] && $duplicate != "true") {
        $query = "INSERT INTO `UserRecipes` (userId, recipeIdAPI) VALUES ('$userId', '$recipeId')";
        mysqli_query($db, $query);
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("LOCATION: $previousPage");  
    }

    



?>