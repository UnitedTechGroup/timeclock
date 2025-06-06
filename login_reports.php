<?php
session_start();

require 'common.php';
include 'header.php';
include 'topmain.php';
echo "<title>$title - Reports Login</title>\n";

if (isset($_POST['login_userid']) && (isset($_POST['login_password']))) {
    $login_userid = $_POST['login_userid'];
    $login_password = crypt($_POST['login_password'], 'xy');

    $result = tc_select(
        "empfullname, reports", "employees",
        "empfullname = ? AND employee_passwd = ?",
        array($login_userid, $login_password)
    );

    $reports_auth = "0";
    while ($row = mysqli_fetch_array($result)) {
        $reports_username = "" . $row['empfullname'];
        $reports_auth = "" . $row['reports'];
    }

    if ($reports_auth == "1") { $_SESSION['valid_reports_user'] = $reports_username; }
}

if (isset($_SESSION['valid_reports_user'])) {
    echo "<script type='text/javascript' language='javascript'> window.location.href = 'reports/index.php';</script>";
    exit;
}

else {
    $self = html($_SERVER['PHP_SELF']);
    echo "<form name=\"auth\" method=\"post\" action=\"$self\">\n";
    echo "<table align=center width=210 border=0 cellpadding=7 cellspacing=1>\n";
    echo "  <tr class=right_main_text><td colspan=2 height=35 align=center valign=top class=title_underline>PHP Timeclock Reports Login</td></tr>\n";
    echo "  <tr class=right_main_text><td align=left>Username:</td><td align=right><input type='text' name='login_userid'></td></tr>\n";
    echo "  <tr class=right_main_text><td align=left>Password:</td><td align=right><input type='password' name='login_password'></td></tr>\n";
    echo "  <tr class=right_main_text><td align=center colspan=2><input type='submit' onClick='admin.php' value='Log In'></td></tr>\n";

    if (isset($login_userid)) {
        echo "  <tr class=right_main_text><td align=center colspan=2>Could not log you in. Either your username or password is incorrect.</td></tr>\n";
    }

    echo "</table>\n";
    echo "</form>\n";
    echo "<script language=\"javascript\">document.forms['auth'].login_userid.focus();</script>\n";
}

echo "</body>\n";
echo "</html>\n";
?>
