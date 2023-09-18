<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body>
{{--<div class="wavy-wraper">--}}
{{--    <div class="wavy">--}}
{{--        <span style="--i:1;">p</span>--}}
{{--        <span style="--i:2;">i</span>--}}
{{--        <span style="--i:3;">t</span>--}}
{{--        <span style="--i:4;">n</span>--}}
{{--        <span style="--i:5;">i</span>--}}
{{--        <span style="--i:6;">k</span>--}}
{{--        <span style="--i:7;">.</span>--}}
{{--        <span style="--i:8;">.</span>--}}
{{--        <span style="--i:9;">.</span>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="theme-layout">

    <div class="postoverlay"></div>

    <div class="topbar stick">
        <div class="logo">
            <a title="" href="newsfeed.html"><img src="images/logo.png" alt=""></a>
        </div>
        <div class="top-area">
            <div class="main-menu">
				<span>
			    	<i class="fa fa-braille"></i>
			    </span>
            </div>
            <div class="top-search">
                <form method="post" class="">
                    <input type="text" placeholder="Search People, Pages, Groups etc">
                    <button data-ripple><i class="ti-search"></i></button>
                </form>
            </div>
            <div class="page-name">
                <span>{{$title}}</span>
            </div>
            <ul class="setting-area">
                <li><a href="newsfeed.html" title="Home" data-ripple=""><i class="fa fa-home"></i></a></li>
                <li><a href="#" title="Help" data-ripple=""><i class="fa fa-question-circle"></i></a>
                    <div class="dropdowns helps">
                        <span>Quick Help</span>
                        <form method="post">
                            <input type="text" placeholder="How can we help you?">
                        </form>
                        <span>Help with this page</span>
                        <ul class="help-drop">
                            <li><a href="forum.html" title=""><i class="fa fa-book"></i>Community & Forum</a></li>
                            <li><a href="faq.html" title=""><i class="fa fa-question-circle-o"></i>FAQs</a></li>
                            <li><a href="career.html" title=""><i class="fa fa-building-o"></i>Carrers</a></li>
                            <li><a href="privacy.html" title=""><i class="fa fa-pencil-square-o"></i>Terms & Policy</a>
                            </li>
                            <li><a href="#" title=""><i class="fa fa-map-marker"></i>Contact</a></li>
                            <li><a href="#" title=""><i class="fa fa-exclamation-triangle"></i>Report a Problem</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="user-img">
                <h5>Jack Carter</h5>
                <img src="images/resources/admin.jpg" alt="">
                <span class="status f-online"></span>
                <div class="user-setting">
                    <span class="seting-title">Chat setting <a href="#" title="">see all</a></span>
                    <ul class="chat-setting">
                        <li><a href="#" title=""><span class="status f-online"></span>online</a></li>
                        <li><a href="#" title=""><span class="status f-away"></span>away</a></li>
                        <li><a href="#" title=""><span class="status f-off"></span>offline</a></li>
                    </ul>
                    <span class="seting-title">User setting <a href="#" title="">see all</a></span>
                    <ul class="log-out">
                        <li><a href="about.html" title=""><i class="ti-user"></i> view profile</a></li>
                        <li><a href="setting.html" title=""><i class="ti-pencil-alt"></i>edit profile</a></li>
                        <li><a href="#" title=""><i class="ti-target"></i>activity log</a></li>
                        <li><a href="setting.html" title=""><i class="ti-settings"></i>account setting</a></li>
                        <li><a href="logout.html" title=""><i class="ti-power-off"></i>log out</a></li>
                    </ul>
                </div>
            </div>
            <span class="ti-settings main-menu" data-ripple=""></span>
        </div>
        @include('layouts.menu')
    </div><!-- topbar -->

    @yield('content')

</div>
@include('layouts.script')
@stack('scripts')

</body>

</html>
