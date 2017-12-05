          $(function() {
           $('#formsignup').submit(function(e){
            e.preventDefault();
            e.stopPropagation();

            var fname = $("#firstname").val();
            var lname = $("#lastname").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();

            

            if(password === confirmPassword){

                var url = "<?=site_url('signup');?>";
                  $.ajax({
                    url: url,
                    type: "POST",
                      data: 'firstname='+fname+'&lastname='+lname+'&email='+email+'&password='+password+'&confirmPassword='+confirmPassword,
                      dataType: "html",
                    success: function(data){
                      /*$('.signuperror').html(''); 
                      $('.signuperror').addClass('alert alert-success'); 
                      $('.signuperror').append(email);*/
                      alert(data);
                      return false;
                    }
                  });

            }else{
               $('.signuperror').html('<i class="alert alert-warning">Sorry! Password do not match.</i>')
               return false;
            }
           });
            $('#confirmPassword').keyup(function(){
                var p = $('#password').val();
                var cp = $('#confirmPassword').val();
                if(cp === ""){
                    $('#password').removeClass('red');
                    $('#confirmPassword').removeClass('red');
                }
                else if(p === cp){
                    $('#password').removeClass('red');
                    $('#confirmPassword').removeClass('red');
                }else{
                    $('#password').addClass('red');
                    $('#confirmPassword').addClass('red');

                }
            });

            $('#password').keyup(function(){
                var p = $('#password').val();
                var cp = $('#confirmPassword').val();
                if(p === ""){
                    $('#password').removeClass('red');
                    $('#confirmPassword').removeClass('red');
                    $('#confirmPassword').val('');
                }
            });

        });