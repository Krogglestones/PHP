<?php




  function mini_calendar($month, $year)
  {
    $month = $_GET["month"];
    if (empty($month)) {
      $month = date("n");
    }

    $year = $_GET["year"];
    if (empty($year)) {
      $year = date("Y");
    }
    $firstOfTheMonth = mktime(0, 0, 0, $month, 1, $year);
    $firstDay = date("w", $firstOfTheMonth);


    if (($month == 1) || ($month == 3) || ($month == 5) || ($month == 7) || ($month == 8) || ($month == 10) || ($month == 12)) {
      $total_days = 31;
    } else if (($month == 2) && ($year % 4 != 0)) {
      $total_days = 28;
    } else if (($month == 2) && ($year % 4 == 0)) {
      $total_days = 29;
    } else {
      $total_days = 30;
    }

    $remaining_days = $total_days;
    $calendar_title = date("F Y", mktime(0, 0, 0, $month, 1, $year));
    $ret_str = '';
    $ret_str .= '<table>';
    $ret_str .= '<tr>';
    $ret_str .= '<td colspan="7" class="center_me">' . $calendar_title;
    $ret_str .= '</td>';
    $ret_str .= '</tr>';
    $ret_str .= '<tr>';
    $ret_str .= '<td>Sun</td>';
    $ret_str .= '<td>Mon</td>';
    $ret_str .= '<td>Tue</td>';
    $ret_str .= '<td>Wed</td>';
    $ret_str .= '<td>Thu</td>';
    $ret_str .= '<td>Fri</td>';
    $ret_str .= '<td>Sat</td>';
    $ret_str .= '</tr>';

    $ret_str .= '<tr>';
    while ($firstDay > 0) {
      $ret_str .= '<td>&nbsp;</td>';
      $firstDay -= 1;
    };
    $firstDay = date("w", $firstOfTheMonth);
    $count = 7 - $firstDay;
    $day = 1;
    while ($count > 0) {
      $ret_str .= '<td>' . $day . '</td>';
      $count -= 1;
      $day += 1;
    }
    $ret_str .= '</tr>';

    $ret_str .= '<tr>';
    $count2 = 1;
    while ($count2 < 8) {
      $ret_str .= '<td>' . $day . '</td>';
      $count2 += 1;
      $day += 1;
    }
    $ret_str .= '</tr>';

    $ret_str .= '<tr>';
    $count2 = 1;
    while ($count2 < 8) {
      $ret_str .= '<td>' . $day . '</td>';
      $count2 += 1;
      $day += 1;
    }
    $ret_str .= '</tr>';

    $ret_str .= '<tr>';
    $count2 = 1;
    while ($count2 < 8) {
      $ret_str .= '<td>' . $day . '</td>';
      $count2 += 1;
      $day += 1;
    }
    $ret_str .= '</tr>';

    $ret_str .= '<tr>';
    $days_left = $remaining_days - $day + 1;
    if ($days_left > 0) {
      $count2 = 1;
      $empty_boxes = (7 - $days_left);
      while (($count2 < 8) && ($days_left > 0)) {
        $ret_str .= '<td>' . $day . '</td>';
        $count2 += 1;
        $day += 1;
        $days_left -= 1;
      }
      if ($empty_boxes > 0) {
        while ($empty_boxes > 0) {
          $ret_str .= '<td>&nbsp;</td>';
          $empty_boxes -= 1;
        }
      }
    }


    $days_left = $remaining_days - $day + 1;
    if ($days_left > 0) {
      $ret_str .= '<tr>';
      $count2 = 1;
      $empty_boxes = (7 - $days_left);
      while (($count2 < 8) && ($days_left > 0)) {
        $ret_str .= '<td>' . $day . '</td>';
        $count2 += 1;
        $day += 1;
        $days_left -= 1;
      }
      if ($empty_boxes > 0) {
        while ($empty_boxes > 0) {
          $ret_str .= '<td>&nbsp;</td>';
          $empty_boxes -= 1;
        }
      }
    }

    $ret_str .= '</table>';
    return $ret_str;

  }
// -----------------------------------------------------------------------------------------------

  function db_connect(): mysqli
  {
    $db = new mysqli("mysql2.craiglarsonsoftware.com", "raidercraig", "T1mb3rJ03y", "phpdev_craiglarsonsoftware");

    if ($db->connect_errno) {
      echo "failed to connect to DB(" . $db->connect_errno . ") " . $db->connect_error;
    }
    return $db;
  }

  // ------------------------------------------------------------------------------------------

  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

?>
