<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-image: url({{asset('authregister/images/baraa.jpg')}});
            
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('authregister/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('authregister/css/style.css')}}">
    
      <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form id="create-form" >
                        <h2 class="form-title">Create account User</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        {{-- <div class="form-group">
                            <label for="mobile">{{__('cms.mobile')}}</label>
                            <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}">
                        </div> --}}
                        <div class="form-group">
                            <input type="text" class="form-input" id="mobile" name="mobile" placeholder="phone number"/>
                        </div>
                        {{-- <div class="form-group">
                            <select class="form-control" id="gender">
                                <option value="Female" >female</option>
                                <option value="Male">male</option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label>gender</label>
                            <select class="form-input" id="gender">
                                <option value="Female" >female</option>
                                <option value="Male">male</option>
                            </select>
                        </div>

                    
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>

                        {{-- <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary">Sign up</button>
                        </div> --}}



                        <div class="form-group">
                            <button type="button" onclick="performStore()" id="submit" class="form-submit" >Sign up</button>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="{{route('cms.login','user')}}" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('authregister/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('authregister/js/main.js')}}"></script>
    <script>
        function performStore() {
         
            axios.post('/front/users', {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                mobile: document.getElementById('mobile').value,
                gender: document.getElementById('gender').value,
                password: document.getElementById('password').value,
                // role_id: document.getElementById('role_id').value,
            })
            .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById('create-form').reset();
            })
            .catch(function (error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>