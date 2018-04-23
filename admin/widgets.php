<?php

function btn_gen_barcode($input = 'input[name=barcode]', $label = 'New') {
    global $barcode_length;
    global $barcode_type;

    if (has_value($barcode_type)) {
        return <<<WIDGET
<button type="button" onclick="gen_barcode('$input', '$barcode_type', $barcode_length); return true;">$label</button>
WIDGET;
    } else {
        return "";
    }
}

function btn_render_barcode($input = 'input[name=barcode]', $label = 'PNG') {
    global $barcode_rendering;
    global $barcode_type;

    $_DUMMY_WHEEL = '<img src="../images/icons/loading_wheel.gif" class="invisible" />';
    $_LOADING_WHEEL = '<img src="../images/icons/loading_wheel.gif" class="loading invisible" />';
    if (yes_no_bool($barcode_rendering)) {
        return <<<WIDGET
<button type="button" onclick="print_barcode('$input', '$barcode_type'); return true;">$_DUMMY_WHEEL $label $_LOADING_WHEEL</button>
WIDGET;
    } else {
        return "";
    }
}

?>
