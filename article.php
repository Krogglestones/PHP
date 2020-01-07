<?php
  //ob_start();
  $title = "Article";
  include 'includes/header.php';
  include 'includes/functions.php';

?>


<!-- Main Wrapper -->
<div id="main-wrapper">
  <h1>Single article page</h1>


  <?php
    $db = db_connect();
    $id = mysqli_real_escape_string( $db, $_GET["id"]);

    $sql = "SELECT * FROM articles WHERE article_id=$id";
    $result = $db->query($sql);
    ob_clean();
    list($article_id, $title, $author, $article_text, $date_posted, $created_at, $modified_at) = $result->fetch_row();

    $detail = <<<END_OF_DETAIL

  <a href="/articles_list.php">Back To All Articles</a>


<p>This is a show page for an individual article</p>

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

    include 'includes/footer.php';
    ob_end_flush();
  ?>

