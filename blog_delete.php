<?php
  ob_start();
  include 'includes/header.php';
  include 'includes/functions.php';

  $db = db_connect();
  $id = mysqli_real_escape_string($db, $_GET["id"]);

  $sql = "DELETE FROM blogs WHERE blog_id=$id";
  $result = $db->query($sql);
  ob_clean();
  if ($result) {
    header("Location: /blog_list.php?msg=Blog Deleted");
  } else {
    header("Location: /blog_list.php?msg=Blog NOT Deleted.");
  }

  ob_end_flush();
?>

