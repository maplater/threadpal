<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>ThreadPal</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}" type="text/css">

    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{url('/font-awesome/css/font-awesome.min.css')}}" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{url('/css/animate.min.css')}}" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('/css/creative.css')}}" type="text/css">
    <link href="https://cdn.snipcart.com/themes/2.0/base/snipcart.min.css" type="text/css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('header')
</head>
<body id="page-top">


    @yield('content')


    <!-- jQuery -->
    <script src="{{url('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('/js/bootstrap.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{url('/js/jquery.easing.min.js')}}"></script>
    <script src="{{url('/js/jquery.fittext.js')}}"></script>
    <script src="{{url('/js/wow.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('/js/creative.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}


    <script src="https://cdn.snipcart.com/scripts/2.0/snipcart.js" id="snipcart" data-api-key="Y2Y3MTcwMGItYTk1MC00YmM0LWFlZjAtODU2YmQxMzM0OWMzNjM2MTgyMjIwNTAwODU2MDI3"></script>



</body>
</html>
