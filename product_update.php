<?php
  ob_start();
  $title = "Product Update";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

<!-- Main Wrapper -->
<div id="main-wrapper">
  <h1>Update product</h1>
  <?php
    $db = db_connect();
    $id = mysqli_real_escape_string($db, $_GET["id"]);
    $submit = $_POST["submit"];


    if (empty($submit)) {
      $sql = "SELECT * FROM products WHERE product_id=$id";
      $result = $db->query($sql);
      list($product_id, $product_name, $description, $price, $company_cost, $quantity, $image, $thumbnail_image) = $result->fetch_row();
    } else {

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

        $sql = "UPDATE products SET  product_name='$product_name', description='$description', price='$price', company_cost='$company_cost', quantity='$quantity', image='$image', thumbnail_image='$thumbnail_image' WHERE product_id=$id";
        echo "SQL: $sql<br/>";
        $result = $db->query($sql);
        echo "updated";
        ob_clean();
        header("Location: /product.php?id=$id");

      }
    }
      $form = <<<END_OF_FORM
  <h1>Edit Here</h1>
  <form method="POST" action="/product_update.php?id=$id">

    Product Name: <input type="text" name="product_name" value="$product_name"><br/><span class="red">$name_error</span><br/>
    Description: <input type="text" name="description" value="$description"><br/>                      
    Price: <input type="number" name="price" value="$price"><br /><span class="red">$price_error</span><br/>
    Company Cost: <input type="number" name="company_cost" value="$company_cost"><br />           
    Quantity: <input type="number" name="quantity" value="$quantity"><br />                       
    Image: <input type="text" name="image" value="$image"><br />                                  
    Thumbnail Image: <input type="text" name="thumbnail_image" value="$thumbnail_image"><br />    

    <input type="submit" name="submit" value="SAVE" />
  </form>
END_OF_FORM;
      echo $form;

    include 'includes/footer.php';
    ob_end_flush();
  ?>

