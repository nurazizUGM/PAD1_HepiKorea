<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table th,
        table td {
            text-align: start;
        }
    </style>
</head>

<body>
    @if (auth()->check())
        <a href="{{ route('auth.logout') }}"><button>Logout</button></a>
        <table>
            @if (!empty(auth()->user()->photo))
                <tr>
                    <td colspan="3">
                        <img src="{{ auth()->user()->photo }}" alt="">
                    </td>
                </tr>
            @endif
            <tr>
                <th>Fullname</th>
                <th>:</th>
                <td>{{ auth()->user()->fullname }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <th>:</th>
                <td>{{ auth()->user()->email }}</td>
            </tr>
        </table>
    @else
        <a href="{{ route('auth.loginView') }}"><button>Login</button></a>
        <a href="{{ route('auth.registerView') }}"><button>Register</button></a>
        <a href="{{ route('auth.google') }}"><button>Google</button></a>
    @endif
</body>

</html>
