@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Recover_Password')
@endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />


@section('body')

<body>
    @endsection

    @section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="{{url('auth-login')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
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
                                        <h5 class="text-primary"> Reset Password</h5>
                                        @if(Session::get('fail'))
                                        <div class="text-danger">
                                            {{Session::get('fail')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="p-2">
                                <form class="form-horizontal" method="post" action="/reset-password/email">
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label for="useremail">Email</label>
                                        <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email">
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-12 text-right">
                                            <button style="color:white!important" class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Remember It ? <a href="{{url('auth-login')}}" class="font-weight-medium text-primary"> Sign In here</a>
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