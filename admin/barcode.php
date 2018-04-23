<?php
session_start();
require '../common.php';


function MAIN() {
    global $barcode_rendering;

    if (yes_no_bool($barcode_rendering) and csrf_ok() and isset($_SESSION['valid_user'])) {
        if (@$_REQUEST['action'] === 'render') {
            if (has_value(@$_REQUEST['render']) && has_value(@$_REQUEST['type'])) {
                action_render(trim($_REQUEST['render']), trim($_REQUEST['type']));
            } else {
                croak(400, 'Missing value');
            }
        }

        elseif (@$_REQUEST['action'] === 'download') {
            if (has_value(@$_REQUEST['download'])) {
                action_download(trim($_REQUEST['download']));
            } else {
                croak(400, 'Missing value');
            }
        }

        else {
            croak(404, 'No such action');
        }
    } else {
        croak(403, 'Forbidden');
    }
}


function clean_barcode_cache($path, $time) {
    $files = glob("$path/*");

    foreach ($files as $file) {
        if (is_file($file)) {
            if (filemtime($file) < $time) {
                unlink($file);
            }
        }
    }
}

function action_render($value, $encoding) {
    json_out(array(
        "ok"  => true,
        "key" => do_render($value, $encoding),
    ));
}

function do_render($value, $encoding) {
    global $barcode_cache_dir;
    global $barcode_cache_age;

    if (preg_match('/[^a-zA-Z0-9]/', $value)) {
        croak(400, 'Invalid value');
    }

    $grp = array();
    if (!preg_match('/^(code39|EAN|UPC)$/', $encoding, $grp)) {
        croak(400, 'Invalid value');
    }
    $encoding = $grp[1];


    # Regardless of what $value is, we want the key to be safe:
    $key = hash("sha256", $value);
    $basename = "$barcode_cache_dir/$key";

    if (is_file("$basename.png")) {
        touch("$basename.png");
        return $key;
    }

    if (!(true === @mkdir($barcode_cache_dir, 0750, true) or is_dir($barcode_cache_dir))) {
        croak(500, 'Bummer');
    }

    clean_barcode_cache($barcode_cache_dir, strtotime('-' . $barcode_cache_age));

    # Render to .eps file
    $cmd = array();
    array_push(
        $cmd,
        "-n",             # Don't show barcode text
        "-g", "200x60pt",
        "-e", $encoding,  # EAN | UPC | code39
        "-c",             # No checksum unless required
        "-b", $value,
        "-o", "$basename.eps"
    );
    $cmd = "barcode " . join(" ", array_map("escapeshellarg", $cmd));
    $lineout = system($cmd, $rv);
    if ($rv != 0) {
        error_log("$cmd -> '$lineout'");
        croak(500, 'Bummer');
    }

    # Convert to .png file
    $cmd = array();
    array_push(
        $cmd,
        "-density", "600",
        "$basename.eps",
        "-flatten",
        "-trim",
        "-black-threshold", "50%",
        "-white-threshold", "50%",
        "-monochrome",
        "$basename.png"
    );
    $cmd = "convert " . join(" ", array_map("escapeshellarg", $cmd));
    $lineout = system($cmd, $rv);
    if ($rv != 0) {
        error_log("$cmd -> '$lineout'");
        croak(500, 'Bummer');
    }

    unlink("$basename.eps");

    # Signal success by returning a key
    return $key;
}

function action_download($key) {
    global $barcode_cache_dir;

    if (preg_match('/[^a-zA-Z0-9]/', $key)) {
        croak(404, 'Invalid value');
    }

    $file = "$barcode_cache_dir/$key.png";
    if (is_file($file)) {
        header('Content-type: image/png');
        header('Content-disposition: attachment; filename="barcode.png"');
        readfile($file);
    } else {
        croak(404, 'Invalid value');
    }
}

MAIN();
?>
