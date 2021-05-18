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
        echo "ip adress is not correct";
        header("LOCATION: login.php");
    }
} else {
    header("LOCATION: login.php");
    echo "You are not logged in";
}


if (isset($_POST['submit'])) { 
    echo "1";

    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
  
  $filename = $_FILES["image"]["name"]; 
  $tempname = $_FILES["image"]["tmp_name"];     
  $folder = "../recipeImg/".$filename; 

  $ext = strtolower(substr($_FILES['image']['name'],strrpos($_FILES['image']['name'], '.') + 1));
  $extAllowed = array("jpg", "jpeg", "png");

  if (!in_array($ext, $extAllowed)) {
    header("Location: ../upload_recipe.php?upload=ext&ext=$ext");
  } else {

    if (($_FILES['image']['size'] <= 20000000) && ($_FILES["image"]["size"] != 0)) {
      //$query = "INSERT INTO `images` (imgName) VALUES ('$filename')"; 
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
//$result = mysqli_query($db, "SELECT * FROM images");


?>