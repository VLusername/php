$ = jQuery;
$(document).ready(function() {
    $("#buttons input[type='button']").click(function() {
        $("#buttons input[type='button']").each(function() {
            $(this).parent('div').insertBefore($(this).parent('div').prev());
        });
    });
});
