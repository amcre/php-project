<?php
 session_start();
 $day = new DateTime('+1 day');
 setcookie('PHPSESSID', session_id(), $day->getTimeStamp(), '/', null, null, true);
 include "config.php";
?>

<!doctype html>
<html>
<head> 
<title>Create Account</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
     <form id="loginForm" action="" method="POST">
        <h3 id="loginHeader">CreateAccount</h3>

        <label for="username"></label>
        <input class="inputLogin" type="text" name="username" placeholder=" Username" ><br><br>

        <label for="password"></label>
        <input class="inputLogin" type="password" name="password" placeholder=" Password" ><br><br>

        <button id="loginBtn" type="submit" name="submit" value="Login" >Create Account</button>

     </form>

     <?php
     
     if(isset($_POST['username']) && $_POST['password']) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = MD5($password);
    
        $query = "INSERT INTO `user` (username, password) VALUES ('$username', '$password')";
    
        mysqli_query($db, $query);

        header("location: login.php");
    
    }
     
     ?>


     </body>
</html>