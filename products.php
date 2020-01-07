<?php
  $title = "Products";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

<!-- Main Wrapper -->
<div id="main-wrapper">

  <?php

    if (!(isset ($_SESSION['email']))) {
      echo "<br/><h1 class='center_me'>Please log in to add or delete a product.</h1><br/>";
    }

    $db = db_connect();
    $msg = $_GET["msg"];
    $sql = "SELECT * FROM products";

    $result = $db->query($sql);
    echo "<br/>";
    if (isset ($_SESSION['email'])) {
      echo "<a href='/product_new.php'>ADD NEW PRODUCT</a>";
    }
    echo "<br/>";

    $table = <<<END_OF_TABLE
<p>$msg</p>
<table>
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Cost</th>
    <th>Quantity</th>
    <th>Image</th>
    <!--<th>&nbsp;</th>-->
  </tr>

END_OF_TABLE;

    echo $table;
    while (list($product_id, $product_name, $description, $price, $company_cost, $quantity, $image, $thumbnail_image) = $result->fetch_row()) {

      // change product's anchor tag to link to show page.
      echo "<tr><td><a href=\"/product.php?id=$product_id\">$product_name</a></td>";
      echo "<td>$description</td>";
      echo "<td>$$price</td>";
      echo "<td>$$company_cost</td>";
      echo "<td>$quantity</td>";
      echo "<td><img src='$thumbnail_image' alt='cat'</td>";
      if (isset ($_SESSION['email'])) {
        echo "<td><a href='product_delete.php?id=$product_id'>DELETE</a></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    if (isset ($_SESSION['email'])) {
      echo "<a href='/product_new.php'>ADD NEW PRODUCT</a>";
    }
  ?>

</div>

<?php

  include 'includes/footer.php';

?>

