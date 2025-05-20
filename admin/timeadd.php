<?php
session_start();

include 'header_date.php';
include 'topmain.php';
echo "<title>$title - Add Time</title>\n";

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
                add a time.</td></tr>\n";
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
    echo "        <tr><td class=current_left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Add Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeadd.php?username=$get_user\">Add Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Edit Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeedit.php?username=$get_user\">Edit Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timedelete.php?username=$get_user\">Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
    echo "      </table></td>\n";

    $result = tc_select("empfullname, displayname", "employees", "empfullname = ?", $get_user);
    while ($row = mysqli_fetch_array($result)) {
        $username = "" . $row['empfullname'] . "";
        $displayname = "" . $row['displayname'] . "";
    }

    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
    echo "            <br />\n";
    echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
    echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
    echo "              <tr>\n";
    echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Add Time
                    </th>\n";
    echo "              </tr>\n";
    echo "              <tr><td height=15></td></tr>\n";
    echo "                <input type='hidden' name='date_format' value='$js_datefmt'>\n";
    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Username:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_username' value=\"$username\">$username</td></tr>\n";
    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Display Name:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_displayname' value=\"$displayname\">$displayname</td></tr>\n";
    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Date: ($tmp_datefmt)</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\" 
                      onclick=\"form.post_date.value='';cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt'); 
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Time:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
                      <input type='text' size='10' maxlength='$timefmt_size' name='post_time'>&nbsp;*&nbsp;&nbsp;
                      <a style='text-decoration:none;font-size:11px;color:#27408b;'>($timefmt_24hr_text)</a></td></tr>\n";
    echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
    echo "                <input type='hidden' name='timefmt_24hr' value=\"$timefmt_24hr\">\n";
    echo "                <input type='hidden' name='timefmt_24hr_text' value=\"$timefmt_24hr_text\">\n";
    echo "                <input type='hidden' name='timefmt_size' value=\"$timefmt_size\">\n";

    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Status:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
          <select name='post_statusname'>\n";
    echo "<option value ='1'>Choose One</option>\n";
    echo html_options(tc_select("punchitems", "punchlist", "1=1 ORDER BY punchitems ASC"));
    echo "</select>&nbsp;*</td></tr>\n";

    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Notes:</td><td align=left colspan=2 width=80%
                      style='padding-left:20px;'><input type='text' size='17' maxlength='250' name='post_notes'></td></tr>\n";
    echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
    echo "            </table>\n";
    echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
    echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
    echo "              <tr><td height=40>&nbsp;</td></tr>\n";
    echo "              <tr><td width=30><input type='image' name='submit' value='Add Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
    include '../footer.php';
    exit;
}

elseif ($request == 'POST') {
    $get_user = $_POST['get_user'];
    $post_username = $_POST['post_username'];
    $post_displayname = $_POST['post_displayname'];
    $post_date = $_POST['post_date'];
    $post_time = $_POST['post_time'];
    $post_statusname = $_POST['post_statusname'];
    $post_notes = $_POST['post_notes'];
    $timefmt_24hr = $_POST['timefmt_24hr'];
    $timefmt_24hr_text = $_POST['timefmt_24hr_text'];
    $timefmt_size = $_POST['timefmt_size'];
    $date_format = $_POST['date_format'];

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

    if (!empty($post_statusname) and $post_statusname != '1') {
        $color = tc_select_value("color", "punchlist", "punchitems = ?", $post_statusname);
        if (!isset($color)) {
            echo "Something is fishy here.\n";
            exit;
        }
    }

    if (($timefmt == "G:i") || ($timefmt == "H:i")) {
        $tmp_timefmt_24hr = '1';
        $tmp_timefmt_24hr_text = '24 hr format';
        $tmp_timefmt_size = '5';
    } else {
        $tmp_timefmt_24hr = '0';
        $tmp_timefmt_24hr_text = '12 hr format';
        $tmp_timefmt_size = '8';
    }

    if (($timefmt_24hr != $tmp_timefmt_24hr) || ($timefmt_24hr_text != $tmp_timefmt_24hr_text) || ($timefmt_size != $tmp_timefmt_size)) {
        echo "Something is fishy here.\n";
        exit;
    }
    if ($date_format != $js_datefmt) {
        echo "Something is fishy here.\n";
        exit;
    }

    if ($post_notes == "") {
        $post_notes = " ";
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
    echo "        <tr><td class=current_left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Add Time' />
                &nbsp;&nbsp;<a class=admin_headings href=\"timeadd.php?username=$get_user\">Add Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_indent height=18 align=left valign=middle><img src='../images/icons/arrow_right.png' alt='Edit Time' />
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
    if ((empty($post_date)) || (empty($post_time)) || ($post_statusname == '1') || (!preg_match('/' . "^([[:alnum:]]| |-|_|\.)+$" . '/i', $post_statusname)) ||
        (!preg_match("/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.](([0-9]{2})|([0-9]{4}))$/i", $post_date))
    ) {
        $evil_post = '1';
        if (empty($post_date)) {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
            echo "            </table>\n";
        } elseif (empty($post_time)) {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
            echo "            </table>\n";
        } elseif ($post_statusname == "1") {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A Status must be chosen.</td></tr>\n";
            echo "            </table>\n";
        } elseif (!preg_match('/' . "^([[:alnum:]]| |-|_|\.)+$" . '/i', $post_statusname)) {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    Alphanumeric characters, hyphens, underscores, spaces, and periods are allowed in a Status Name.</td></tr>\n";
            echo "            </table>\n";
        } elseif (!preg_match("/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.](([0-9]{2})|([0-9]{4}))$/i", $post_date)) {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
            echo "            </table>\n";
        }
    } // end if

    elseif ($timefmt_24hr == '0') {

        if ((!preg_match('/' . "^([0-9]?[0-9])+:+([0-9]+[0-9])+([a|p]+m)$" . '/i', $post_time, $time_regs)) && (!preg_match('/' . "^([0-9]?[0-9])+:+([0-9]+[0-9])+( [a|p]+m)$" . '/i', $post_time,
                                                                                                     $time_regs))
        ) {
            $evil_time = '1';
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
            echo "            </table>\n";

        } else {

            if (isset($time_regs)) {
                $h = $time_regs[1];
                $m = $time_regs[2];
            }
            $h = $time_regs[1];
            $m = $time_regs[2];
            if (($h > 12) || ($m > 59)) {
                $evil_time = '1';
                echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr>\n";
                echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
                echo "            </table>\n";
            }
        }
    } elseif ($timefmt_24hr == '1') {
        if (!preg_match('/' . "^([0-9]?[0-9])+:+([0-9]+[0-9])$" . '/i', $post_time, $time_regs)) {
            $evil_time = '1';
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
            echo "            </table>\n";

        } else {

            if (isset($time_regs)) {
                $h = $time_regs[1];
                $m = $time_regs[2];
            }
            $h = $time_regs[1];
            $m = $time_regs[2];
            if (($h > 24) || ($m > 59)) {
                $evil_time = '1';
                echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                echo "              <tr>\n";
                echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Time is required.</td></tr>\n";
                echo "            </table>\n";
            }
        }
    }

    if (preg_match("/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.](([0-9]{2})|([0-9]{4}))$/i", $post_date, $date_regs)) {
        if ($calendar_style == "amer") {
            if (isset($date_regs)) {
                $month = $date_regs[1];
                $day = $date_regs[2];
                $year = $date_regs[3];
            }
            if ($month > 12 || $day > 31) {
                $evil_date = '1';
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
                $evil_date = '1';
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

    if ((isset($evil_post)) || (isset($evil_date)) || (isset($evil_time))) {
        echo "            <br />\n";
        echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
        echo "              <tr>\n";
        echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Add Time
                    </th>\n";
        echo "              </tr>\n";
        echo "              <tr><td height=15></td></tr>\n";
        echo "                <input type='hidden' name='date_format' value='$js_datefmt'>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Username:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_username' value=\"$post_username\">$post_username</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Display Name:</td><td align=left class=table_rows
                      colspan=2 width=80% style='padding-left:20px;'>
                      <input type='hidden' name='post_displayname' value=\"$post_displayname\">$post_displayname</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Date:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date' value='$post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\"
                      onclick=\"cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt');
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Time:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
                      <input type='text' size='10' maxlength='$timefmt_size' name='post_time' value='$post_time'>&nbsp;*&nbsp;&nbsp;
                      <a style='text-decoration:none;font-size:11px;color:#27408b;'>($timefmt_24hr_text)</a></td></tr>\n";
        echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
        echo "                <input type='hidden' name='timefmt_24hr' value=\"$timefmt_24hr\">\n";
        echo "                <input type='hidden' name='timefmt_24hr_text' value=\"$timefmt_24hr_text\">\n";
        echo "                <input type='hidden' name='timefmt_size' value=\"$timefmt_size\">\n";

        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Status:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
              <select name='post_statusname'>\n";
        echo "<option value ='1'>Choose One</option>\n";
        echo html_options(tc_select("punchitems", "punchlist", "1=1 ORDER BY punchitems ASC"), $post_statusname);
        echo "</select>&nbsp;*</td></tr>\n";

        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Notes:</td><td align=left colspan=2 width=80%
                      style='padding-left:20px;'><input type='text' size='17' maxlength='250' name='post_notes' value='$post_notes'></td></tr>\n";
        echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
        echo "            </table>\n";
        echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
        echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr><td height=40>&nbsp;</td></tr>\n";
        echo "              <tr><td width=30><input type='image' name='submit' value='Add Time' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
        include '../footer.php';
        exit;

    } else {

        // configure timestamp to insert/update

        if ($calendar_style == "euro") {
            //  $post_date = "$day/$month/$year";
            $post_date = "$month/$day/$year";
        } elseif ($calendar_style == "amer") {
            $post_date = "$month/$day/$year";
        }

        $timestamp = strtotime($post_date . " " . $post_time) - @$tzo;

        // check for duplicate time for $post_username

        $result = tc_select("timestamp", "info", "fullname = ? AND timestamp = ?", array($post_username, $timestamp));

        while ($row = mysqli_fetch_array($result)) {
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr>\n";
            echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                Duplicate time exists for this user on this date. Time not added..</td></tr>\n";
            echo "            </table>\n";
            echo "            <br />\n";
            echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
            echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
            echo "              <tr>\n";
            echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Add Time
                </th>\n";
            echo "              </tr>\n";
            echo "              <tr><td height=15></td></tr>\n";
            echo "                <input type='hidden' name='date_format' value='$js_datefmt'>\n";
            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Username:</td><td align=left class=table_rows
                  colspan=2 width=80% style='padding-left:20px;'>
                  <input type='hidden' name='post_username' value=\"$post_username\">$post_username</td></tr>\n";
            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Display Name:</td><td align=left class=table_rows
                  colspan=2 width=80% style='padding-left:20px;'>
                  <input type='hidden' name='post_displayname' value=\"$post_displayname\">$post_displayname</td></tr>\n";
            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Date:</td><td colspan=2 width=80%
                  style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                  size='10' maxlength='10' name='post_date' value='$post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\"
                  onclick=\"cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt');
                  return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Date</a></td><tr>\n";
            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Time:</td><td colspan=2 width=80%
                  style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
                  <input type='text' size='10' maxlength='$timefmt_size' name='post_time' value='$post_time'>&nbsp;*&nbsp;&nbsp;
                  <a style='text-decoration:none;font-size:11px;color:#27408b;'>($timefmt_24hr_text)</a></td></tr>\n";
            echo "                <input type='hidden' name='get_user' value=\"$get_user\">\n";
            echo "                <input type='hidden' name='timefmt_24hr' value=\"$timefmt_24hr\">\n";
            echo "                <input type='hidden' name='timefmt_24hr_text' value=\"$timefmt_24hr_text\">\n";
            echo "                <input type='hidden' name='timefmt_size' value=\"$timefmt_size\">\n";

            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Status:</td><td colspan=2 width=80%
                  style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
                  <select name='post_statusname'>\n";
            echo "<option value ='1'>Choose One</option>\n";
            echo html_options(tc_select("punchitems", "punchlist", "1=1 ORDER BY punchitems ASC"), $post_statusname);
            echo "</select>&nbsp;*</td></tr>\n";

            echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Notes:</td><td align=left colspan=2 width=80%
                  style='padding-left:20px;'><input type='text' size='17' maxlength='250' name='post_notes' value='$post_notes'></td></tr>\n";
            echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
            echo "            </table>\n";
            echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
             height=200>&nbsp;</div>\n";
            echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
            echo "              <tr><td height=40>&nbsp;</td></tr>\n";
            echo "              <tr><td width=30><input type='image' name='submit' value='Add Time' align='middle'
                  src='../images/buttons/next_button.png'></td><td><a href='timeadmin.php'><img src='../images/buttons/cancel_button.png'
                  border='0'></td></tr></table></form></td></tr>\n";
            include '../footer.php';
            exit;
        }

        // check to see if this would be the most recent time for $post_username. if so, run the update query for the employees table.

        $employees_table_timestamp = tc_select_value("tstamp", "employees", "empfullname = ?", $post_username);
        if ($timestamp > $employees_table_timestamp) {
            tc_update_strings("employees", array("tstamp" => $timestamp), "empfullname = ?", $post_username);
        }

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

        // add the time to the info table for $post_username

        tc_insert_strings("info", array(
            "fullname"  => $post_username,
            "inout"     => $post_statusname,
            "timestamp" => $timestamp,
            "notes"     => trim("$post_notes"),
        ));
        tc_refresh_latest_emp_punch($post_username);

        // add the results to the audit table

        $data = array(
            "modified_by_user" => "$user",
            "modified_when" => $time_tz_stamp,
            "modified_from" => 0,
            "modified_to" => $timestamp,
            "modified_why" => "$post_why",
            "user_modified" => $post_username,
        );
        if (yes_no_bool($ip_logging)) {
            $data["modified_by_ip"] = "$connecting_ip";
        }
        if (yes_no_bool($audit_office) && !empty($_COOKIE['office_name'])) {
            $data["modified_office"] = "".$_COOKIE['office_name'];
        }
        tc_insert_strings("audit", $data);

        $post_date = date($datefmt, $timestamp + @$tzo);

        echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr>\n";
        echo "              <td class=table_rows width=20 align=center><img src='../images/icons/accept.png' /></td><td class=table_rows_green>
                  &nbsp;Time added successfully.</td></tr>\n";
        echo "            </table>\n";
        echo "            <br />\n";
        echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate();\">\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
        echo "              <tr>\n";
        echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Add Time
                    </th>\n";
        echo "              </tr>\n";
        echo "              <tr><td height=15></td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Username:</td><td align=left class=table_rows
colspan=2 width=80% style='padding-left:20px;'>$post_username</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Display Name:</td><td align=left class=table_rows
colspan=2 width=80% style='padding-left:20px;'>$post_displayname</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Date:</td><td align=left class=table_rows
colspan=2 width=80% style='padding-left:20px;'>$post_date</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Time:</td><td align=left class=table_rows
colspan=2 width=80% style='padding-left:20px;'>$post_time</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Status:</td><td align=left class=table_rows colspan=2
width=80% style='color:$color;padding-left:20px;'>$post_statusname</td></tr>\n";
        echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Notes:</td><td align=left class=table_rows
colspan=2 width=80% style='padding-left:20px;'>$post_notes</td></tr>\n";
        echo "              <tr><td height=15></td></tr>\n";
        echo "            </table>\n";
        echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr><td height=20 align=left>&nbsp;</td></tr>\n";
        echo "              <tr><td><a href='timeadmin.php'><img src='../images/buttons/done_button.png' border='0'></td></tr></table></td></tr>\n";
        include '../footer.php';
        exit;
    }
}
?>
