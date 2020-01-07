<?php
  $title = "People";
  include 'includes/header.php';
  include 'includes/functions.php';
  /**
   * @return mysqli
   */
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
  <h1>People page</h1>

  <p>This is a list of people</p>

<?php

  $db = db_connect();

  $sql = "SELECT * FROM practice_db";
  echo $sql;  // Debugging only
  $result = $db->query($sql);
  print_r($result);
  echo "<br/>";

  // Error  echo "<br/>Num of rows: " . $result->fetch_row()[0];

  //  list($id, $name, $made_on) = $result->fetch_row();
  //  echo $id, $name, $made_on;

  //  while (list($id, $name, $made_on) = $result->fetch_row())	{
  //    echo $id, $name, $made_on;
  //    echo '<br/>';
  //}

  $table = <<<END_OF_TABLE
  
  <table>
    <tr>
		  <th>ID</th>
		  <th>Name</th>
		  <th>Made On</th>
	  </tr>

END_OF_TABLE;

  //  *** closing "END_OF_TABLE" tag has to be on 1st column.

  echo $table;
  while (list($id, $name, $made_on) = $result->fetch_row()) {
    echo "<tr><td>$id<td><a href=\"/person.php?id=$id\">$name</a></td><td>$made_on</td><td>	<a href=\"/person_edit.php?id=$id\">EDIT</a></td>";
  }
  echo "</table>";

?>



  <?php

    include 'includes/footer.php';

  ?>






