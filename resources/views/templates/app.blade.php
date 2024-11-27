<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ROBUSTA CAFFE</title>
    @vite('resources/css/app.css')
    @stack('style')

    {{-- swiper js --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

</head>

<body>
    @include('templates.navbar')

    @yield('content')

    {{-- @include('templates.footer') --}}
    @stack('script')

</body>

</html>
