<?php

  ob_start();
  $title = "Add New Product";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

<!-- Main Wrapper -->
<div id="main-wrapper">

  <?php

    $submit = $_POST["submit"];
    $db = db_connect();

    $product_name = mysqli_real_escape_string($db, $_POST["product_name"]);
    $description = mysqli_real_escape_string($db, $_POST["description"]);
    $price = mysqli_real_escape_string($db, $_POST["price"]);
    $company_cost = mysqli_real_escape_string($db, $_POST["company_cost"]);
    $quantity = mysqli_real_escape_string($db, $_POST["quantity"]);
    $image = mysqli_real_escape_string($db, $_POST["image"]);
    $thumbnail_image = mysqli_real_escape_string($db, $_POST["thumbnail_image"]);

    $found_error = false;

    if (empty($product_name)) {
      $name_error = "Product Name is required";
      $found_error = true;
    }
    if (empty($price)) {
      $price_error = "Price is required";
      $found_error = true;
    }
    if (!$found_error) {

      $sql = "INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `company_cost`, `quantity`, `image`, `thumbnail_image` ) VALUES (NULL,  '$product_name', '$description' , '$price', '$company_cost', '$quantity', '$image', '$thumbnail_image')";
      echo "SQL: $sql<br/>";
      $result = $db->query($sql);
      echo "updated";
      ob_clean();
      header("Location: products.php?id=$db->insert_id");
    }

    $form = <<<END_OF_FORM
  <form method="POST" action="/product_new.php">
    <a href="/products.php">BACK TO LIST</a><br/><br/>
    Product Name: <input type="text" name="product_name" value="$product_name"><br/><span class="red">$name_error</span><br/>
    Description: <input type="text" name="description" value="$description"><br/>
    Price: <input type="number" step="0.01" name="price" value="$price"><br/><span class="red">$price_error</span><br/>
    Company Cost: <input type="number" step="0.01" name="company_cost" value="$company_cost"><br/>
    Quantity: <input type="number" name="quantity" value="$quantity"><br/>
    Image: <input type="text" name="image" value="$image"><br/>
    Thumbnail Image: <input type="text" name="thumbnail_image" value="$thumbnail_image"><br/>
    
    <input type="submit" name="submit" value="ADD" />
  </form>
END_OF_FORM;
    echo $form;

  ?>
</div>
<?php

  include 'includes/footer.php';
  ob_end_flush();
?>

