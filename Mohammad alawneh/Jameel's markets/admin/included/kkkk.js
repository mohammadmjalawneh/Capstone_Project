        $("document").ready(function(){
            $('#email').keyup(function(){
                $.ajax({
                    type:"GET",
                    url:'http://apilayer.net/api/check?access_key=79de445feb4e04632b42b1ce5321a73b&email='+$('#email').val()+'&smtp=1&format=1',
                    success: function(data){
                        var J=JSON.stringify(data);
                        var d=JSON.parse(J);
                        if (d['format_valid']==true) {
                            $('#email').css('background-color', '#19e620');     
                        }else
                        {
                            $('#email').css('background-color', 'pink');
                        }
                    }
                });
            });
        });
