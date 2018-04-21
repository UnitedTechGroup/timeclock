<html>
<?php

require '../common.php';
setup_csrf_protection();

// grab the connecting ip address for the audit log. if more than 1 ip address is returned, accept the first ip and discard the rest. //

$connecting_ip = get_ipaddress();
if (empty($connecting_ip)) {
    return false;
}

// determine if connecting ip address is allowed to connect to PHP Timeclock //

if ($restrict_ips == "yes") {
    for ($x = 0; $x < count($allowed_networks); $x++) {
        $is_allowed = ip_range($allowed_networks[$x], $connecting_ip);
        if (!empty($is_allowed)) {
            $allowed = true;
        }
    }
    if (!isset($allowed)) {
        echo "You are not authorized to view this page.";
        exit;
    }
}

// check for correct db version //
tc_connect();

// include css and timezone offset//

if (($use_client_tz == "yes") && ($use_server_tz == "yes")) {
    echo 'Please reconfigure your config.inc.php file, you cannot have both $use_client_tz AND $use_server_tz set to \'yes\'';
    exit;
}

echo "<head>\n";
if ($use_client_tz == "yes") {
    if (!isset($_COOKIE['tzoffset'])) {
        include '../tzoffset.php';
        echo "<meta http-equiv='refresh' content='0;URL=index.php'>\n";
    }
}
?>

<link rel="stylesheet" type="text/css" media="screen" href="../css/default.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/local.css" />
<link rel="stylesheet" type="text/css" media="print" href="../css/print.css" />
<script language="javascript" src="../scripts/jquery-3.1.1.min.js"></script>
<script language="javascript" src="../scripts/pnguin.js"></script>
<script language="javascript" src="../scripts/cookies.js"></script>
<script language="javascript" src="../scripts/admin.js"></script>
<script type="text/javascript" src="../scripts/CalendarPopup.js"></script>
<script language="javascript">document.write(getCalendarStyles());</script>
