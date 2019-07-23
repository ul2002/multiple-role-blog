@include('layout.header')

{{--Main master blade template goes here with a container class--}}
<div class="container" id="content">

        @yield('content')

</div>

{{--include the footer section into the master blade template--}}
@include('layout.footer')