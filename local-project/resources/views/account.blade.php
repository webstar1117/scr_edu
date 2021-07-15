@extends('layouts.master-layouts')

@section('title')
@lang('translation.Preloader')
@endsection

@section('css')

<style>
    h2 {
        background-color: #3575D3;
        color: #fff!important;
        width: 100%;
        padding: 15px !important;
    }

    #sidebar,
    #search {
        background: #fff !important;
    }
</style>
@endsection


@section('content')

<div id="wrapper">

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <!-- Header -->
            <header id="header">
                <a href="home.php" class="logo" data-nsfw-filter-status="swf"><strong>Homepage</strong></a>
            </header>

            <!-- Banner -->
            <section id="banner">
                <div class="content">
                    <header>
                        <h1>Hi, Welcome<br>
                            to Sanlam</h1>
                        <p data-nsfw-filter-status="swf">A free and fully responsive site template</p>
                    </header>
                    <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>
                    <ul class="actions">
                        <li><a href="#" class="button big" data-nsfw-filter-status="swf">Learn More</a></li>
                    </ul>
                </div>
                <span class="image object" data-nsfw-filter-status="swf">
                    <img src="{{asset('assets/images/pic10.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;">
                </span>
            </section>

            <!-- Section -->
            <section>
                <header class="major">
                    <h2>Erat lacinia</h2>
                </header>
                <div class="features">
                    <article>
                        <span class="icon fa-gem" data-nsfw-filter-status="swf"></span>
                        <div class="content">
                            <h3>Portitor ullamcorper</h3>
                            <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        </div>
                    </article>
                    <article>
                        <span class="icon solid fa-paper-plane" data-nsfw-filter-status="swf"></span>
                        <div class="content">
                            <h3>Sapien veroeros</h3>
                            <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        </div>
                    </article>
                    <article>
                        <span class="icon solid fa-rocket" data-nsfw-filter-status="swf"></span>
                        <div class="content">
                            <h3>Quam lorem ipsum</h3>
                            <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        </div>
                    </article>
                    <article>
                        <span class="icon solid fa-signal" data-nsfw-filter-status="swf"></span>
                        <div class="content">
                            <h3>Sed magna finibus</h3>
                            <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Section -->
            <section>
                <header class="major">
                    <h2>Ipsum sed dolor</h2>
                </header>
                <div class="posts">
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic01.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Interdum aenean</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic02.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Nulla amet dolore</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic03.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Tempus ullamcorper</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic04.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Sed etiam facilis</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic05.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Feugiat lorem aenean</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="#" class="image" data-nsfw-filter-status="swf"><img src="{{asset('assets/images/pic06.jpg')}}" alt="" data-nsfw-filter-status="sfw" style="visibility: visible;"></a>
                        <h3>Amet varius aliquam</h3>
                        <p data-nsfw-filter-status="swf">Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        <ul class="actions">
                            <li><a href="#" class="button" data-nsfw-filter-status="swf">More</a></li>
                        </ul>
                    </article>
                </div>
            </section>

        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner" >

            <!-- Search -->
            <section id="search" class="alt">
                <img src="{{asset('assets/cpreg/content/assets/img/footerLogo.png')}}" alt="Sanlam" data-nsfw-filter-status="sfw" style="visibility: visible;">
            </section>

            <!-- Menu -->
            <nav id="menu">
                <header class="major">
                    <h2 class="alt">Navigation</h2>
                </header>
                <ul>
                    <li><a href="{{url('account')}}" data-nsfw-filter-status="swf">Homepage</a></li>
                    <li><a href="{{url('scr-edu')}}" data-nsfw-filter-status="swf">SCR edu</a></li>
                    <li><a href="{{url('scr-super')}}" data-nsfw-filter-status="swf">SCR super</a></li>
                    <li>
                        <a href="javascript:void();" data-nsfw-filter-status="swf"
                         id="topnav-layout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle "></i>LOGOUT
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>

            <!-- Section -->
            <section>
                <header class="major">
                    <h2>Get in touch</h2>
                </header>
                <p data-nsfw-filter-status="swf">Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                <ul class="contact">
                    <li class="icon solid fa-envelope"><a href="#" data-nsfw-filter-status="swf">information@untitled.tld</a></li>
                    <li class="icon solid fa-phone">(000) 000-0000</li>
                    <li class="icon solid fa-home">1234 Somewhere Road #8254<br>
                        Nashville, TN 00000-0000</li>
                </ul>
            </section>

            <!-- Footer -->
            <footer id="footer">
                <p class="copyright" data-nsfw-filter-status="swf">© Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com" data-nsfw-filter-status="swf">Unsplash</a>. Design: <a href="https://html5up.net" data-nsfw-filter-status="swf">HTML5 UP</a>.</p>
            </footer>

        </div>
        <a href="#sidebar" class="toggle" data-nsfw-filter-status="swf">Toggle</a>
    </div>

</div>




@endsection

@section('script')

@endsection