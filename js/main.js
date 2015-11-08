$(document).ready(function(){
    $("#url-form").ajaxForm({
        target: '#col-result',
        beforeSend: function() {
            $('#col-result').css('min-height','0px');
            $("#col-result").empty();
            $('#inner_pb').width('0%');
            $('#progress_result').show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            if( $(window).width() < 768 ) {
                /* Extra small devices (phones, less than 768px) */
                $('html, body').animate({
                        scrollTop: $("#col-result").offset().top
                    }, 500);
            }
            var percentVal = (percentComplete - 1) + '%';
            $('#inner_pb').width(percentVal).text('Processing... ' + percentVal);
        },
        success: function(){
            $('#inner_pb').width('100%').text('Processing... 100%');
            $('#url-form')[0].reset();
            $('#progress_result').fadeOut(500);
            $('#col-result').css('min-height','300px');
        },
        error: function(e){
            alert("Status:="+textStatus + " Error:="+errorThrown);
        }
    });
});

$(document).ready(function(){
    $("#upload-form").ajaxForm({
        target: '#col-result',
        beforeSend: function() {
            $('#col-result').css('min-height','0px');
            $("#col-result").empty();
            $('#inner_pb').width('0%');
            $('#progress_result').show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            if( $(window).width() < 768 ) {
                /* Extra small devices (phones, less than 768px) */
                $('html, body').animate({
                        scrollTop: $("#col-result").offset().top
                    }, 500);
            }
            var percentVal = (percentComplete - 1) + '%';
            $('#inner_pb').width(percentVal).text('Processing... ' + percentVal);
        },
        success: function(){
            $('#inner_pb').width('100%').text('Processing... 100%');
            $('#upload-form')[0].reset();
            $('#progress_result').fadeOut(500);
            $('#col-result').css('min-height','300px');
        },
        error: function(e){
            alert("Status:="+textStatus + " Error:="+errorThrown);
        }
    });
});

$(document).ready(function(){
    $("#sample-form").ajaxForm({
        target: '#col-result',
        beforeSend: function() {
            $('#col-result').css('min-height','0px');
            $("#col-result").empty();
            $('#inner_pb').width('0%');
            $('#progress_result').show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            if( $(window).width() < 768 ) {
                /* Extra small devices (phones, less than 768px) */
                $('html, body').animate({
                        scrollTop: $("#col-result").offset().top
                    }, 500);
            }
            var percentVal = (percentComplete - 1) + '%';
            $('#inner_pb').width(percentVal).text('Processing... ' + percentVal);
        },
        success: function(){
            $('#inner_pb').width('100%').text('Processing... 100%');
            $('#sample-form')[0].reset();
            $('#progress_result').fadeOut(500);
            $('#col-result').css('min-height','300px');
        },
        error: function(e){
            alert("Status:="+textStatus + " Error:="+errorThrown);
        }
    });
});