<!doctype html>
<html>
<head> 
<title>Page title</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
    <div id="header">
        <h1 id="headertext">RECIPE-PINTEREST</h1>
     <nav> 
         <ul id="navbar">
             <li class="navItem"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "home.php")? "active" : "" ?>"
            href="home.php">HOME</a></li>
            <li class="navItem"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "recipes.php")? "active" : "" ?>"
            href="recipes.php">RECIPE</a></li>
            <li class="navItem"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "my_page.php")? "active" : "" ?>"
            href="my_page.php">MY PAGE</a></li>
            <li class="navItem"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "login.php")? "active" : "" ?>"
            href="login.php">LOGIN</a></li>
         </ul>
     </nav>
     </div>
  </body>
</html>
