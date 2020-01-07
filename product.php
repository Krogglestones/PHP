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

      $db = db_connect();
      $id = mysqli_real_escape_string($db, $_GET["id"]);


            $sql = "SELECT AVG(review_rating) FROM reviews WHERE product_idfk=$id";
            $result = $db->query($sql);

            $avg_rating = 0;
            if ($result) {
              $avg_rating = $result->fetch_row()[0];
            }

            $stars = str_repeat('<img src="/images/star.png" height="25" width="25" alt="star"/>', $avg_rating);

      $sql = "SELECT * FROM products WHERE product_id=$id";
      $result = $db->query($sql);
      list($product_id, $product_name, $description, $price, $company_cost, $quantity, $image, $thumbnail_image) = $result->fetch_row();


      $detail = <<<END_OF_DETAIL

    <a href="/products.php">Back To All Products</a>


    <p>This is a show page for an individual product</p>
    <h1>AVERAGE RATING:  $stars</h1>
    <h1>Name:  $product_name</h1>
    <h3>ID:  $product_id</h3>
    <h5>Description:  $description</h5>
    <h5>Price:  $price</h5>
    <h5>Company Cost:  $company_cost</h5>
    <h3>Quantity:  $quantity</h3>
    <h3>Image:  <img src="$image" alt="cat"></h3>


END_OF_DETAIL;

      echo $detail;

      if (isset ($_SESSION['email'])) {
        echo "<a href='/product_update.php?id=$product_id'>EDIT INFO</a>";
      }

      $sql = "SELECT * FROM reviews WHERE product_idfk=$id";

      $result = $db->query($sql);
      while (list ($review_id, $review_author, $review_text, $review_rating, $review_created_at, $product_idfk) = $result->fetch_row()) {
        $stars = str_repeat('<img src="/images/star.png" height="25" width="25" alt="star"/>', $review_rating);

        echo "<hr/>";
        echo time_elapsed_string($review_created_at) . ", " . $review_author . " gave the blog a rating of " . $stars . ".";
        echo "<br/>";
        echo "This is what they had to say:";
        echo "<br/>";
        echo $review_text;
        echo "<hr/>";


      }

      $review_form = <<<END_OF_FORM
    <form method="post" action="/reviews_new_review.php">
      Author: <input type="text" name="review_author"><br/>
      Review:<br/>
      <textarea name="review_text"></textarea><br/>
      Rating: <input name="review_rating" type="number" min="1" max="5">
      <br/>
      <input type="hidden" name="product_idfk" value="$id"><br/>
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
