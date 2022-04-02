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
                    @include('messages')

                    @yield('content')
                </div>
            </main>


            @include('staff.partials.footer')
        </div>
    </div>
    @include('staff.partials.scripts')
</body>

</html>
