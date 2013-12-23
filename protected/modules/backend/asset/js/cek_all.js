function checkall(el) {
    var ip = document.getElementsByTagName('input'), i = ip.length - 1;
    for (i; i > -1; --i) {
        if (ip[i].type && ip[i].type.toLowerCase() === 'checkbox') {
            ip[i].checked = el.checked;
        }
    }
}