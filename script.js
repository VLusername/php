$ = jQuery;
$( document ).ready(function() {
    var count = 0;
    $("input[type='button']").click(function() {
        switch (count) {
            case 0:
                $("input[id='b1']").css("top", 90);
                $("input[id='b2']").css("top", -30);
                $("input[id='b3']").css("top", -30);
                count++;
                break;
            case 1:
                $("input[id='b1']").css("top", 50);
                $("input[id='b2']").css("top", 50);
                $("input[id='b3']").css("top", -70);
                count++;
                break;
            case 2:
                $("input[id='b1']").css("top", 10);
                $("input[id='b2']").css("top", 10);
                $("input[id='b3']").css("top", 10);
                count = 0;
                break;
        }

    });
});
