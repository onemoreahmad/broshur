<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/broshur-logo-shape.webp') }}">
    <title>{{ $title ?? '' }} | {{config('app.name')}}</title>
    {{-- <script src="{{ asset('assets/js/twind.min.js') }}"></script>
    <script src="{{ asset('assets/js/twind.custom.js') }}"></script> --}}
    @vite(['resources/js/dashboard/index.js','resources/css/dashboard.css'])
    {{-- <script>
        let config = { ...@js(config('twind')), ...customTwindconf };
        twind.install(config);
    </script> --}}
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    @if (app()->environment('production'))
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-FGLEWMFNLV"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-FGLEWMFNLV');
        </script>
    @endif
</head>
<body class="">
    <div id="app"></div>
</body>
</html>