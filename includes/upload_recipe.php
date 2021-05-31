<?php
 session_start();
include '../config.php';


$user = $_SESSION["username"];
$userId = $_SESSION["userId"];

if ($_SESSION["username"] != "") {
    echo "You are logged in as $user";
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

    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    //Prevent XSS
    $title = htmlentities($title)
    $title = mysqli_real_escape_string($db, $title);
    $ingredients = htmlentities($ingredients)
    $ingredients = mysqli_real_escape_string($db, $ingredients);
    $instructions = htmlentities($instructions)
    $instructions = mysqli_real_escape_string($db, $instructions);
  
    $filename = $_FILES["image"]["name"]; 
    $tempname = $_FILES["image"]["tmp_name"];     
    $folder = "../recipeImg/".$filename; 

    //Check extension
    $ext = strtolower(substr($_FILES['image']['name'],strrpos($_FILES['image']['name'], '.') + 1));
    $extAllowed = array("jpg", "jpeg", "png");

    if (!in_array($ext, $extAllowed)) {
      header("Location: ../upload_recipe.php?upload=ext&ext=$ext");
    } else {
      //Check filesize
      if (($_FILES['image']['size'] <= 20000000) && ($_FILES["image"]["size"] != 0)) {
        $query = "INSERT INTO `recipes` (title, ingredients, instructions, image, authorId) VALUES ('$title', '$ingredients', '$instructions', '$filename', '$userId')";
        mysqli_query($db, $query); 

        if (move_uploaded_file($tempname, $folder))  {
            header("Location: ../upload_recipe.php?upload=true");
        }else{ 
            header("Location: ../upload_recipe.php?upload=false");
        }
      } else {
        header("Location: ../upload_recipe.php?upload=false&size=false");
      }
    }
        
  
} 


?>