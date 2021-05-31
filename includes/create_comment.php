<?php
 session_start();
 include "config.php";
?>

<?php

    $user = $_SESSION["username"];
    $userId = $_SESSION["userId"];

    if ($_SESSION["username"] != "") {
        echo $_SESSION['userip'];
        echo $_SERVER['REMOTE_ADDR'];
        if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) {
            session_unset();
            session_destroy();
            header("LOCATION: login.php");
        }
    } else {
        header("LOCATION: login.php");
        echo "You are not logged in";
    }


    if (isset($_POST['submit'])) {
        if ($_POST['comment'] != "") {

            $comment = $_POST['comment'];
            $comment = htmlentities($comment)
            $comment = mysqli_real_escape_string($db, $comment);

            if ($_GET['id']) {
                $query = "INSERT INTO `comments` ( authorId, recipeId, comment ) VALUES ( '$userId', '$recipeId', '$comment' )";
                mysqli_query($db, $query);

            } else if ($_GET['ida']) {
                $query = "INSERT INTO `comments` ( authorId, recipeIdAPI, comment ) VALUES ( '$userId', '$recipeId', '$comment' )";
                mysqli_query($db, $query);
            }

            $previousPage = $_SERVER['HTTP_REFERER'];
            header("LOCATION: $previousPage");  

        }
    }

?>