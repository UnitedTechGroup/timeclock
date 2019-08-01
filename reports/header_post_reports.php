<?php
include "header.reports.inc.php";

echo "<link rel='stylesheet' type='text/css' media='screen' href='../css/default.css' />\n";
echo "<link rel='stylesheet' type='text/css' media='screen' href='../css/local.css' />\n";
echo "<link rel='stylesheet' type='text/css' media='print' href='../css/print.css' />\n";
echo "<script language=\"javascript\" src=\"../scripts/CalendarPopup.js\"></script>\n";
echo "<script language=\"javascript\">document.write(getCalendarStyles());</script>\n";
echo "<script language=\"javascript\">var cal = new CalendarPopup('mydiv');</script>\n";
echo "<script language=\"javascript\" src=\"../scripts/common.js\"></script>\n";
include '../scripts/dropdown_post_reports.php';
echo "</head>\n";

setTimeZone();

echo "<body onload='office_names();'>\n";
?>
