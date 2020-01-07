<?php

  //  $title = "Blogs";
  include 'includes/header.php';
  include 'includes/functions.php';
?>
<div id="main-wrapper">
  <h1>Blog page</h1>

  <p>This is a list of blogs</p>

  <?php

    $db = db_connect();
    $msg = $_GET["msg"];
    $sql = "SELECT * FROM blogs";

    $result = $db->query($sql);
    //    print_r($result);
    echo "<br/>";
    $table = <<<END_OF_TABLE
<p>$msg</p>
<table>
  <tr>
    <th>Title</th>
    <th>Author</th>
    <th>Published Date</th>
  </tr>
END_OF_TABLE;

    echo $table;


    while (list($blog_id, $author, $date_posted, $blog_text, $blog_title) = $result->fetch_row()) {

      // change title's anchor tag to link to show page.
      echo "<tr><td><a href=\"/blog.php?id=$blog_id\">$blog_title</a></td>
              <td>$author</td>
              <td>$date_posted</td>";
      if (isset ($_SESSION['email'])) {
        echo "<td><a href='blog_delete.php?id=$blog_id'>DELETE</a></td>";
        echo "<td><a href='blog_email.php?id=$blog_id'>EMAIL</a></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    if (isset ($_SESSION['email'])) {
      echo "<a href='/blog_new.php'>ADD NEW BLOG</a>";
    }
  ?>

</div>
<?php

  include 'includes/footer.php';

?>
