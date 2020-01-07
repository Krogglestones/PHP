<?php

  include "includes/functions.php";

  $db = db_connect();
  $blog_idfk = mysqli_real_escape_string( $db, $_POST["blog_idfk"]);
  $author = mysqli_real_escape_string( $db, $_POST["author"]);
  $comment_text = mysqli_real_escape_string( $db,  $_POST["comment_text"]);
  $rating = mysqli_real_escape_string( $db, $_POST["rating"]);

  if($rating < 1)
    $rating = 1;
  if($rating > 5)
    $rating = 5;



  $sql = "INSERT INTO comments (comment_id, author, comment_text, rating, created_at, blog_idfk)
                      VALUES (NULL, '$author', '$comment_text', $rating, NOW(), $blog_idfk )";

  $result = $db->query($sql);
  //  $timeAgo = new Westsworld\TimeAgo();
  //  echo $timeAgo->inWords($rating);

  header("Location: /blog.php?id=$blog_idfk");

?>

