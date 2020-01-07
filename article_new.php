<?php

  ob_start();
  //$title = "Articles";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

  <!-- Main Wrapper -->
  <div id="main-wrapper">

<?php

//  $id = $_GET["id"];
  $submit = $_POST["submit"];
  $db = db_connect();


  $title = mysqli_real_escape_string( $db, $_POST["title"]);
  $author = mysqli_real_escape_string( $db, $_POST["author"]);
  $article_text = mysqli_real_escape_string( $db, $_POST["article_text"]);
  $date_posted = mysqli_real_escape_string( $db, $_POST["date_posted"]);
  $created_at = mysqli_real_escape_string( $db, $_POST["created_at"]);
  $modified_at = mysqli_real_escape_string( $db, $_POST["modified_at"]);

  //format so the db will like it.
//    $date_posted = $date_posted->format("Y-m-d H:i:s");
//$created_at = $created_at->format("Y-m-d H:i:s");
//  $created_at = date_create();
//  $created_at = $created_at->format("Y-m-d H:i:s");
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

    $created_at = date_create();
    $created_at = $created_at->format("Y-m-d H:i:s");

    $sql = "INSERT INTO `articles` (`article_id`, `title`, `author`, `article_text`, `date_posted`, `created_at`, `modified_at`) VALUES (NULL, '$title', '$author', '$article_text', CURRENT_TIMESTAMP , CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    echo "SQL: $sql<br/>";
    $result = $db->query($sql);
    echo "updated";
    ob_clean();
    header("Location: articles_list.php?id=$db->insert_id");
  }

    $form = <<<END_OF_FORM
  <form method="POST" action="/article_new.php">
    <a href="/articles_list.php">BACK TO LIST</a><br/><br/>
    TITLE: <input type="text" name="title" value="$title"><span class="red">$title_error</span><br/>
    AUTHOR: <input type="text" name="author" value="$author"><span class="red">$author_error</span><br/>
    TEXT: <input type="text" name="article_text" value="$article_text"><span class="red">$text_error</span><br/>
    DATE POSTED: <input type="datetime-local" name="date_posted" value="$date_posted"><br/>
    <input type="submit" name="submit" value="ADD" />
  </form>
END_OF_FORM;
    echo $form;

  include 'includes/footer.php';
  ob_end_flush();
?>

