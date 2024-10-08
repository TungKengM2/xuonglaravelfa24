<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Xưởng Laravel</title>

    @include('posts.layouts.partials.css')
</head>

<body>
    <!-- navigation -->
    <header class="navigation fixed-top">
        @include('posts.layouts.partials.header')
    </header>
    <!-- /navigation -->


   @yield('content')

    <footer class="footer">
        @include('posts.layouts.partials.footer')
    </footer>


    <!-- JS Plugins -->
    @include('posts.layouts.partials.js')
</body>

</html>
