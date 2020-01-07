<?php


?>

<!-- Nav -->
<nav id="nav">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="contactus.php">Contact US</a></li>
    <li><a href="products.php">Products</a></li>
    <li><a href="newest_article.php">Articles</a></li>
    <li><a href="blog_list.php">Blogs</a></li>
    <li><a href="calendar.php">Calendar</a></li>
    <li><a href="preferences.php">Preferences</a></li>
    <?php
      if (isset ($_SESSION['email'])) {
        echo '<li><a href="logout.php">Log Out</a></li>';
      } else {
        echo '<li><a href="login.php">Log In</a></li>';
      }
    ?>
  </ul>
</nav>

