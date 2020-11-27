<!DOCTYPE HTML>
<html>

<head>
    <title>@lang('app.title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel='stylesheet'
        type='text/css' />
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href='{{ asset('bower_components/lato-font/css/lato-font.min.css') }}'>
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href=""><img src="{{ asset('images/logo.png') }}" alt="" /></a>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="">@lang('app.listjobs')</a></li>
                    <li><a href="">@lang('app.login')</a></li>
                    <li><a href="">@lang('app.register')</a></li>
                    <li><a href="">@lang('app.profile-user')</a></li>
                    <li><a href="">@lang('app.profile-company')</a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </nav>
    @yield('content')
    <div class="footer">
        <div class="container">
            <div class="col-md-3 grid_3">
                <h4>@lang('app.navigate')</h4>
                <ul class="f_list f_list1">
                    <li><a href="">@lang('app.home')</a></li>
                    <li><a href="">@lang('app.signin')</a></li>
                    <li><a href="">@lang('app.joinnow')</a></li>
                    <li><a href="">@lang('app.about')</a></li>
                </ul>
                <ul class="f_list">
                    <li><a href="">@lang('app.feature')</a></li>
                    <li><a href="">@lang('app.terms')</a></li>
                    <li><a href="">@lang('app.contact')</a></li>
                    <li><a href="">@lang('app.post')</a></li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 grid_3">
                <h4>@lang('app.twitters')</h4>
                <div class="footer-list">
                    <ul>
                        <li><i class="fa fa-twitter tw1"> </i>
                            <p><span class="yellow"><a
                                        href="">@lang('app.consectetuer')</a></span>@lang('app.adipiscing')</p>
                        </li>
                        <li><i class="fa fa-twitter tw1"> </i>
                            <p><span class="yellow"><a
                                        href="">@lang('app.consectetuer')</a></span>@lang('app.adipiscing')</p>
                        </li>
                        <li><i class="fa fa-twitter tw1"> </i>
                            <p><span class="yellow"><a
                                        href="">@lang('app.consectetuer')</a></span>@lang('app.adipiscing')</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 grid_3">
                <h4>@lang('app.seeking')</h4>
                <p>@lang('app.introduce')</p>
            </div>
            <div class="col-md-3 grid_3">
                <h4>@lang('app.signup-email')</h4>
                <form>
                    <input type="text" class="form-control" placeholder="@lang('app.email')">
                    <button type="button" class="btn red">@lang('app.subcribe')</button>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</body>

</html>
