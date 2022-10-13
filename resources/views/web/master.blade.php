<!DOCTYPE html>
<html lang="en">
@include('web.includes.head')
<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('web.includes.navbar')

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@include('web.includes.js')
</body>
</html>
