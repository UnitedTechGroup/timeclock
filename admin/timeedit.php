<?php
session_start();

include 'header_date.php';
include 'topmain.php';
echo "<title>$title - Edit Time</title>\n";

$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];

if (($timefmt == "G:i") || ($timefmt == "H:i")) {
    $timefmt_24hr = '1';
    $timefmt_24hr_text = '24 hr format';
    $timefmt_size = '5';
} else {
    $timefmt_24hr = '0';
    $timefmt_24hr_text = '12 hr format';
    $timefmt_size = '8';
}

if ((!isset($_SESSION['valid_user'])) && (!isset($_SESSION['time_admin_valid_user']))) {

    echo "<table width=100% border=0 cellpadding=7 cellspacing=1>\n";
    echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Administration</td></tr>\n";
    echo "  <tr class=right_main_text>\n";
    echo "    <td align=center valign=top scope=row>\n";
    echo "      <table width=200 border=0 cellpadding=5 cellspacing=0>\n";
    echo "        <tr class=right_main_text><td align=center>You are not presently logged in, or do not have permission to view this page.</td></tr>\n";
    echo "        <tr class=right_main_text><td align=center>Click <a class=admin_headings href='../login.php'><u>here</u></a> to login.</td></tr>\n";
    echo "      </table><br /></td></tr></table>\n";
    exit;
}

if ($request == 'GET') {

    if (!isset($_GET['username'])) {

        echo "<table width=100% border=0 cellpadding=7 cellspacing=1>\n";
        echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Error!</td></tr>\n";
        echo "  <tr class=right_main_text>\n";
        echo "    <td align=center valign=top scope=row>\n";
        echo "      <table width=300 border=0 cellpadding=5 cellspacing=0>\n";
        echo "        <tr class=right_main_text><td align=center>How did you get here?</td></tr>\n";
        echo "        <tr class=right_main_text><td align=center>Go back to the <a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a> page to
                edit a time.</td></tr>\n";
        echo "      </table><br /></td></tr></table>\n";
        exit;
    }

    $get_user = $_GET['username'];
    disabled_acct($get_user);

    echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
    echo "  <tr valign=top>\n";
    echo "    <td class=left_main width=180 align=left scope=col>\n";
    echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";
    echo "        <tr><td class=left_rows height=11></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Users</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user.png' alt='User Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='useradmin.php'>User Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user_add.png' alt='Create New User' />&nbsp;&nbsp;
                <a class=admin_headings href='usercreate.php'>Create New User</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/magnifier.png' alt='User Search' />&nbsp;&nbsp;
                <a class=admin_headings href='usersearch.php'>User Search</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Offices</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick.png' alt='Office Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='officeadmin.php'>Office Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick_add.png' alt='Create New Office' />&nbsp;&nbsp;
                <a class=admin_headings href='officecreate.php'>Create New Office</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Groups</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group.png' alt='Group Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='groupadmin.php'>Group Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group_add.png' alt='Create New Group' />&nbsp;&nbsp;
                <a class=admin_headings href='groupcreate.php'>Create New Group</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>In/Out Status</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application.png' alt='Status Summary' />
                &nbsp;&nbsp;<a class=admin_headings href='statusadmin.php'>Status Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_add.png' alt='Create Status' />&nbsp;&nbsp;
                <a class=admin_headings href='statuscreate.php'>Create Status</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>Miscellaneous</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/clock.png' alt='Add/Edit/Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Add Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeadd.php?username=$get_user\">Add Time</a></td></tr>\n";
    echo "        <tr><td class=current_left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Edit Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeedit.php?username=$get_user\">Edit Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timedelete.php?username=$get_user\">Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
    echo "      </table></td>\n";

    $result = tc_select("empfullname, displayname", "employees", "empfullname = ?", $get_user);
    while ($row = mysqli_fetch_array($result)) {
        $username = "" . $row['empfullname'];
        $displayname = "" . $row['displayname'];
    }

    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
    echo "            <br />\n";
    echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
    echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
    echo "              <tr>\n";
    echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_edit.png' />&nbsp;&nbsp;&nbsp;Edit Time
                </th></tr>\n";
    echo "              <tr><td height=15></td></tr>\n";
    echo "                <input type='hidden' name='date_format' value='$js_datefmt'>\n";
    echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Username:</td><td align=left class=table_rows width=80%
                      style='padding-left:20px;'>
                      <input type='hidden' name='post_username' value=\"$username\">$username</td></tr>\n";
    echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Display Name:</td><td align=left class=table_rows
                      width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_displayname' value=\"$displayname\">$displayname</td></tr>\n";
    echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Date: ($tmp_datefmt)</td><td
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;' width=80%>
                      <input type='text' size='10' maxlength='10' name='post_date' style='color:#27408b'>&nbsp;*&nbsp;&nbsp;
                      <a href=\"#\" onclick=\"form.post_date.value='';cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt');
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
    echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
    echo "                <input type='hidden' name='timefmt_24hr' value=\"$timefmt_24hr\">\n";
    echo "                <input type='hidden' name='timefmt_24hr_text' value=\"$timefmt_24hr_text\">\n";
    echo "                <input type='hidden' name='timefmt_size' value=\"$timefmt_size\">\n";
    echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
    echo "            </table>\n";
    echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
    echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
    echo "              <tr><td height=40>&nbsp;</td></tr>\n";
    echo "              <tr><td width=30><input type='image' name='submit' value='Edit Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
    include '../footer.php';
    exit;
} elseif ($request == 'POST') {

    $get_user = $_POST['get_user'];
    $post_username = $_POST['post_username'];
    $post_displayname = $_POST['post_displayname'];
    $post_date = $_POST['post_date'];
    @$final_username = $_POST['final_username'];
    @$final_inout = $_POST['final_inout'];
    @$final_notes = $_POST['final_notes'];
    @$final_mysql_timestamp = $_POST['final_mysql_timestamp'];
    @$final_num_rows = $_POST['final_num_rows'];
    @$final_time = $_POST['final_time'];
    @$edit_time_textbox = $_POST['edit_time_textbox'];
    @$timestamp = $_POST['timestamp'];
    @$calc = $_POST['calc'];
    $row_count = '0';
    $cnt = '0';

    // begin post validation //

    if (!empty($get_user)) {
        $tmp_get_user = tc_select_value("empfullname", "employees", "empfullname = ?", $get_user);
        if (!isset($tmp_get_user)) {
            echo "Something is fishy here.\n";
            exit;
        }
    }

    if (!empty($post_username)) {
        $tmp_username = tc_select_value("empfullname", "employees", "empfullname = ?", $post_username);
        if (!isset($tmp_username)) {
            echo "Something is fishy here.\n";
            exit;
        }
    }

    if (!empty($post_displayname)) {
        $tmp_post_displayname = tc_select_value("displayname", "employees", "empfullname = ? AND displayname = ?", array($post_username, $post_displayname));
        if (!isset($tmp_post_displayname)) {
            echo "Something is fishy here.\n";
            exit;
        }
    }

    if ($get_user != $post_username) {
        exit;
    }

    // end post validation //

    echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
    echo "  <tr valign=top>\n";
    echo "    <td class=left_main width=180 align=left scope=col>\n";
    echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";
    echo "        <tr><td class=left_rows height=11></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Users</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user.png' alt='User Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='useradmin.php'>User Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user_add.png' alt='Create New User' />&nbsp;&nbsp;
                <a class=admin_headings href='usercreate.php'>Create New User</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/magnifier.png' alt='User Search' />&nbsp;&nbsp;
                <a class=admin_headings href='usersearch.php'>User Search</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Offices</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick.png' alt='Office Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='officeadmin.php'>Office Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick_add.png' alt='Create New Office' />&nbsp;&nbsp;
                <a class=admin_headings href='officecreate.php'>Create New Office</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Groups</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group.png' alt='Group Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='groupadmin.php'>Group Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group_add.png' alt='Create New Group' />&nbsp;&nbsp;
                <a class=admin_headings href='groupcreate.php'>Create New Group</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>In/Out Status</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application.png' alt='Status Summary' />
                &nbsp;&nbsp;<a class=admin_headings href='statusadmin.php'>Status Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_add.png' alt='Create Status' />&nbsp;&nbsp;
                <a class=admin_headings href='statuscreate.php'>Create Status</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>Miscellaneous</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/clock.png' alt='Add/Edit/Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Add Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeadd.php?username=$get_user\">Add Time</a></td></tr>\n";
    echo "        <tr><td class=current_left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Edit Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeedit.php?username=$get_user\">Edit Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timedelete.php?username=$get_user\">Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
    echo "      </table></td>\n";
    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
    echo "            <br />\n";

    // begin post validation //

    if (empty($post_date)) {
        $evil_post = '1';
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr>\n";
        echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
        echo "            </table>\n";
    } elseif (preg_match('/' . "^([0-9]{1,2})[-\,\/,.]([0-9]{1,2})[-\,\/,.](([0-9]{2})|([0-9]{4}))$" . '/i', $post_date, $date_regs)) {
        if ($calendar_style == "amer") {
            if (isset($date_regs)) {
                $month = $date_regs[1];
                $day = $date_regs[2];
                $year = $date_regs[3];
            }
            if ($month > 12 || $day > 31) {
                $evil_post = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        } elseif ($calendar_style == "euro") {
            if (isset($date_regs)) {
                $month = $date_regs[2];
                $day = $date_regs[1];
                $year = $date_regs[3];
            }
            if ($month > 12 || $day > 31) {
                $evil_post = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        }
    }

    if (isset($evil_post)) {
        echo "            <br />\n";
        echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr>\n";
        echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Edit Time
                </th></tr>\n";
        echo "              <tr><td height=15></td></tr>\n";
        echo "              <input type='hidden' name='date_format' value='$js_datefmt'>\n";
        echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Username:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_username' value=\"$post_username\">$post_username</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Display Name:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_displayname' value=\"$post_displayname\">$post_displayname</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Date: ($tmp_datefmt)</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date' value='$post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\"
                      onclick=\"cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt');
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
        echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
        echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
        echo "            </table>\n";
        echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
        echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr><td height=40>&nbsp;</td></tr>\n";
        echo "              <tr><td width=30><input type='image' name='submit' value='Edit Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
        include '../footer.php';
        exit;

        // end post validation //

    } else {

        if (isset($_POST['tmp_var'])) {

            // begin post validation //

            if ($_POST['tmp_var'] != '1') {
                echo "Something is fishy here.\n";
                exit;
            }
            $tmp2_calc = intval($calc);
            $tmp2_timestamp = intval($timestamp);
            if ((strlen($tmp2_calc) != "10") || (!is_integer($tmp2_calc))) {
                echo "Something is fishy here.\n";
                exit;
            }
            if ((strlen($tmp2_timestamp) != "10") || (!is_integer($tmp2_timestamp))) {
                echo "Something is fishy here.\n";
                exit;
            }
            if (!is_numeric($final_num_rows)) {
                exit;
            }

            // end post validation //

            for ($x = 0; $x < $final_num_rows; $x++) {
                if ($final_username[$x] != $tmp_username) {
                    echo "Something is fishy heree.\n";
                    exit;
                }
                $final_mysql_timestamp[$x] = intval($final_mysql_timestamp[$x]);
                if ((strlen($final_mysql_timestamp[$x]) != "10") || (!is_integer($final_mysql_timestamp[$x]))) {
                    echo "Something is fishy here.\n";
                    exit;
                }


                $punchitems = tc_select_value("punchitems", "punchlist", "punchitems = ?", $final_inout[$x]);
                if (!isset($punchitems)) {
                    echo "Something is fishy here.\n";
                    exit;
                }

                $tmp_num_rows = tc_select_value(
                    "COUNT(1)", "info", "fullname = ? AND timestamp = ? AND `inout` = ?",
                    array($final_username[$x], $final_mysql_timestamp[$x], $final_inout[$x])
                );
                if ((isset($tmp_num_rows)) && (@$tmp_num_rows != '1')) {
                    echo "Something is fishy here.\n";
                    exit;
                }

                if (!empty($edit_time_textbox[$x])) {

                    // configure timestamp to insert/update //

                    if ($calendar_style == "euro") {
                        $post_date = "$day/$month/$year";
                    } elseif ($calendar_style == "amer") {
                        $post_date = "$month/$day/$year";
                    }

                    $tmp_timestamp = strtotime("$month/$day/$year") - @$tzo;
                    $tmp_calc = $timestamp + 86400;

                    if (($tmp_timestamp != $timestamp) || ($tmp_calc != $calc)) {
                        echo "Something is fishy here.\n";
                        exit;
                    }

                    // end post validation //

                    if ($timefmt_24hr == '0') {

                        // 12 Hour with or without leading zeros with upper or lower case AM or PM //
                        // Regex was /^([0-9]?[0-9])+:+([0-9]+[0-9])+([a|p]+m)$/i                  //
                        // Now       /^([0-1]?[0-9])+:+([0-5]+[0-9])+([a|p]+m)$/i                  //
                        // First digit of hours in 12 hour format can not be > 1.                  //
                        // First digit of minutes can not be > 5 any time.                         //

                        if ((!preg_match('/' . "^([0-9]?[0-9])+:+([0-9]+[0-9])+([a|p]+m)$" . '/i', $edit_time_textbox[$x], $time_regs)) && (!preg_match('/' . "^([0-9]?[0-9])+:+([0-9]+[0-9])+( [a|p]+m)$" . '/i', $edit_time_textbox[$x], $time_regs))) {
                            $evil_time = '1';
                        } else {

                            if (isset($time_regs)) {
                                $h = $time_regs[1];
                                $m = $time_regs[2];
                            }
                            $h = $time_regs[1];
                            $m = $time_regs[2];
                            if (($h > 12) || ($m > 59)) {
                                $evil_time = '1';
                            }
                        }
                    } elseif ($timefmt_24hr == '1') {

                        // 24 Hour with or without leading zeros with upper or lower case AM or PM //
                        // Regex was /^([0-9]?[0-9])+:+([0-9]+[0-9])+([a|p]+m)$/i                  //
                        // Now       /^([0-2]?[0-9])+:+([0-5]+[0-9])+$/                            //
                        //    First digit of hours in 24 hour format can not be > 2.               //
                        //    First digit of minutes can not be > 5 any time.                      //
                        //    No am/pm in 24 hour format.  No need for case indifferent /i.        //

                        if (!preg_match('/' . "^([0-2]?[0-9])+:+([0-5]+[0-9])+$" . '/', $edit_time_textbox[$x], $time_regs)) {
                            $evil_time = '1';

                        } else {

                            if (isset($time_regs)) {
                                $h = $time_regs[1];
                                $m = $time_regs[2];
                            }
                            $h = $time_regs[1];
                            $m = $time_regs[2];
                            if (($h > 24) || ($m > 59)) {
                                $evil_time = '1';
                            }
                        }
                    }
                }
            }

            for ($x = 0; $x < $final_num_rows; $x++) {
                if (empty($edit_time_textbox[$x])) {
                    $cnt++;
                }
            }

            if ($cnt == $final_num_rows) {
                $evil_time = '1';
            }

            if (isset($evil_time)) {
                echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr>\n";
                echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
                echo "            </table>\n";
                echo "            <br />\n";
                echo "            <form name='form' action='$self' method='post'>\n";
                echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
                echo "              <tr>\n";

                // configure date to display correctly //

                echo "                <th class=rightside_heading nowrap halign=left colspan=4><img src='../images/icons/clock_edit.png' />&nbsp;&nbsp;&nbsp;Edit
                  Time for $post_username on $post_date</th></tr>\n";
                echo "              <tr><td height=15></td></tr>\n";
                echo "                <tr><td nowrap width=1% class=column_headings style='padding-right:5px;padding-left:10px;'><b>New Time<b></td>\n";
                echo "                  <td nowrap width=7% align=left style='padding-left:15px;' class=column_headings>In/Out</td>\n";
                echo "                  <td nowrap style='padding-left:20px;' width=4% align=left class=column_headings>Current Time</td>\n";
                echo "                  <td style='padding-left:25px;' class=column_headings><u>Notes</u></td></tr>\n";

                for ($x = 0; $x < $final_num_rows; $x++) {
                    $row_color = ($row_count % 2) ? $color1 : $color2;
                    echo "              <tr class=display_row>\n";
                    echo "                <td nowrap width=1% style='padding-right:5px;padding-left:10px;' class=table_rows><input type='text'
                    size='7' maxlength='$timefmt_size' name='edit_time_textbox[$x]' value=\"$edit_time_textbox[$x]\"></td>\n";
                    echo "                <td nowrap align=left style='width:7%;padding-left:15px;background-color:$row_color;color:" . $row["color"] . "'>$final_inout[$x]</td>\n";
                    echo "                <td nowrap align=left style='padding-left:20px;' width=4% bgcolor='$row_color'>$final_time[$x]</td>\n";
                    echo "                <td style='padding-left:25px;' bgcolor='$row_color'><input type='text' size='15' name='final_notes[$x]' value=\"$final_notes[$x]\"></td>\n";
                    echo "              </tr>\n";
                    echo "              <input type='hidden' name='final_username[$x]' value=\"$final_username[$x]\">\n";
                    echo "              <input type='hidden' name='final_inout[$x]' value=\"$final_inout[$x]\">\n";
                    echo "              <input type='hidden' name='final_time[$x]' value=\"$final_time[$x]\">\n";
                    echo "              <input type='hidden' name='final_mysql_timestamp[$x]' value=\"$final_mysql_timestamp[$x]\">\n";
                    $row_count++;
                }
                echo "              <tr><td height=15></td></tr>\n";
                $tmp_var = '1';
                echo "            <input type='hidden' name='calc' value=\"$calc\">\n";
                echo "            <input type='hidden' name='timestamp' value=\"$timestamp\">\n";
                echo "            <input type='hidden' name='tmp_var' value=\"$tmp_var\">\n";
                echo "            <input type='hidden' name='post_username' value=\"$post_username\">\n";
                echo "            <input type='hidden' name='post_displayname' value=\"$post_displayname\">\n";
                echo "            <input type='hidden' name='post_date' value=\"$post_date\">\n";
                echo "            <input type='hidden' name='get_user' value=\"$get_user\">\n";
                echo "            <input type='hidden' name='final_num_rows' value=\"$final_num_rows\">\n";
                echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr><td height=40>&nbsp;</td></tr>\n";
                echo "              <tr><td width=30><input type='image' name='submit' value='Edit Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
                include '../footer.php';
                exit;
            } elseif (!isset($evil_time)) {

                echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr>\n";
                echo "              <td class=table_rows width=20 align=center><img src='../images/icons/accept.png' /></td><td class=table_rows_green>
                  &nbsp;Time edited successfully.</td></tr>\n";
                echo "            </table>\n";
                echo "            <br />\n";
                echo "            <form name='form' action='$self' method='post'>\n";
                echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
                echo "              <tr>\n";

                // configure date to display correctly //

                echo "                <th class=rightside_heading nowrap halign=left colspan=5><img src='../images/icons/clock_edit.png' />&nbsp;&nbsp;&nbsp;Edited
                  Time for $post_username on $post_date</th></tr>\n";
                echo "              <tr><td height=15></td></tr>\n";
                echo "                <tr><td width=1% class=table_rows style='padding-left:5px;padding-right:5px;'></td><td nowrap width=1% class=column_headings
                        style='padding-right:5px;'><b>New Time<b></td>\n";
                echo "                  <td nowrap width=7% align=left style='padding-left:15px;' class=column_headings>In/Out</td>\n";
                echo "                  <td nowrap style='padding-left:20px;' width=4% align=left class=column_headings>Old Time</td>\n";
                echo "                  <td style='padding-left:25px;' class=column_headings><u>Notes</u></td></tr>\n";

                $new_tstamp = array();

                // determine who the authenticated user is for audit log

                if (isset($_SESSION['valid_user'])) {
                    $user = $_SESSION['valid_user'];
                } elseif (isset($_SESSION['time_admin_valid_user'])) {
                    $user = $_SESSION['time_admin_valid_user'];
                } else {
                    $user = "";
                }

                // configure current time to insert for audit log
                $time_tz_stamp = time();

                // this needs to be changed later
                $post_why = "";

                for ($x = 0; $x < $final_num_rows; $x++) {
                    if ($edit_time_textbox[$x] != '') {
                        $row_color = ($row_count % 2) ? $color1 : $color2;
                        $tmp_tstamp = tc_select_value("tstamp", "employees", "empfullname = ?", $final_username[$x]);

                        // configure timestamp to insert/update //
                        $new_tstamp[$x] = strtotime("$month/$day/$year " . $edit_time_textbox[$x]) - $tzo;

                        if ($new_tstamp[$x] > $tmp_tstamp) {
                            tc_update_strings("employees", array("tstamp" => $new_tstamp[$x]), "empfullname = ?", $final_username[$x]);
                        }

                        elseif ($new_tstamp[$x] < $tmp_tstamp) {
                            $tmp_tstamp_2 = tc_select_value(
                                "MAX(timestamp)", "info", "fullname = ? AND timestamp != ?",
                                array($final_username[$x], $final_mysql_timestamp[$x])
                            );
                            if ($new_tstamp[$x] > @$tmp_tstamp_2) { $tmp_tstamp_2 = $new_tstamp[$x]; }
                            if (isset($tmp_tstamp_2) && $tmp_tstamp_2 != $tmp_tstamp) {
                                tc_update_strings("employees", array("tstamp" => $tmp_tstamp_2), "empfullname = ?", $final_username[$x]);
                            }
                        }

                        tc_update_strings(
                            "info",
                            array("timestamp" => $new_tstamp[$x], "notes" => $final_notes[$x]),
                            "fullname = ? AND `inout` = ? AND timestamp = ?",
                            array($final_username[$x], $final_inout[$x], $final_mysql_timestamp[$x])
                        );
                        tc_refresh_latest_emp_punch($final_username[$x]);

                        // add the results to the audit table
                        $data = array(
                            "modified_by_user" => "$user",
                            "modified_when" => $time_tz_stamp,
                            "modified_from" => $final_mysql_timestamp[$x],
                            "modified_to" => $new_tstamp[$x],
                            "modified_why" => "$post_why",
                            "user_modified" => $final_username[$x],
                        );
                        if (yes_no_bool($ip_logging)) {
                            $data["modified_by_ip"] = "$connecting_ip";
                        }
                        if (yes_no_bool($audit_office) && !empty($_COOKIE['office_name'])) {
                            $data["modified_office"] = "".$_COOKIE['office_name'];
                        }
                        tc_insert_strings("audit", $data);

                        echo "                <tr class=display_row><td width=1% align=center class=table_rows bgcolor='$row_color' style='padding-left:5px;padding-right:5px;'>
                        <img src='../images/icons/accept.png' /></td><td nowrap width=1% class=table_rows style='padding-right:5px;' bgcolor='$row_color'>
                        &nbsp;&nbsp;$edit_time_textbox[$x]</td>\n";
                        echo "                  <td nowrap width=7% align=left style='padding-left:15px;' class=table_rows bgcolor='$row_color'>$final_inout[$x]</td>\n";
                        echo "                  <td nowrap style='padding-left:20px;' width=4% align=left class=table_rows bgcolor='$row_color'>$final_time[$x]</td>\n";
                        echo "                  <td style='padding-left:25px;' class=table_rows bgcolor='$row_color'>$final_notes[$x]</td></tr>\n";
                        $row_count++;
                    }
                }
                echo "              <tr><td height=15></td></tr>\n";
                echo "            </table>\n";
                echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr><td height=20 align=left>&nbsp;</td></tr>\n";
                echo "              <tr><td><a href='timeadmin.php'><img src='../images/buttons/done_button.png' border='0'></td></tr></table></td></tr>\n";
                include '../footer.php';
                exit;
            }

        } else {
            // configure timestamp to insert/update //

            if ($calendar_style == "euro") {
                $post_date = "$day/$month/$year";
            } elseif ($calendar_style == "amer") {
                $post_date = "$month/$day/$year";
            }

            $row_count = '0';
            $timestamp = strtotime("$month/$day/$year") - @$tzo;
            $calc = $timestamp + 86400;

            $username = array();
            $inout = array();
            $notes = array();
            $mysql_timestamp = array();

            $result = tc_select(
                "fullname, `inout`, timestamp, notes",
                "info", "fullname = ? AND timestamp < ? AND timestamp >= ? ORDER BY timestamp ASC",
                array($post_username, $calc, $timestamp)
            );
            while ($row = mysqli_fetch_array($result)) {
                $time_set = '1';
                $username[] = "" . $row['fullname'];
                $inout[] = "" . $row['inout'];
                $notes[] = "" . $row['notes'];
                $mysql_timestamp[] = "" . $row['timestamp'];
            }
            $num_rows = mysqli_num_rows($result);
        }

        if (!isset($time_set)) {
            // configure date to display correctly //

            echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    No time was found in the system for $post_username on $post_date.</td></tr>\n";
            echo "            </table>\n";
            echo "            <br />\n";
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
            echo "              <tr>\n";
            echo "                <th class=rightside_heading nowrap halign=left colspan=4><img src='../images/icons/clock_edit.png' />&nbsp;&nbsp;&nbsp;Edit Time
                </th></tr>\n";
            echo "              <tr><td height=15></td></tr>\n";
            echo "                <input type='hidden' name='date_format' value='$js_datefmt'>\n";
            echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Username:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_username' value=\"$post_username\">$post_username</td></tr>\n";
            echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Display Name:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_displayname' value=\"$post_displayname\">$post_displayname</td></tr>\n";
            echo "              <tr><td class=table_rows height=25 style='padding-left:32px;' width=20% nowrap>Date: ($tmp_datefmt)</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date' value='$post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\"
                      onclick=\"cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt');
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
            echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
            echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
            echo "            </table>\n";
            echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
            echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr><td height=40>&nbsp;</td></tr>\n";
            echo "              <tr><td width=30><input type='image' name='submit' value='Edit Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
            include '../footer.php';
            exit;
        }

        echo "            <form name='form' action='$self' method='post'>\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr>\n";
        echo "                <td class=table_rows width=20 align=center><img src='../images/icons/time.png' /></td><td class=table_rows style='color:#3366CC;'>
                   Please enter a time in the New Time box or boxes you wish to edit below.</td></tr>\n";
        echo "            </table>\n";
        echo "            <br />\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
        echo "              <tr>\n";

        // configure date to display correctly //

        echo "                <th class=rightside_heading nowrap halign=left colspan=4><img src='../images/icons/clock_edit.png' />&nbsp;&nbsp;&nbsp;Edit
                  Time for $post_username on $post_date</th></tr>\n";
        echo "              <tr><td height=15></td></tr>\n";

        if (isset($time_set)) {
            echo "                <tr><td nowrap width=1% class=column_headings style='padding-right:5px;padding-left:10px;'><b>New Time<b></td>\n";
            echo "                  <td nowrap width=7% align=left style='padding-left:15px;' class=column_headings>In/Out</td>\n";
            echo "                  <td nowrap style='padding-left:20px;' width=4% align=left class=column_headings>Current Time</td>\n";
            echo "                  <td style='padding-left:25px;' class=column_headings><u>Notes</u></td></tr>\n";

            for ($x = 0; $x < $num_rows; $x++) {
                $row_color = ($row_count % 2) ? $color1 : $color2;
                $time[$x] = date("$timefmt", $mysql_timestamp[$x] + $tzo);

                echo "              <tr class=display_row>\n";
                echo "                <td nowrap width=1% style='padding-right:5px;padding-left:10px;' class=table_rows><input type='text'
                    size='7' maxlength='$timefmt_size' name='edit_time_textbox[$x]'></td>\n";
                echo "                <td nowrap align=left style='width:7%;padding-left:15px;background-color:$row_color;color:" . $row["color"] . "'>$inout[$x]</td>\n";
                echo "                <td nowrap align=left style='padding-left:20px;' width=4% bgcolor='$row_color'>$time[$x]</td>\n";
                echo "                <td style='padding-left:25px;' bgcolor='$row_color'><input type='text' size='15' name='final_notes[$x]' value=\"$notes[$x]\"></td>\n";
                echo "              </tr>\n";
                echo "              <input type='hidden' name='final_username[$x]' value=\"$username[$x]\">\n";
                echo "              <input type='hidden' name='final_inout[$x]' value=\"$inout[$x]\">\n";
                echo "              <input type='hidden' name='final_mysql_timestamp[$x]' value=\"$mysql_timestamp[$x]\">\n";
                echo "              <input type='hidden' name='final_time[$x]' value=\"$time[$x]\">\n";
                $row_count++;
            }
            echo "              <tr><td height=15></td></tr>\n";
            $tmp_var = '1';
            echo "            <input type='hidden' name='tmp_var' value=\"$tmp_var\">\n";
            echo "            <input type='hidden' name='post_username' value=\"$post_username\">\n";
            echo "            <input type='hidden' name='post_displayname' value=\"$post_displayname\">\n";
            echo "            <input type='hidden' name='post_date' value=\"$post_date\">\n";
            echo "            <input type='hidden' name='num_rows' value=\"$num_rows\">\n";
            echo "            <input type='hidden' name='calc' value=\"$calc\">\n";
            echo "            <input type='hidden' name='timestamp' value=\"$timestamp\">\n";
            echo "            <input type='hidden' name='get_user' value=\"$get_user\">\n";
            echo "            <input type='hidden' name='final_num_rows' value=\"$num_rows\">\n";
            echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr><td height=40>&nbsp;</td></tr>\n";
            echo "              <tr><td width=30><input type='image' name='submit' value='Edit Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
            include '../footer.php';
            exit;
        }
    }
}
?>
