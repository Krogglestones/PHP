<?php
  ob_start();
  //$title = "Articles";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

<!-- Main Wrapper -->
<div id="main-wrapper">
  <h1>Update page</h1>
<?php
  $db = db_connect();
  $id = mysqli_real_escape_string( $db, $_GET["id"]);
  $submit = $_POST["submit"];


  if (empty($submit)) {
    $sql = "SELECT * FROM articles WHERE article_id=$id";
    $result = $db->query($sql);
    list($article_id, $title, $author, $article_text, $date_posted, $created_at, $modified_at) = $result->fetch_row();
  } else {

    $title = mysqli_real_escape_string( $db, $_POST["title"]);
    $author = mysqli_real_escape_string( $db, $_POST["author"]);
    $article_text = mysqli_real_escape_string( $db, $_POST["article_text"]);
    $date_posted = mysqli_real_escape_string( $db, $_POST["date_posted"]);
    $created_at = mysqli_real_escape_string( $db, $_POST["created_at"]);
    $modified_at = mysqli_real_escape_string( $db, $_POST["modified_at"]);

    $found_error = false;
    if (empty($title)) {
      $title_error = "Title is required";
      $found_error = true;
    }
    if (empty($author)) {
      $author_error = "Author is required";
      $found_error = true;
    }
    if (empty($article_text)) {
      $text_error = "Text is required";
      $found_error = true;
    }
    if (!$found_error) {

      //format so the db will like it.
//    $date_posted = $date_posted->format("Y-m-d H:i:s");
//$created_at = $created_at->format("Y-m-d H:i:s");
      $modified_at = date_create();
      $modified_at = $modified_at->format("Y-m-d H:i:s");


      $sql = "UPDATE articles SET title='$title', author='$author', article_text='$article_text', date_posted='$date_posted', created_at='$created_at', modified_at=CURRENT_TIMESTAMP WHERE article_id=$id";
      echo "SQL: $sql<br/>";
      $result = $db->query($sql);
      echo "updated";
      ob_clean();
      header("Location: /article.php?id=$id");
    }
  }

    $form = <<<END_OF_FORM
  <h1>Edit Here</h1>
  <form method="POST" action="/article_update.php?id=$id">

    TITLE: <input type="text" name="title" value="$title"><span class="red">$title_error</span><br/>
    AUTHOR: <input type="text" name="author" value="$author"><span class="red">$author_error</span><br/>
    TEXT: <input type="text" name="article_text" value="$article_text"><span class="red">$text_error</span><br/>
    DATE POSTED: <input type="datetime-local" name="date_posted" value="$date_posted"><br/>
    <input type="submit" name="submit" value="SAVE" />
  </form>
END_OF_FORM;
    echo $form;

  include 'includes/footer.php';
  ob_end_flush();
?>