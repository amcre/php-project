<?php
 session_start();
 $day = new DateTime('+1 day');
 setcookie('PHPSESSID', session_id(), $day->getTimeStamp(), '/', null, null, true);
 include "config.php";
?>

<!doctype html>
<html>
<head> 
<title>Login</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
     <form id="loginForm" action="" method="POST">
        <h3 id="loginHeader">PLEASE LOGIN</h3>

        <label for="username"></label>
        <input class="inputLogin" type="text" name="username" placeholder=" Username" ><br><br>

        <label for="password"></label>
        <input class="inputLogin" type="password" name="password" placeholder=" Password" ><br><br>

        <button id="loginBtn" type="submit" name="submit" value="Login" >LOGIN</button>

     </form>

     <?php

      $user = $_SESSION["username"];

      if ($_SESSION["username"] != "") {
         echo "You are logged in as $user";
      } else {
         echo "You are not logged in";
      }

      echo $_SESSION["username"];

      if(isset($_POST['username']) && isset($_POST['password'])) {
         $username = $_POST['username'];
         $password = $_POST['password'];

         $query = "SELECT * from `user` WHERE `username`= ? AND `password` = ?";

         $stmt = $db->prepare($query);
         $stmt->bind_param('ss', $username, MD5($password));
         $stmt->bind_result($userId, $user, $pw);
         $stmt->execute();
         while ($stmt->fetch()) {

            $_SESSION["username"] = "$user";
            $_SESSION["userId"] = "$userId";
            $_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];

            echo $_SESSION["username"];
            echo $_SESSION['userip'];
            echo $_SERVER['REMOTE_ADDR'];

            header("location: my_page.php");
         }

         $stmt->close();
         
      }

      ?>
     
  </body>
</html>