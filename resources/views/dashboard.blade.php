<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="moyasar-publishable-key" content="{{ config('services.moyasar.publishable_key') }}">
    <meta name="moyasar-callback-url" content="{{ route('dashboard.payment.callback') }}">

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

    @if(session('status'))
        <div class="alert alert-success absolute top-0 left-0 right-0 bg-green-100 text-green-800 border border-green-200 rounded-lg p-4 mb-4 mx-auto max-w-6xl mt-4">
            {{ session('status') }}
        </div>
    @endif

    @if(session('color'))
        <div class="alert alert-{{ session('color') }} absolute top-0 left-0 right-0 bg-{{ session('color') }}-100 text-{{ session('color') }}-800 border border-{{ session('color') }}-200 rounded-lg p-4 mb-4 mx-auto max-w-6xl mt-4">
            {{ session('status') }}
        </div>
    @endif
    
    <div id="app"></div>
</body>
</html>