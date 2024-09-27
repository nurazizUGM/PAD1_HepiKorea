<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('auth.index') }}"><button>Back</button></a>
    <a href="{{ route('auth.loginView') }}"><button>Login</button></a>
    <a href="{{ route('auth.google') }}"><button>Google</button></a>
    <form action="{{ route('auth.register') }}", method="POST">
        @csrf
        <input type="text" name="fullname" id="fullname" placeholder="Fullname" value="{{ old('fullname') }}">
        <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        <input type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
        <button type="submit">Register</button>
    </form>

    <script>
        @if ($errors->any())
            alert("{{ $errors->first() }}");
        @endif
    </script>
</body>

</html>
