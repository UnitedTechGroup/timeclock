
function nonce(alphabet, length) {
    var n = "";
    for (var i = 0; i < length; i++) {
        n += alphabet.charAt(Math.floor(Math.random() * alphabet.length));
    }
    return n;
}

function gen_barcode(target, style, length) {
    var code = "";

    if (style === "code39") {
        code = nonce("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", length);
    }

    $(target).val(code);
}

function loading_on(ele) {
    $(ele).closest("tr").find(".loading").removeClass("invisible");
}
function loading_off(ele) {
    $(ele).closest("tr").find(".loading").addClass("invisible");
}

var dl_form_id = nonce("abcdefghijklmnopqrstuvwxyz", 15);
function on_render(data, source) {
    if (!data || !data.ok || !data.key) {
        loading_off(source);
        return;
    }

    dl_form = $("#" + dl_form_id);
    if (!dl_form.length) {
        $('body').append("<form style=\"display: hidden\" action=\"barcode.php\" method=\"POST\" id=\"" + dl_form_id + "\">"
                         + "<input type=\"hidden\" name=\"action\"/>"
                         + "<input type=\"hidden\" name=\"download\"/>"
                         + "<input type=\"hidden\" name=\"csrf-token\"/>"
                         + "</form>");
        dl_form = $("#" + dl_form_id);
    }

    if (!dl_form.length) {
        loading_off(source);
        return;
    }

    dl_form.find('input[name="action"]').val("download");
    dl_form.find('input[name="download"]').val(data.key);
    dl_form.find('input[name="csrf-token"]').val(getCookie("csrf-token"));
    dl_form.submit();
    loading_off(source);
}

function print_barcode(source, style) {
    loading_on(source);
    $.get("barcode.php", { "action": "render", "type": style, "render": $(source).val(), "csrf-token": getCookie("csrf-token") }, function (data) { on_render(data, source); });
}
