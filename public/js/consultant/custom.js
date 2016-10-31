var questionNotification = function(){
    var pending;
    var url;
    var token;
    var interval = 30000; //30 sec
    var audio;
    return {
        init: function(p, u, t, a){
            url = u;
            token = t;
            pending = p;
            audio = new Audio(a);
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
                        audio.play();
                        pending = data.pending;
                    }
                }
            });
        }
    }
}();