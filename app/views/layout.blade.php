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
        @section('menu')
            link 1 <br/>
            link 2 <br/>
            link 3 <br/>
        @show
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
