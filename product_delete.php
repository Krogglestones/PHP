<?php
  ob_start();
  include 'includes/header.php';
  include 'includes/functions.php';


  $db = db_connect();
  $id = mysqli_real_escape_string( $db, $_GET["id"]);

  $sql = "DELETE FROM products WHERE product_id=$id";
  $result = $db->query($sql);
  ob_clean();
  if($result){
    header ("Location: /products.php?msg=Product Deleted");
  } else  {
    header ("Location: /products.php?msg=Product NOT Deleted.");
  }

  ob_end_flush();
?>

