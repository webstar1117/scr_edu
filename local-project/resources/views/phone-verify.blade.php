@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Email_Verify')
@endsection

@section('body')

<body>
    @endsection

    @section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Phone Number</h5>
                                        @if(Session::get('fail'))
                                        <div class="text-danger">
                                            {{Session::get('fail')}}
                                        </div>
                                        @endif
                                        <p>Re-Password with Skote.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="p-2">
                            <div>
                            {{Session::get('code')}}
                            </div>
                                <form class="form-horizontal" method="post" action="/reset-password/phone/confirm">
                                    {{csrf_field()}}
                                    <input type="text" class="form-control" name="phone_number" value="{{Session::get('phone_number')}}" hidden>
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control"  name="password" id="password" placeholder="Enter password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="verify_password">Verify Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control"  name="password_confirmation" id="verify_password" placeholder="Enter Verify Password" required>
                                        <p id="match_password" class="text-danger">Password is not matched!</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Verification Code</label>
                                        <input type="text" name="verify_number" class="form-control" placeholder="Enter verification code">
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Confirm</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Remember It ? <a href="auth-login" class="font-weight-medium text-primary"> Sign In here</a>
                        </p>
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection