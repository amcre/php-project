<!doctype html>
<html>
<head> 
<title>Page title</title>
 <meta charset="utf-8" /> 
 <link rel="stylesheet" tyles="text/css" media="screen" href="css/style.css">
</head> 
  <body>
    <footer>
        
        <div id="footerbox">
          <div>
            <ul id="navbar_footer">
              <li class="navItem_footer"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "home.php")? "active" : "" ?>"
            href="home.php">HOME</a></li>
            <li class="navItem_footer"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "recipes.php")? "active" : "" ?>"
            href="recipes.php">RECIPE</a></li>
            <li class="navItem_footer"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "my_page.php")? "active" : "" ?>"
            href="my_page.php">MY PAGE</a></li>
            <li class="navItem_footer"><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "login.php")? "active" : "" ?>"
            href="login.php">LOGIN</a></li>
          </ul>
          </div>
            <p id="copyright">Copyright © 2020. All rights reserved. 
                No part of this publication may be reproduced, distributed, or transmitted in any form or by any means.
            </p>
        </div>
    
      </footer>
  </body>
</html>