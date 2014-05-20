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
