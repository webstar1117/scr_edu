<!doctype html>
<htm>

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Skote - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" /> -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/assets/images/favicon.ico') }}">
    @include('layouts.head')
</head>

@section('body')

<body  data-layout="horizontal">
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        
        <!-- @include('layouts.hor-menu') -->

     
        <div class="main-content">
          
                    @yield('content')
             
            @include('layouts.footer')
        </div>
    


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->


    @include('layouts.footer-script')
</body>

</html>