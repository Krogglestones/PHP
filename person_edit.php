<?php
  ob_start();
  $title = "Edit";
  include 'includes/header.php';
  include 'includes/functions.php';
?>

<?php

  $id = $_GET["id"];
  $submit = $_POST["submit"];
  $db = db_connect();

  if (empty($submit)) {
  $sql = "SELECT * FROM practice_db WHERE id=i$idd";
  $result = $db->query($sql);
  list($id, $name, $made_on) = $result->fetch_row();
} else {
  $name = $_POST["name"];
  $made_on = $_POST["made_on"];
  $sql = "UPDATE practice_db SET name='$name', made_on='$made_on' WHERE id=i$idd";
  echo "SQL: $sql<br/>";
  $result = $db->query($sql);
  echo "updated";
  ob_clean();
  header("Location: /person.php?id=$id");
}

    //  } else {
  //    $name = $_POST["name"];
  //    $sql = "UPDATE practice_db SET name='$name' WHERE id='$id'";
  //    echo "SQL: $sql<br/>";
  //  }


  $form = <<<END_OF_FORM
  <h1>Edit Here</h1>
  <form method="POST" action="/person_edit.php?id=$id">
      NAME: <input type="text" name="name" value="$name"><br/>
      <input type="submit" name="submit" value="SAVE" />
  </form>

END_OF_FORM;
  echo $form

?>


<?php
  include 'includes/footer.php';
  ob_end_flush();
?>
