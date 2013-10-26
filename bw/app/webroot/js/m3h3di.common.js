// Kendo dialogs
function createWindow(dialog, title, html, width, height) {
    $(document.body).append('<div id="' + dialog + '"></div>');
    $('#' + dialog).kendoWindow({
        title: title,
        modal: true,
        resizable: false,
        width: width,
        height: height
    }).data('kendoWindow').content(html).center().open();
}

function closeWindow(dialog) {
    $("#" + dialog).data('kendoWindow').close();
}

// Kendo AJAX grid
function error_handler(e) {
    if (e.errors) {
        var message = "Errors:\n";
        $.each(e.errors, function (key, value) {
            if ('errors' in value) {
                $.each(value.errors, function () {
                    message += this + "\n";
                });
            }
        });
        alert(message);
    }
}

function filterCodes() {
    return {
        IsicCategory: $("#IsicCategory").val()
    };
}

function submitForm(e) {

    $("form").submit();
    //e.sender.element.submit();
}