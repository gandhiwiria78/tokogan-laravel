<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
    {{--  setting Bootstrap 4  --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    <script src="{{asset('js/app.js')}}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>

</head>
<body id="body">
 <header class="container-fluid border-bottom pt-0 pb-0">
    @yield('navbar')
    
    
</header>
    @yield('jumbotron')
    
    
 {{-- isi atau contain produk --}}
 <div class="container-fluid m-4">
        @yield('artikel_jumbotron')
 </div> 
 <hr>
 <div class="container-fluid flashsale">
        @yield('content')
</div>
 <footer>

 </footer>
 @yield('script')
</body>
    
</html>
