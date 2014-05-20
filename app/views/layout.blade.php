<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<style>

	</style>
</head>
<body>

    <div class="menu">
        <ul>
            @section('menu')
                @include('menu.menu')
            @show

            @section('menu-login')
                <li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
                    <a href="{{{ URL::route('login') }}}">Login</a>
                </li>
            @show
            <div style="clear: both;"></div>
        </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        @yield('footer')
    </div>

    @yield('javascripts')
</body>
</html>
