jQuery(function ($) {
    $('.widget_wpnotepad').each(function (index, element) {
        var id = $('textarea', element).attr('id');
        
        var cookie = localStorage.getItem(id);

        $('#' + id).val(cookie);

        $('#' + id).on('change keyup', function () {
            localStorage.setItem(id, $(this).val());
        });
    });
});
