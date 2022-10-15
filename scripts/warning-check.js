$(document).ready(function() {

function showWarning() {
    var ifrm = document.createElement("iframe");
    ifrm.setAttribute("src", "../frames/warning.html");
    ifrm.addClass("side-frame");
    document.body.appendChild(ifrm);
}

if (Cookies.get('consent') === 'undefined'){
    showWarning();
}

});