<?php

  include 'includes/header.php';
  include 'includes/functions.php';

  $id = $_GET["id"];
  $db = db_connect();
  $sql = "SELECT * FROM practice_db WHERE id=$id";
  $result = $db->query($sql);
  list($id, $name, $made_on) = $result->fetch_row();


  $detail = <<<END_OF_DETAIL
  
    <a href="/people.php">Back To All People</a>

  
<h1>Person:</h1>

<p>This is a show page for an individual person</p>

<h3>$id</h3>
<h4>$name</h4>
<h5>$made_on</h5>

<a href="/person_edit.php?id=$id">EDIT INFO</a>

END_OF_DETAIL;

  echo $detail;

?>


<?php
  include 'includes/footer.php';
?>
