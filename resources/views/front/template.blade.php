@include('front.partials.head')

<body>

    @include('front.partials.header')
    @include('front.partials.hero')

    <main id="main">
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-info">

                A fost trimis un nou email de verificare la adresa indicata!
            </div>
        @endif
    </main>

    @include('front.partials.footer')

    @include('front.partials.scripts')


</body>

</html>
