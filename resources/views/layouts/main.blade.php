<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield("title")</title>

        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>

    </head>
    <body>
        <header>
          <h1>Escalar</h1>
          <h2>Comunicação & Marketing</h2>
        </header>

        <main>
          <div class="container">
            @yield("content")
          </div>
        </main>
    </body>
</html>
