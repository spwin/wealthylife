// Main menu underline
window.onload = function() {

    var $el, leftPos, newWidth,
        $mainNav = $("#underline-hover");

    $mainNav.append("<li id='magic-line'></li>");
    var $magicLine = $("#magic-line");

    $magicLine
        .width($(".current").find('a').width())
        .css("left", $(".current").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());

    $("#underline-hover li").not('#magic-line').hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.find('a').width();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });
    });
};