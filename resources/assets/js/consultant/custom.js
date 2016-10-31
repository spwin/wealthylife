var questionNotification = function(){
    var pending;
    var url;
    var token;
    var interval = 10000; //10 sec
    var audio;
    var soundButton = $('#notification-sound');
    return {
        init: function(p, u, t, a){
            url = u;
            token = t;
            pending = p;
            audio = new Audio(a);
            questionNotification.bind();
            setInterval(function(){
                questionNotification.callAjax();
            }, interval);
        },
        callAjax: function(){
            $.ajax({
                method: "POST",
                url: url,
                data: {_token: token},
                dataType: 'JSON',
                success: function (data) {
                    if(data.pending > pending){
                        $('body').prepend('<div class="ajax-notification"><div class="new-messages">'+(data.pending - pending)+' new question</div><div class="pending-message">Pending ('+(data.pending)+')</div></div>');
                        setTimeout(function(){
                            $('.ajax-notification').fadeOut(300, function() { $(this).remove(); });
                        },2000);
                        soundButton.click();
                        pending = data.pending;
                    }
                }
            });
        },
        bind: function(){
            soundButton.on('click', function(e){
                e.preventDefault();
                audio.play();
            });
        }
    }
}();