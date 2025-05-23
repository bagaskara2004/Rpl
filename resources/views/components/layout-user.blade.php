<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RPL | PNB</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/e01ab22bb7.js" crossorigin="anonymous"></script>
</head>

<body>

    <x-navbar-user></x-navbar-user>

    {{ $slot }}

    <x-footer-user></x-footer-user>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</body>

</html>
