<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?php echo env('APP_NAME', 'Black Box'); ?></title>

    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    @include('partials.menus.secondary-menu')

    <div id="app" class="wrapper">
        @include('partials.sidebar')

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="/js/app.js"></script>
</body>

</html>

