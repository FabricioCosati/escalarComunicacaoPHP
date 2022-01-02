<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield("title")</title>

        <link rel="stylesheet" href="/css/styles.css" />
        <script src="/js/scripts.js"></script>
    </head>
    <body>
        <header>
            <div class="header-title">
                <a href="/">
                    <h1>Escalar</h1>
                    <h2>Comunicação & Marketing</h2>
                </a>
            </div>
            <nav class="navbar">
                <div class="navbar-container" id="navbar">
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Registre-se</a>
                        </li>
                        @endguest @auth
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a
                                    href="/logout"
                                    class="nav-link"
                                    onclick="event.preventDefault(); 
                                        this.closest('form').submit();"
                                    >Logout</a
                                >
                            </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="container">@yield("content")</div>
        </main>
    </body>
</html>
