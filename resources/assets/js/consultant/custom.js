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
                        },7000);
                        audio.play();
                        pending = data.pending;
                    }
                }
            });
        }
    }
}();

var saveAnswerTimer = function(){
    var time;
    var exactTime;
    var url;
    var token;
    var interval = 20000;
    var container;
    var form;
    return {
        init: function(f, c, u, t, k){
            container = c;
            url = u;
            form = f;
            time = exactTime = t;
            token = k;
            $(container).timer({
                seconds: time
            });
            saveAnswerTimer.bind();
            setInterval(function(){
                exactTime++;
            }, 1000);
            setInterval(function(){
                saveAnswerTimer.callAjax();
            }, interval);
        },
        callAjax: function(){
            time += (interval/1000);
            var answer = CKEDITOR.instances['answer'].getData();
            $.ajax({
                method: "POST",
                url: url,
                data: {_token: token, time: time, answer: answer},
                dataType: 'JSON',
                success: function (data) {
                    $('#saved-msg').html('Saved at ' + data.date);
                }
            });
        },
        bind: function(){
            $(form).on('submit', function(){
                $('input#timer').val(exactTime);
            });
        }
    }
}();