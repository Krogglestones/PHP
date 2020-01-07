<?php
  $title = "Calendar";
  include 'includes/header.php';
  include 'includes/functions.php';

  $month = $_GET["month"];
  if (empty($month)) {
    $month = date("n");
  }

  $year = $_GET["year"];
  if (empty($year)) {
    $year = date("Y");
  }
  $prev_year = $year - 1;
  $next_year = $year;
  $prev_month = $month - 1;
  if ($prev_month == 0) {
    $prev_month = 12;
  }
  if ($prev_month == 12){
    $year = $year - 1;
  }
  if ($prev_month == 11){
    $year = $year - 1;
  }
  $next_month = $month + 1;
  if ($next_month == 13) {
    $next_month = 1;
  }
  if ($next_month == 1) {
    $year = $year + 1;
  }

  $firstOfTheMonth = mktime(0, 0, 0, $month, 1, $year);
  $firstDay = date("w", $firstOfTheMonth);

  $calendar_title = date("F Y", mktime(0, 0, 0, $month, 1, $year));

  $cal = mini_calendar($month, $year);
?>

  <!-- Main Wrapper -->
  <div id="main-wrapper">
    <h2 class="center_me">Calendar</h2>
    <div>
      <a href="http://phpprod.craiglarsonsoftware.com/calendar.php?month=<?php echo $prev_month ?>&year=<?php echo $year ?>">PREVIOUS</a>
      <a href="http://phpprod.craiglarsonsoftware.com/calendar.php?month=<?php echo $next_month ?>&year=2017">NEXT</a>

      <?php
        echo $cal
      ?>

    </div>
  </div>

<?php

  include 'includes/footer.php';

?>
