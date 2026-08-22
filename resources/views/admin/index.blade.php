<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/firstPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showPost.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/indexpost.css')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/createPost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/editPost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/headerAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.Review.css') }}">
</head>
<style>
    .delete{
        font-size: 164px;
        text-align: center;
    }
</style>
<body>
    @include('admin.layouts.header')
    @yield('content')

</body>

</html>