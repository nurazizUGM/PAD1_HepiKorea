@extends('layout.auth')
@section('title', ' - Password Changed!')

@section('content')
    <div class="bg-white h-auto flex flex-col w-1/2 max-w-lg p-10 m-auto shadow-lg rounded-2xl">
        <h1 class="text-black text-2xl font-bold mb-5 mx-auto">You have successfully logged out!</h1>
        <img src="{{ asset('img/assets/icon/icon_green_check.svg') }}" alt="User Icon" class="h-16 w-16 mx-auto">
    </div>

@endsection
