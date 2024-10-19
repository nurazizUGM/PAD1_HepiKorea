<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config()->get('app.name') }}@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- @vite('resources/css/app.css') -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" /> -->
    <style>
        input::-ms-reveal {
            display: none;
        }
    </style>
</head>

<body class="w-screen h-screen bg-cover bg-no-repeat bg-center overflow-hidden" style="background-image:url('{{ asset('img/assets/bg/background_auth.svg') }}')">

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <script>
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    alert("{{ $error }}");
                @endforeach
            });
        @endif
    </script>

    @if (!auth()->check())
        <script src="https://accounts.google.com/gsi/client" async></script>
        <script>
            function handleCredentialResponse(response) {
                console.log("Encoded JWT ID token: " + response.credential);
                window.location.href = "{{ route('auth.callback') }}?credential=" + response.credential;
            }
            window.onload = function() {
                google.accounts.id.initialize({
                    client_id: "{{ config('app.g_client_id') }}",
                    callback: handleCredentialResponse,
                    cancel_on_tap_outside: true
                });
                google.accounts.id.prompt();
            }
        </script>
    @endif
</body>

</html>
