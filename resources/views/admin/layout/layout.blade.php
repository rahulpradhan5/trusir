<!DOCTYPE html>
<html lang="en">
@include('admin.partials.head')

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.partials.sidebar')
        <div class="body-wrapper">
            @include('admin.partials.header')
            @yield('content')
        </div>
    </div>
    @include('admin.partials.footer')
</body>

</html>