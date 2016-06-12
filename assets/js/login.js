    $('#login_result').hide();
    $('#form_login').submit(function(e) {
        e.preventDefault();
        formData = new FormData($(this)[0]);
        $.ajax({
            url: root+'index.php/login/ajax/submit',
                type: 'POST',
                data: formData,
                async:false,
                cache:false,
                processData: false,
                contentType: false,
                success:function (data) {
                    console.log(data.stat);
                    $('#login_result').empty();
                    if ( data.stat == true ) {
                        $('#login_result').show();
                        $('#login_result').addClass('bg-green');
                        $('#login_result').html(data.text);
                        setTimeout(  function(){ 
                            window.location = root+"index.php/home";
                        }, 3000); 
                    }else{
                        $('#login_result').show();
                        $('#login_result').addClass('bg-red');
                        $('#login_result').html(data.text);
                    }
                }
        });
        return false;
    });