<?php
  ob_start();
  include 'includes/header.php';
  include 'includes/functions.php';

?>


<?php
  $db = db_connect();
  $id = mysqli_real_escape_string($db, $_GET["id"]);

  $sql = "SELECT * FROM blogs WHERE blog_id=$id";
  $result = $db->query($sql);

  list($blog_id, $author, $date_posted, $blog_text, $blog_title) = $result->fetch_row();

  $sql = "SELECT * FROM preferences WHERE newsletter=1";

  $result2 = $db->query($sql);
  //  print_r($result2);

  while (list($id, $first_name, $last_name, $email, $newsletter) = $result2->fetch_row()) {
//    echo $email . "<br/>";

    $message2 = <<<END_OF_MESSAGE
	Hello $first_name,
	Here is a random blog we thought you'd enjoy:

	AUTHOR:  $author
	
	TITLE: $blog_title
	
	BLOG: $blog_text
END_OF_MESSAGE;

    $to = $email;
    $subject = "Random Blog For You: $blog_title";
    $headers = "From: info@phpdev.craiglarsonsoftware.com\r\n";
    $sent = mail($to, $subject, $message2, $headers);
  }
  ob_end_clean();
  header("Location: /blog_list.php");

?>

<?php
  ob_end_flush();
?>

