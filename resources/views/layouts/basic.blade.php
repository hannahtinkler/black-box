<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo env('APP_NAME', 'Black Box'); ?></title>

    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div id="app" class="wrapper">
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>

