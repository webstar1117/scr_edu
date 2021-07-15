        <!-- JAVASCRIPT -->
        <script src="{{ URL::asset('/assets/libs/news/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('/assets/libs/news/browser.min.js')}}"></script>
        <script src="{{ URL::asset('/assets/libs/news/breakpoints.min.js')}}"></script>
        <script src="{{ URL::asset('/assets/libs/news/util.js')}}"></script>
        <script src="{{ URL::asset('/assets/libs/news/main.js')}}"></script>


        @yield('script')

        <!-- App js -->
        <!-- <script src="{{ URL::asset('/assets/js/app.min.js')}}"></script> -->
        
        @yield('script-bottom')