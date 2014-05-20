<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ URL::route('homepage') }}}">Главная</a>
</li>
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ URL::route('articles') }}}">Статьи</a>
</li>

@if (Sentry::check())
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ URL::route('profile') }}}">Profile</a>
</li>

<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ URL::route('logout') }}}">LogOut</a>
</li>
@else
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ URL::route('login') }}}">LogIn</a>
</li>
@endif

