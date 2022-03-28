@include('admin.partials.head')

<body class="sb-nav-fixed">

    {{-- === navbar === --}}
    @include('admin.partials.navbar')


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>


            @include('admin.partials.footer')
        </div>
    </div>
    @include('admin.partials.scripts')
</body>

</html>
