<?php

  $title = "Articles";
  include 'includes/header.php';
  include 'includes/functions.php';
?>
<div id="main-wrapper">
  <?php

    $db = db_connect();
    $id = mysqli_real_escape_string( $db, $_GET["id"]);

    $sql = "SELECT * FROM articles ORDER BY date_posted DESC LIMIT 1";
    $result = $db->query($sql);
    ob_clean();
    list($article_id, $title, $author, $article_text, $date_posted, $created_at, $modified_at) = $result->fetch_row();


    if (isset ($_SESSION['email'])) {
      echo "<a href='article_new.php'>Create New Article</a><br/><br/>";
    }

    $detail = <<<END_OF_DETAIL

  <a href="/articles_list.php">Back To All Articles</a><br/>


  <h1>This is a show page for the newest article</h1><br/>

  <h3>ID:  $article_id</h3>
  <h4>TITLE:  $title</h4>
  <h5>AUTHOR:  $author</h5>
  <h5>TEXT:  $article_text</h5>
  <h5>DATE POSTED:  $date_posted</h5>
  <h5>DATE CREATED:  $created_at</h5>
  <h5>DATE MODIFIED:  $modified_at</h5>


END_OF_DETAIL;

    echo $detail;
    if (isset ($_SESSION['email'])) {
      echo "<a href='/article_update.php?id=$article_id'>EDIT INFO</a>";
    }
  ?>
</div>
<?php

  include 'includes/footer.php';

?>
