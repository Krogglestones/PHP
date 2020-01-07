<?php

  include "includes/functions.php";

  $db = db_connect();
  $product_idfk = mysqli_real_escape_string( $db, $_POST["product_idfk"]);
  $review_author = mysqli_real_escape_string( $db, $_POST["review_author"]);
  $review_text = mysqli_real_escape_string( $db,  $_POST["review_text"]);
  $review_rating = mysqli_real_escape_string( $db, $_POST["review_rating"]);

  if($rating < 1)
    $rating = 1;
  if($rating > 5)
    $rating = 5;

  $sql = "INSERT INTO reviews (review_id, review_author, review_text, review_rating, review_created_at, product_idfk)
                      VALUES (NULL, '$review_author', '$review_text', $review_rating, NOW(), $product_idfk )";

  $result = $db->query($sql);

  header("Location: /product.php?id=$product_idfk");

?>

