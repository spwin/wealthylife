// Main menu underline
(function() {
    /* SLIDING MENU UNDERSCORE */
    /*
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
    */
})();
window.onload = function() {
    $('.display-after-load').show();
};
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

function clearArticleImage(form_name, e, image){
    e.preventDefault();
    var form = $('.'+form_name);
    var input = form.find('.image-input');
    input.replaceWith( input = input.clone(true) );
    form.find('.drop-article-zone').addClass('empty');
    form.find('.article-image img').attr('src', image);
}

function clearEditedImage(form_name, e, image){
    e.preventDefault();
    var form = $('.'+form_name);
    form.find('.cleared-image').val(1);
    form.find('.drop-zone').addClass('empty');
    form.find('.question-image img').attr('src', image);
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

function readArticleURL(defined, input, defaultUrl) {
    var img = $('.image-article-preview');
    var container = $('.drop-article-zone');
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

function uploadAvatar(elem){
    var form = $(elem).closest('form');
    form.find('.avatar-input').click();
}

var centerAvatar = function(){
    var div;
    return {
        init: function(className, imageId){
            div = $('.'+className);
            centerAvatar.setDimension($('.'+imageId));
        },
        setDimension: function(img){
            var theImage = new Image();
            theImage.src = img.attr("src");
            var width = theImage.width;
            var height = theImage.height;
            var avatar = div.find('.avatar-preview');
            if(width > height){
                avatar.css('max-height', div.height());
                avatar.css('max-width', 'none');
                avatar.css('left', (parseFloat($('.center-cropped').width())/2 - parseFloat(avatar.width()/2)) + 'px');
                avatar.css('top', '0px');
            } else {
                avatar.css('max-width', div.width());
                avatar.css('max-height', 'none');
                avatar.css('top', (parseFloat($('.center-cropped').height())/2 - parseFloat(avatar.height()/2)) + 'px');
                avatar.css('left', '0px');
            }
        }
    }
}();

var birthDate = function(){
    var months = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
    return {
        init: function (day, month, year) {
            birthDate.populateMonths($('select#month'), month);
            birthDate.populateYears($('select#year'), year);
            birthDate.populateDays($('select#day'), day);
        },
        populateDays: function(select, def){
            select.html($("<option />").val('00').text('Day'));
            for(var day=1; day <= 31; day++){
                select.append($("<option />").val(day < 10 ? '0'+day : day).text(day));
            }
            birthDate.setDefault(select, def);
        },
        populateMonths: function(select, def){
            select.html($("<option />").val('00').text('Month'));
            $.each(months, function(i){
                select.append($("<option />").val(i+1 < 10 ? '0'+(i+1) : i+1).text(months[i]));
            });
            birthDate.setDefault(select, def);
        },
        populateYears: function(select, def){
            var currentYear = (new Date).getFullYear();
            var maxDif = 110;
            select.html($("<option />").val('0000').text('Year'));
            for(var year = currentYear-1;  year > currentYear-maxDif; year--){
                select.append($("<option />").val(year).text(year));
            }
            birthDate.setDefault(select, def);
        },
        setDefault: function(select, def){
            if(def != '') {
                select.val(def);
            }
        }
    }
}();

function showPreloader(element){
    $('<div class="avatar-overlay"></div>').insertBefore(element);
    $(element).css('display', 'inline-block');
    console.log('teraz jest');
}

function hidePreloader(element){
    $('.avatar-overlay').remove();
    $(element).css('display', 'none');
    console.log('teraz niema');
}

function insertAvatar(input, defaultUrl){
    var img = $('.avatar-preview');
    showPreloader('.preloader-wrapper');
    var submit = $('.avatar-actions input');
    if (input.files && input.files[0]) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
        var reader = new FileReader();
        var extension = input.files[0].name.split('.').pop().toLowerCase(),
            isSuccess = fileTypes.indexOf(extension) > -1;
        if(isSuccess){
            reader.onload = function (e) {
                img.one("load", function() {
                    hidePreloader('.preloader-wrapper');
                }).attr("src", e.target.result);
                centerAvatar.init('center-cropped', 'avatar-preview');
                submit.removeClass('disabled');
                submit.prop('disabled', false);

            };
            reader.readAsDataURL(input.files[0]);
            $('.avatar-errors').html('');
            submit.addClass('disabled');
            submit.prop('disabled', true);
        } else {
            $('.avatar-errors').html('File extensions supported: jpg, png, gif');
            hidePreloader('.preloader-wrapper');
            submit.addClass('disabled');
            submit.prop('disabled', true);
        }
    } else {
        img.attr('src', defaultUrl);
        centerAvatar.init('center-cropped', 'avatar-preview');
        hidePreloader('.preloader-wrapper');
        $('.avatar-errors').html('');
        submit.addClass('disabled');
        submit.prop('disabled', true);
    }
}