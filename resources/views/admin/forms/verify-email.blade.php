@extends('admin.forms.layout')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header header-form">
            <h3 class="text-center font-weight-light my-4">Email-verification</h3>
            <p>Pe adresa de email a contului inregistrat a fost trimis un link de confirmare valabil 2h. </p>

        </div>
        <div class="card-body">
            <p>
                Va rugam confirmati contul conform instructiunilor primite. In cazul in care nu ati gasit acest email de
                confirmare a contului
                va rugam sa verificati si sectiunea spam a adresei Dvs.
            </p>
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-info">

                    A fost trimis un nou email de verificare la adresa inregistrata pentru acest cont!
                </div>
            @endif
            <hr>
            <p>
                In cazul in care linkul a expirat sau nu ati gasit emailul de confirmare apasati butonul de mai jos pentru a
                va retrimite un nou link.
            </p>
            <div class="d-flex justify-content-between">
                <a class="btn btn-dark" href="{{ route('home') }}" title="Home"><i
                        class="fa-solid fa-arrow-rotate-left"></i></a>
                <button class="btn btn-primary">Send new confirmation link</button>
            </div>

        </div>
    </div>
@endsection
