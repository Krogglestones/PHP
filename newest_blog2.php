<?php
  //  ob_start();
  $title = "Blog";
  include 'includes/header.php';
  include 'includes/functions.php';


?>


<!-- Main Wrapper -->
<div id="main-wrapper">

  <div id="content">

    <?php

      //      $ratings = array(1, 2, 3, 4, 5);
      //      $submit = $_POST["submit"];
      $id = $_GET["id"];
      $db = db_connect();

      $sql = "SELECT AVG(rating) FROM comments WHERE blog_idfk=$id";
      $result = $db->query($sql);
            ob_clean();

      $avg_rating = 0;
      if ($result) {
        $avg_rating = $result->fetch_row()[0];
      }

      $stars = str_repeat('<img src="/images/star.png" height="25" width="25" />', $avg_rating);


      $sql = "SELECT * FROM blogs ORDER BY date_posted DESC LIMIT 1";
      $result = $db->query($sql);
            ob_clean();
      list($blog_id, $author, $date_posted, $blog_text, $blog_title) = $result->fetch_row();


      $detail = <<<END_OF_DETAIL

    <a href="/blog_list.php">Back To All Blogs</a>


    <p>This is a show page for an individual blog</p>
    <h1>AVERAGE RATING: $stars</h1>
    <h3>ID:  $blog_id</h3>
    <h5>AUTHOR:  $author</h5>
    <h5>DATE POSTED:  $date_posted</h5>
    <h5>TEXT:  $blog_text</h5>
    <h3>Title:  $blog_title</h3>
    <a href="/blog_update.php?id=$blog_id">EDIT INFO</a>

END_OF_DETAIL;

      echo $detail;

      $sql = "SELECT * FROM comments WHERE blog_idfk=$id";

      //  echo $sql;
      $result = $db->query($sql);
//            ob_clean();
//      while (list ($comment_id, $author, $comment_text, $rating, $created_at, $blog_idfk) = $result->fetch_row()) {
//        $stars = str_repeat('<img src="/images/star.png" height="25" width="25" />', $rating);

        $review_text = <<< END_OF_REVIEW
  
<!--<div>$author gives it $stars</div>-->

END_OF_REVIEW;
        echo $review_text;

        echo "<hr/>";
        echo time_elapsed_string($created_at) . ", " . $author . " gave the blog a rating of " . $stars . ".";
        echo "<br/>";
        echo "This is what they had to say:";
        echo "<br/>";
        echo $comment_text;
        echo "<hr/>";


//        echo $comment_id, $author, $comment_text, $rating, $created_at, $blog_idfk;
//        echo "<br/><br/><br/><br/>";
//        echo "neat";
//        echo time_elapsed_string($created_at);



//      }




      $review_form =<<<END_OF_FORM

    <form method="post" action="/comments_new_review.php">
      Author: <input type="text" name="author"><br/>
      Review:<br/>
      <textarea name="comment_text"></textarea><br/>
      Rating: <input name="rating" type="number" min="1" max="5">
      <br/>
      <input type="hidden" name="blog_idfk" value="$id"><br/>
      <input type="submit" name="submit" value="Post Comments">
    </form>

END_OF_FORM;

      echo $review_form;


    ?>


  </div>

</div>

<?php

  include 'includes/footer.php';
  ob_end_flush();
?>

