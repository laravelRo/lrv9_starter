@include('staff.partials.head')

<body class="sb-nav-fixed">

    {{-- === navbar === --}}
    @include('staff.partials.navbar')


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('staff.partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Control Panel</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Control panel</a></li>
                        <li class="breadcrumb-item active">Administration Settings</li>
                    </ol>
                    @yield('content')
                </div>
            </main>


            @include('staff.partials.footer')
        </div>
    </div>
    @include('staff.partials.scripts')
</body>

</html>
