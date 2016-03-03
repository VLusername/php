$ = jQuery;
$( document ).ready(function() {
    var count = 0;

    /*
    селектори використав, але все одно прив'язано до кількості елементів...
    тому що в завданні вказано конкрений порядок при натисканні.
     */
    $("#buttons input[type='button']").click(function() {
        switch (count) {
            case 0:
                $("#buttons input:first-child").css("top", 90);
                $("#buttons input:first-child").next().next().css("top", -30);
                $("#buttons input:last-child").css("top", -30);
                count++;
                break;
            case 1:
                $("#buttons input:first-child").css("top", 50);
                $("#buttons input:first-child").next().next().css("top", 50);
                $("#buttons input:last-child").css("top", -70);
                count++;
                break;
            case 2:
                $("#buttons input:first-child").css("top", 10);
                $("#buttons input:first-child").next().next().css("top", 10);
                $("#buttons input:last-child").css("top", 10);
                count = 0;
                break;
        }
    });
});
