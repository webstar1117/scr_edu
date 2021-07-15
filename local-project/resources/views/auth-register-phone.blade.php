@extends('layouts.master-layouts')

@section('title')
login
@endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />

<style>
    body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #B0BEC5;
        background-repeat: no-repeat
    }

    .card0 {
        box-shadow: 0px 4px 8px 0px #757575;
        border-radius: 0px
    }

    .card2 {
        margin: 0px 40px
    }

    .logo {
        width: 200px;
        height: 100px;
        margin-top: 20px;
        margin-left: 35px
    }

    .image {
        width: 360px;
        height: 280px
    }

    .border-line {
        border-right: 1px solid #EEEEEE
    }

    .facebook {
        background-color: #3b5998;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer
    }

    .twitter {
        background-color: #1DA1F2;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer
    }

    .linkedin {
        background-color: #2867B2;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer
    }

    .line {
        height: 1px;
        width: 45%;
        background-color: #E0E0E0;
        margin-top: 10px
    }

    .or {
        width: 10%;
        font-weight: bold
    }

    .text-sm {
        font-size: 14px !important
    }

    ::placeholder {
        color: #BDBDBD;
        opacity: 1;
        font-weight: 300
    }

    :-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    ::-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    input,
    textarea {
        padding: 10px 12px 10px 12px;
        border: 1px solid lightgrey;
        border-radius: 2px;
        margin-bottom: 5px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        font-size: 14px;
        letter-spacing: 1px
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #304FFE;
        outline-width: 0
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    a {
        color: inherit;
        cursor: pointer
    }

    .btn-blue {
        background-color: #1A237E;
        width: 150px;
        color: #fff;
        border-radius: 2px
    }

    .btn-blue:hover {
        background-color: #000;
        cursor: pointer
    }

    .bg-blue {
        color: #fff;
        background-color: #1A237E
    }

    @media screen and (max-width: 991px) {
        .logo {
            margin-left: 0px
        }

        .image {
            width: 300px;
            height: 220px
        }

        .border-line {
            border-right: none
        }

        .card2 {
            border-top: 1px solid #EEEEEE !important;
            margin: 0px 15px
        }
    }
</style>
@section('body')

@endsection
@section('content')

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h6 class="mb-0 mr-4 mt-2">Sign up with</h6>
                        <div class="facebook text-center mr-3">
                            <div class="fa fa-facebook"></div>
                        </div>
                        <div class="twitter text-center mr-3">
                            <div class="fa fa-twitter"></div>
                        </div>
                        <div class="linkedin text-center mr-3">
                            <div class="fa fa-linkedin"></div>
                        </div>
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center">Or</small>
                        <div class="line"></div>
                    </div>
                    <form class="form-horizontal" id="register_form" method='post' action="{{url('auth-register')}}">
                        {{ csrf_field() }}
                        <div class="row px-3">
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Phone Number</h6>
                            </label> <input class="mb-4" type="text" id="phone_number" name="phone_number" placeholder="Enter phone number">
                            <span id="verified" style="display:none;color:green;">Verified Successfully !</span>
                        </div>
                        <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                            </label> <input id="password" type="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="row mt-3 px-3 mb-4">
                            <div class="row px-3"> <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Confirm Password</h6>
                                </label> <input id="verify_password" type="password" name="password_confirmation" placeholder="Confirm password">
                            </div>
                            <p id="match_password" class="text-danger">Password is not matched!</p>

                        </div>
                        <div class="row px-3"> <label class="mb-1">
                                <button type="button" onclick="Register()" class="btn btn-blue text-center">Register</button>
                                <a href="{{url('auth-register')}}" class="ml-auto mb-0 text-sm">Register with email</a>
                        </div>
                        <div class="text-center mt-3"> <label class="mb-1">
                                <small class="font-weight-bold">Already have an account ? <a class="text-danger" href="{{url('auth-login')}}">Login</a></small>

                        </div>
                    </form>

                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="verifyModal" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enter OTP</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="resend_msg" style="text-align:center;color:green;"></p>
                    <p id="error_msg" style="text-align:center;color:green;"></p>
                    <div class="text-center">
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="text" id="otp" name="otp" placeholder="OTP">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="btn btn-primary" id="otp_submit">
                                Submit
                            </button>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="btn btn-info" id="otp_resend">
                                Resend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->


            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(document).ready(function() {
            console.log(location.search)
            if (location.search) {
                var referrer_id = location.search.split('=')[1];
                $('#referrer').val(referrer_id);
            }
            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $("#match_password").hide();
            $('#password').keyup(function() {
                MatchPassword();
            })
            $('#verify_password').keyup(function() {
                MatchPassword();
            })

            $("#otp_submit").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/auth-register/verify-number",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        otp: $('#otp').val(),
                        verify_number: window.localStorage.getItem('key')

                    },
                    success: function(dataResult) {
                        if (dataResult == 'success') {
                            $("#verifyModal").modal('hide');
                            $("#verified").show();
                            $('#register_form').submit();
                        } else if (dataResult == 'fail') {
                            $("#error_msg").html('Invalid OTP !');
                        }

                    }
                });
            });
            $("#otp_resend").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/auth-register/resend-number",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        phone_number: $('#phone_number').val(),
                    },
                    success: function(dataResult) {
                        if (dataResult == 'success') {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.status == 'fail') {
                                displayValidationError(dataResult.data)
                            } else {
                                $("#resend_msg").html('OTP Resend Successfully !');
                                window.localStorage.removeItem('key');
                                window.localStorage.setItem('key', dataResult);
                            }

                        }
                    }
                });
            });
        })

        function MatchPassword() {
            if ($('#password').val() != $('#verify_password').val()) {
                $("#match_password").show();
            } else {
                $("#match_password").hide();
            }
        }

        function Register() {
            password = $('#password').val();
            verify_password = $('#verify_password').val();
            if (password == '') {
                alert('Input password!');
                return;
            }

            if (password != verify_password) {
                $("#match_password").show();
                return;
            }
            console.log('sdf')
            $.ajax({
                type: "POST",
                url: "/auth-register/email/send-number",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: $('#email').val(),
                },
                success: function(dataResult) {

                    var dataResult = JSON.parse(dataResult);

                    if (dataResult.status == 'fail') {
                        displayValidationError(dataResult.data)
                    } else {
                        alert('Sent verification code successfully!');
                        $("#verifyModal").modal('show');
                        window.localStorage.setItem('key', dataResult);
                    }
                }
            });

        }

        function displayValidationError(dataResult) {
            console.log('dataResult.data');
            console.log(dataResult);
            if (dataResult) {
                if (dataResult.email && dataResult.email.length > 0) {
                    dataResult.email.forEach(item => {
                        $('#error_div').append(`<label class="error">${item}</label>`)
                    })
                }
            }
        }
    </script>
    @endsection