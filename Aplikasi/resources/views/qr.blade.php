<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ini qr</h1>

                        <nav class="nav-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-cta">Register</a>
                            @endif
                        @endauth
                    </nav>
</body>
</html>