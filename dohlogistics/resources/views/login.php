<style>
    *
    {
        box-sizing: border-box;
    }
    body
    {
        background-image: linear-gradient(to right, #134E5E, #71B280);
        /*background-image: url("/includes/images/homeback1.jpg");*/
    }
    .login-container
    {
        width: 25vw;
        margin-right: auto;
        margin-left: auto;
        margin-top: 15vh;
    }

    .login-container input
    {
        color: white !important;
        text-align: center;
        background: #9fa8b2;
        font-size: 15px;
        margin-top: 15px;
        /*border: 0;*/
        border-radius: 20px 20px 20px 20px !important;
        /*border-bottom: 2px solid white;*/
        z-index: 999999;
    }
    .login-container input::placeholder
    {
        color: white;
        letter-spacing: 10px;
        text-align: center;
    }
    .login-container input:focus
    {
        background: #9fa8b2;
    }
    #login
    {
        opacity: 0.8;
        background-color: mediumseagreen;
        color: dimgray;
        font-size: 15px;
        letter-spacing: 5px;
    }
    #login:hover
    {
        opacity: 1;
        color: white;
    }
</style>
<div class="container">
   <div class="login-container">
       <div class="login-title h2 text-light text-center">
           <div><img src="/includes/images/dohlogo.png" alt="" style="width: 150px; height: 90px;padding-bottom:5px"></div>
           <span class="font-weight-bold text-success">LOGI</span><span class="font-weight-bold text-dasrk">STICS</span>
       </div>
       <div class="form-group">
<!--           <label>Username</label>-->
           <input type="text" class="form-control" placeholder="Username" id="username">
       </div>
       <div class="form-group">
<!--           <label>Password</label>-->
           <input type="password" class="form-control" placeholder="Password" id="password">
       </div>
       <button class="btn form-control mt-2 shadow" id="login">Login</button>
   </div>
</div>
<script>
    $(document).ready(function () {
        login();

        function login()
        {
            $('#login').click(function () {
                initLogin();
            });
            $(document).on('keypress',function(e) {
                if(e.which == 13) {
                    initLogin();
                }
            });

            function initLogin()
            {
                var username = $('#username').val();
                var password = $('#password').val();

                if(username == '' && password == '')
                    Swal.fire({
                        icon: 'error',
                        title: 'Hey, We have a problem here!',
                        text: 'You have Incomplete Credentials.',
                    });
                else if(username == '')
                    Swal.fire({
                        icon: 'error',
                        title: 'Come on?!',
                        text: 'Username is required.',
                    });
                else if(password == '')
                    Swal.fire({
                        icon: 'error',
                        title: 'Seriously?!',
                        text: 'Password is required.',
                    });
                else
                    $.ajax(
                        {
                            url: '/login',
                            method: 'post',
                            data: {
                                username: username,
                                password: password
                            },
                            statusCode: {
                                404: function (data) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Sorry but',
                                        text: data.responseJSON,
                                    });
                                },
                                401: function (data) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Sorry but',
                                        text: data.responseJSON,
                                    });
                                },
                                200: function (data) {
                                    console.log(data);
                                    switch (data)
                                    {
                                        case 'officer':
                                            window.location.href = '/officer';
                                            break;
                                        case 'admin':
                                            window.location.href = '/dashboard';
                                            break;
                                    }
                                }
                            }
                        }
                    );
            }
        }

    });
</script>
