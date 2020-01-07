<?php
  ob_start();
  include 'includes/header.php';
  include 'includes/functions.php';

?>


<?php
  $db = db_connect();
  $id = mysqli_real_escape_string( $db, $_GET["id"]);
  $sql = "DELETE FROM articles WHERE article_id=$id";
  $result = $db->query($sql);
  ob_clean();
  if($result){
    header ("Location: /articles_list.php?msg=Article Deleted");
  } else  {
    header ("Location: /articles_list.php?msg=Article NOT Deleted.");
  }
?>

<?php
  ob_end_flush();
?>

