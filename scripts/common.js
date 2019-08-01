
function ready(callback) {
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
        if (document.readyState=='complete') callback();
    });
}


function update_time(how, ele, serverOfffset, schedule) {
    if (ele) {
        let date;
        if (how === "server") {
            date = new Date(serverOfffset + Date.now());
        } else if (how === "client") {
            date = new Date(Date.now());
        } else {
            console.log("[update_time] Unknown update method: " + how);
            schedule = false;
        }

        if (date)      ele.textContent = date.toLocaleTimeString();
        if (schedule)  setInterval(update_time, 1000, how, ele, serverOfffset);
    }
}
