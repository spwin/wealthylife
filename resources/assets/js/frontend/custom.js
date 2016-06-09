// Main menu underline
(function() {

    var $el, leftPos, newWidth,
        $mainNav = $("#underline-hover");

    $mainNav.append("<li id='magic-line'></li>");
    var $magicLine = $("#magic-line");

    var current;
    if($('.current').length){
        current = $('.current');
    } else {
        current = $("#underline-hover li:first");
    }

    $magicLine
        .width(current.find('a').width())
        .css("left", current.position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());

    $("#underline-hover li").not('#magic-line').hover(function() {
        current.find('a').addClass('no-pseudo');
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

    $('.display-after-load').show();
    if(window.location.hash) {
        var hash = window.location.hash;
        $('ul.tabs li').removeClass('active');
        $(hash).addClass('active');
    }

})();

// Question clear
function clearForm(form_name, e, url, token, image){
    e.preventDefault();
    var form = $('.'+form_name);
    var chars = form.find('.charNum');
    $.ajax({
            method: "POST",
            url: url,
            data: {_token: token},
            dataType: 'JSON',
            success: function () {
                form.trigger( "reset" );
                form.find('input').not(':input[type=submit], :input[type=hidden]').val('');
                form.find('textarea').html('');
                form.find('.drop-zone').addClass('empty');
                form.find('.question-image img').attr('src', image);
                chars.css('color', '#666666');
                chars.html('250');
            }
        });
}

// Question clear
function clearImage(form_name, e, url, token, image){
    e.preventDefault();
    var form = $('.'+form_name);
    var chars = form.find('.charNum');
    $.ajax({
        method: "POST",
        url: url,
        data: {_token: token},
        dataType: 'JSON',
        success: function () {
            form.find('.drop-zone').addClass('empty');
            form.find('.question-image img').attr('src', image);
        }
    });
}

function countChar(val, e) {
    var limit = 250;
    var len = val.value.length;
    var chars = $('.charNum');
    if(e.keyCode == 13) {
        e.preventDefault();
    }
    if (len == limit) {
        chars.css('color', '#ce3838');
        e.preventDefault();
    } else if (len > limit) {
        // Maximum exceeded
        chars.css('color', '#ce3838');
        val.value = val.value.substring(0, limit);
    } else {
        chars.css('color', '#666');
    }
    if(len <= limit){
        chars.text(limit - len);
    }
}

function openModal(type){
    jQuery('.close-modal').click();
    if(type == 'login'){
        jQuery('.login-modal').find('.btn-modal').click();
    } else if(type == 'signup') {
        jQuery('.signup-modal').find('.btn-modal').click();
    }
    return false;
}

function readURL(defined, input, defaultUrl) {
    var img = $('.image-preview');
    var container = $('.drop-zone');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            container.removeClass('empty');
            img.attr('src', e.target.result);
            img.show();
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        if(!defined){
            img.hide();
            container.addClass('empty');
        }
        img.attr('src', defaultUrl);
    }
}

function uploadImage(elem){
    var form = $(elem).closest('form');
    form.find('.image-input').click();
}