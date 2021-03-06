<?php

echo "<table class=header width=100% border=0 cellpadding=0 cellspacing=1>\n";
echo "  <tr>";

// display the logo in top left of each page. This will be $logo you setup in config.inc.php. //
// It will also link you back to your index page. //

if ($logo == "none") {
    echo "<td height=35 align=left></td>\n";
} else {
    echo "<td align=left><a href='index.php'><img border=0 src='$logo'></a></td>\n";
}

if (!empty($_COOKIE['office_name'])) {
    echo tag("td", $_COOKIE['office_name']);
}

// if db is out of date, report it here //

if (tc_dbversion() <> $dbversion) {
    echo "    <td no class=notprint valign=middle align=left style='font-size:13;font-weight:bold;color:#AA0000'><p>***Your database is out of date.***<br />
                                                                                    &nbsp;&nbsp;&nbsp;Upgrade it via the admin section.</p></td>\n";
}

// display a 'reset cookie' message if $use_client_tz = "yes" //

if ($date_link == "none") {

    if ($use_client_tz == "yes") {
        echo "    <td class=notprint valign=middle align=right style='font-size:9px;'>
              <p>If the times below appear to be an hour off, click <a href='resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
                If that doesn't work, restart your web browser and reset again.</p></td>\n";
    }

    echo "    <td colspan=2 scope=col align=right valign=middle><a>";

} else {

    if ($use_client_tz == "yes") {
        echo "    <td class=notprint valign=middle align=right style='font-size:9px;'>
              <p>If the times below appear to be an hour off, click <a href='resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
                If that doesn't work, restart your web browser and reset again.</p></td>\n";
    }

    echo "    <td colspan=2 scope=col align=right valign=middle><a href='$date_link'>";
}

// display today's date in top right of each page. This will link to $date_link you setup in config.inc.php. //

$todaydate = date('F j, Y');
echo "$todaydate&nbsp;&nbsp;</a><span id=\"currenttime\"></span></td></tr>\n";
echo "</table>\n";

if ($display_current_time === "server" or $display_current_time === "client") {
    $servertime = time();
    echo tag("script", <<<SCRIPT
var serverOffset = 1000 * $servertime - Date.now();
ready(function(){
    update_time('$display_current_time', document.getElementById('currenttime'), serverOffset, true);
});
SCRIPT
    , array("type" => "text/javascript")
    );
}

// display the topbar //

echo "<table class=topmain_row_color width=100% border=0 cellpadding=0 cellspacing=0>\n";
echo "  <tr>\n";

if (isset($_SESSION['valid_user'])) {
    $logged_in_user = $_SESSION['valid_user'];
    echo "    <td align=left valign=middle width=10 style='padding-left:12px;'><img src='images/icons/user_orange.png' border='0'></td>\n";
    echo "    <td align=left valign=middle style='color:#000000;font-family:Tahoma;font-size:10pt;padding-left:8px;'>logged in as: $logged_in_user</td>\n";
} else if (isset($_SESSION['time_admin_valid_user'])) {
    $logged_in_user = $_SESSION['time_admin_valid_user'];
    echo "    <td align=left valign=middle width=10 style='padding-left:12px;'><img src='images/icons/user_red.png' border='0'></td>\n";
    echo "    <td align=left valign=middle style='color:#000000;font-family:Tahoma;font-size:10pt;padding-left:8px;'>logged in as: $logged_in_user</td>\n";
} else if (isset($_SESSION['valid_reports_user'])) {
    $logged_in_user = $_SESSION['valid_reports_user'];
    echo "    <td align=left valign=middle width=10 style='padding-left:12px;'><img src='images/icons/user_suit.png' border='0'></td>\n";
    echo "    <td align=left valign=middle style='color:#000000;font-family:Tahoma;font-size:10pt;padding-left:8px;'>logged in as: $logged_in_user</td>\n";
}

echo "    <td align=right valign=middle><img src='images/icons/house.png' border='0'>&nbsp;&nbsp;</td>\n";
echo "    <td align=right valign=middle width=10><a href='index.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
        Home&nbsp;&nbsp;</a></td>\n";
echo "    <td align=right valign=middle width=23><img src='images/icons/bricks.png' border='0'>&nbsp;&nbsp;</td>\n";
echo "    <td align=right valign=middle width=10><a href='login.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
        Administration&nbsp;&nbsp;</a></td>\n";
echo "    <td align=right valign=middle width=23><img src='images/icons/report.png' border='0'>&nbsp;&nbsp;</td>\n";

if ($use_reports_password == "yes") {
    echo "    <td align=right valign=middle width=10><a href='login_reports.php' style='color:#000000;font-family:Tahoma;font-size:10pt;
        text-decoration:none;'>Reports&nbsp;&nbsp;</a></td>\n";
} elseif ($use_reports_password == "no") {
    echo "    <td align=right valign=middle width=10><a href='reports/index.php' style='color:#000000;font-family:Tahoma;font-size:10pt;
        text-decoration:none;'>Reports&nbsp;&nbsp;</a></td>\n";
}

echo "    <td align=right valign=middle width=23><img src='images/icons/time.png' border='0'>&nbsp;&nbsp;</td>\n";
echo "    <td align=right valign=middle width=10><a href='punchclock/menu.php' style='color:#000000;font-family:Tahoma;font-size:10pt;
        text-decoration:none;'>Punchclock&nbsp;&nbsp;</a></td>\n";

if ((isset($_SESSION['valid_user'])) || (isset($_SESSION['valid_reports_user'])) || (isset($_SESSION['time_admin_valid_user']))) {
    echo "    <td align=right valign=middle width=20><img src='images/icons/arrow_rotate_clockwise.png' border='0'>&nbsp;</td>\n";
    echo "    <td align=right valign=middle width=10><a href='logout.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
            Logout&nbsp;&nbsp;</a></td>\n";
}

echo "</tr></table>\n";
?>
