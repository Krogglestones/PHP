<?php
  ob_start();
  //$title = "Blogs";
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
    $sql = "SELECT * FROM blogs WHERE blog_id=$id";
    $result = $db->query($sql);
    list($blog_id, $author, $date_posted, $blog_text, $blog_title) = $result->fetch_row();
  } else {


    $author = mysqli_real_escape_string( $db, $_POST["author"]);
    $date_posted = mysqli_real_escape_string( $db, $_POST["date_posted"]);
    $blog_text = mysqli_real_escape_string( $db, $_POST["blog_text"]);
    $blog_title = mysqli_real_escape_string( $db, $_POST["title"]);

    $found_error = false;
    if (empty($blog_title)) {
      $title_error = "Title is required";
      $found_error = true;
    }
    if (empty($author)) {
      $author_error = "Author is required";
      $found_error = true;
    }
    if (empty($blog_text)) {
      $text_error = "Text is required";
      $found_error = true;
    }
    if (!$found_error) {

      //format so the db will like it.
//    $date_posted = $date_posted->format("Y-m-d H:i:s");
//$created_at = $created_at->format("Y-m-d H:i:s");
      $date_posted = date_create();
      $date_posted = $date_posted->format("Y-m-d H:i:s");


      $sql = "UPDATE blogs SET  author='$author', date_posted='$date_posted', blog_text='$blog_text', blog_title='$blog_title' WHERE blog_id=$id";
      echo "SQL: $sql<br/>";
      $result = $db->query($sql);
      echo "updated";
      ob_clean();
      header("Location: /blog.php?id=$id");
    }
  }

  $form = <<<END_OF_FORM
  <h1>Edit Here</h1>
  <form method="POST" action="/blog_update.php?id=$id">

    TITLE: <input type="text" name="title" value="$blog_title"><span class="red">$title_error</span><br/>
    AUTHOR: <input type="text" name="author" value="$author"><span class="red">$author_error</span><br/>
    TEXT: <input type="text" name="blog_text" value="$blog_text"><span class="red">$text_error</span><br/>
    <!--DATE POSTED: <input type="datetime-local" name="date_posted" value="$date_posted"><br/>-->
    <input type="submit" name="submit" value="SAVE" />
  </form>
END_OF_FORM;
  echo $form;

  include 'includes/footer.php';
  ob_end_flush();
?>