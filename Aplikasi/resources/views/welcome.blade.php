<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400;1,6..72,500&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --bg: #15140f;
                --bg-soft: #1b1a14;
                --ink: #ece6d8;
                --ink-dim: #9c9582;
                --line: #33312790;
                --accent: #8fa9ab;
                --accent-soft: #8fa9ab26;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                min-height: 100%;
            }

            body {
                background: radial-gradient(120% 140% at 12% -10%, var(--bg-soft) 0%, var(--bg) 55%);
                color: var(--ink);
                font-family: var(--font-sans, 'Instrument Sans', ui-sans-serif, system-ui, sans-serif);
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .wrap {
                width: 100%;
                max-width: 78rem;
                margin: 0 auto;
                padding: 0 1.75rem;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* ---------- Nav ---------- */
            .nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 2.25rem 0 1.5rem;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                font-size: 0.9rem;
                letter-spacing: 0.04em;
                color: var(--ink);
                text-decoration: none;
            }

            .brand-mark {
                width: 1.85rem;
                height: 1.85rem;
                border-radius: 50%;
                border: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Newsreader', serif;
                font-style: italic;
                font-size: 0.95rem;
                color: var(--accent);
                flex-shrink: 0;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                font-size: 0.85rem;
            }

            .nav-links a {
                color: var(--ink-dim);
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .nav-links a:hover {
                color: var(--ink);
            }

            .nav-cta {
                color: var(--ink) !important;
                padding: 0.5rem 1.1rem;
                border: 1px solid var(--line);
                border-radius: 2px;
                transition: border-color 0.2s ease, background-color 0.2s ease;
            }

            .nav-cta:hover {
                border-color: var(--accent);
                background: var(--accent-soft);
            }

            /* ---------- Hero ---------- */
            .hero {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 3rem 0 4rem;
            }

            .eyebrow-row {
                display: flex;
                align-items: center;
                gap: 0.85rem;
                margin-bottom: 1.5rem;
            }

            .eyebrow {
                font-size: 0.72rem;
                letter-spacing: 0.22em;
                text-transform: uppercase;
                color: var(--accent);
                white-space: nowrap;
            }

            .eyebrow-rule {
                height: 1px;
                width: 4.5rem;
                background: var(--line);
                position: relative;
                overflow: hidden;
            }

            .eyebrow-rule::after {
                content: '';
                position: absolute;
                inset: 0;
                background: var(--accent);
                transform: translateX(-100%);
                animation: draw 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
            }

            @keyframes draw {
                to { transform: translateX(0); }
            }

            h1 {
                font-family: 'Newsreader', Georgia, serif;
                font-weight: 400;
                font-size: clamp(2.4rem, 6vw, 4.2rem);
                line-height: 1.08;
                letter-spacing: -0.01em;
                max-width: 38rem;
                color: var(--ink);
            }

            h1 em {
                font-style: italic;
                color: var(--accent);
            }

            .lede {
                margin-top: 1.6rem;
                max-width: 30rem;
                font-size: 1.02rem;
                line-height: 1.65;
                color: var(--ink-dim);
            }

            .actions {
                display: flex;
                align-items: center;
                gap: 1.75rem;
                margin-top: 2.75rem;
                flex-wrap: wrap;
            }

            .btn-primary {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.75rem 1.5rem;
                background: var(--ink);
                color: var(--bg);
                text-decoration: none;
                font-size: 0.9rem;
                letter-spacing: 0.01em;
                border-radius: 2px;
                transition: transform 0.2s ease, background-color 0.2s ease;
            }

            .btn-primary:hover {
                background: var(--accent);
                transform: translateY(-1px);
            }

            .btn-primary svg {
                width: 0.85rem;
                height: 0.85rem;
                transition: transform 0.2s ease;
            }

            .btn-primary:hover svg {
                transform: translate(2px, -2px);
            }

            .btn-text {
                font-size: 0.9rem;
                color: var(--ink-dim);
                text-decoration: none;
                border-bottom: 1px solid var(--line);
                padding-bottom: 0.2rem;
                transition: color 0.2s ease, border-color 0.2s ease;
            }

            .btn-text:hover {
                color: var(--ink);
                border-color: var(--accent);
            }

            /* ---------- Footer ---------- */
            .foot {
                border-top: 1px solid var(--line);
                padding: 1.4rem 0 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 0.78rem;
                color: var(--ink-dim);
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .foot a {
                color: var(--ink-dim);
                text-decoration: none;
                border-bottom: 1px solid transparent;
                transition: color 0.2s ease, border-color 0.2s ease;
            }

            .foot a:hover {
                color: var(--ink);
                border-color: var(--line);
            }

            .foot .dot {
                opacity: 0.5;
                margin: 0 0.5rem;
            }

            @media (max-width: 640px) {
                .nav { padding: 1.75rem 0 1.25rem; }
                .foot { flex-direction: column; align-items: flex-start; }
            }

            @media (prefers-reduced-motion: reduce) {
                .eyebrow-rule::after { animation: none; transform: translateX(0); }
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <header class="nav">
                <a href="{{ url('/') }}" class="brand">
                    <span class="brand-mark">{{ Str::substr(config('app.name', 'L'), 0, 1) }}</span>
                    <span>{{ config('app.name', 'Laravel') }}</span>
                </a>

                @if (Route::has('login'))
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
                @endif
            </header>

            <main class="hero">
                <div class="eyebrow-row">
                    <span class="eyebrow">Welcome</span>
                    <span class="eyebrow-rule"></span>
                </div>

                <h1>Built with care,<br><em>made to last.</em></h1>

                <p class="lede">
                    A quiet, considered foundation for what you're building next.
                    Laravel underneath, nothing in the way.
                </p>

                <div class="actions">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">
                            Go to dashboard
                            <svg viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                            </svg>
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">
                                Get started
                                <svg viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                                </svg>
                            </a>
                        @endif
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn-text">Already have an account?</a>
                        @endif
                    @endauth
                </div>
            </main>

            <footer class="foot">
                <span>Laravel v{{ app()->version() }} &middot; PHP v{{ PHP_VERSION }}</span>
                <span>
                    <a href="https://laravel.com/docs" target="_blank">Documentation</a>
                    <span class="dot">&middot;</span>
                    <a href="https://laracasts.com" target="_blank">Laracasts</a>
                </span>
            </footer>
        </div>
    </body>
</html>