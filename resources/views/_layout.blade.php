<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.svg') }}">
    <title>{{ $title ?? '' }} | {{config('app.name')}}</title>
    <script src="{{ asset('assets/js/twind.min.js') }}"></script>
    <script src="{{ asset('assets/js/twind.custom.js') }}"></script>
    @vite(['resources/js/app.js'])
    <script>
        let config = { ...@js(config('twind')), ...customTwindconf };
        twind.install(config);
    </script>
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
<body class="bg-gray-200 relative">

   @if(session('success'))
        <div class="alert alert-success absolute top-0 left-0 right-0 bg-green-100 text-green-800 border border-green-200 rounded-lg p-4 mb-4 mx-auto max-w-6xl mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger absolute top-0 left-0 right-0 bg-red-100 text-red-800 border border-red-200 rounded-lg p-4 mb-4 mx-auto max-w-6xl mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{$slot}}
</body>
</html>