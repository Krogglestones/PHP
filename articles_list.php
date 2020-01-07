<?php

  $title = "Articles";
  include 'includes/header.php';
  include 'includes/functions.php';
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
  <h1>Article page</h1>

  <p>This is a list of articles</p>

  <?php

    $db = db_connect();
    $msg = $_GET["msg"];
    $sql = "SELECT * FROM articles";

    $result = $db->query($sql);
    //        print_r($result);
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


    while (list($article_id, $title, $author, $article_text, $date_posted, $created_at, $modified_at) = $result->fetch_row()) {

      // change title's anchor tag to link to show page.
      echo "<tr><td><a href=\"/article.php?id=$article_id\">$title</a></td>
              <td>$author</td>
              <td>$date_posted</td>";
      if (isset ($_SESSION['email'])) {
        echo "<td><a href='article_delete.php?id=$article_id'>DELETE</a></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    if (isset ($_SESSION['email'])) {
      echo "<a href='/article_new.php'>ADD NEW ARTICLE</a>";
    }
  ?>

</div>
<?php

  include 'includes/footer.php';

?>
