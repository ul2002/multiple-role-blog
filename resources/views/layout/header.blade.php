<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--Page title goes here--}}
    <title>@yield('title')</title>
    {{--include cross site scripting validation token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.min.css')  }}">
<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/profile_page.css')}}">
    <link rel="stylesheet" href="{{ asset('css/edit_user.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">

{{--basic styling for the master template file--}}
    <style>
        body {
            width: 100%;
        }

        #content {
            padding: 10px;
            margin: 20px;
        }
    </style>

    {{--add dynamic css styles if need be--}}
    @yield('styles')

</head>
<body>

{{--set the base URL for the application here--}}
<input id="baseUrl" value="{{URL::to('/api/v1')}}" type="hidden">