
function selectOptionsRemove(selectElement) {
    var i, L = selectElement.options.length - 1;
    for (i = L; i >= 1; i--) {
        selectElement.remove(i);
    }
}

function openWindow(url) {
    //alert(url);
    var myWindow = window.open(url, "_blank", "scrollbars=yes,width=1000,height=1000,top=1");
    // focus on the popup //
    myWindow.focus();
}

function divShowHide(id, action) {
    if (action == 'hide')
        $('#' + id).hide('slow');
    else if (action == 'show')
        $('#' + id).show('slow');
    else
        alert('erroAction: ' + action);
}

function submitReport(formId) {
    document.getElementById(formId).submit();
}

//alert('endFile');
