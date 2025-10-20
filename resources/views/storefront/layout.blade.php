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
</head>
<body>
    {{$slot}}

    <div class="absolute bottom-0 w-full p-4 ">
        <div class="text-center text-xs text-black/80 flex items-center justify-center gap-2 group">
            <a href="{{config('app.url')}}" target="_blank" class="text-gray-500  flex flex-col items-center gap-2">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="{{config('app.name')}}" class="size-8 group-hover:hidden" />
                <span class="">{{config('app.name')}}</span>
            </a>
        </div>
    </div>

</body>
</html>