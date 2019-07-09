<html ng-app="myApp">
<title>@yield('title')</title>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script src="{{URL::to('js/angular.min.js')}}"></script>
    <script src="{{URL::to('js/jquery.min.js')}}"></script>
    <script src="/js/myFunctions.js"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/controller.js')}}"></script>
    <script src="{{URL::to('js/qrcode.js')}}"></script>
    <script src="{{URL::to('/js/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>

    <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/3.0.0/toaster.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/3.0.0/toaster.min.js"></script>
</head>

<body ng-controller="myController">
<toaster-container></toaster-container>
@include('partials.header')
<div class="container-fluid">
    @yield('content')
</div>
</body>
</html>