<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('homepage') }}}">Главная</a>
</li>
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('articles') }}}">Статьи</a>
</li>

@if (Sentry::check())
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('acticleCreate') }}}">create Article</a>
</li>

<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('profile') }}}">Profile</a>
</li>

<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('email') }}}">Send mail</a>
</li>

<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('logout') }}}">LogOut ({{{ Sentry::getUser()->username }}})</a>
</li>
@else
<li style="float: left; margin: 0 15px; text-decoration: none; list-style: none;">
    <a href="{{{ route('login') }}}">LogIn</a>
</li>
@endif

