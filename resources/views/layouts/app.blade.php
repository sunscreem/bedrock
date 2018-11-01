@include('layouts.partials.common-head')
<body>
    <div id="app">
        @include('layouts.partials.header')

        @yield('content')

        @include('layouts.partials.footer')

        @include('layouts.partials.footer-scripts')
    </div>
   </body>
</html>