<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class='bg-gradient-primary'>
    <div id="content-wrapper">
        <div id="content">
            @yield('content')
        </div>
    @include('partials.footer-auth')
    </div>
    @include('partials.footer-script')
</body>

</html>