@extends('staff.template')

@section('content')
    <h1 class="my-4"><i class="fa-solid fa-user-tie"></i> Editare membru site - <span
            class="text-info">{{ $user->name }}</span>
        @if ($user->hasVerifiedEmail())
            <span class="text-success"><i class="fa-solid fa-envelope"></i> </span>
        @else
            <span class="text-danger"><i class="fa-solid fa-envelope"></i> </span>
        @endif
    </h1>
    <ol class="breadcrumb mb-4 bg-light p-3">
        <li class="breadcrumb-item"><a href="{{ route('staf.cpanel') }}">Control panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('staf.users.list') }}"><i class="fa-solid fa-user-tie"></i> Users
                Registered
            </a></li>
        <li class="breadcrumb-item active"><i class="fa-solid fa-pencil"></i> Edit {{ $user->name }}</li>
    </ol>


    <div class="row">
        {{-- ==========
            Editarea datelor pentru membru inregistrat
            ========== --}}
        <div class="col-md-12">
            <div class="card my-4 p-3">
                <form action="{{ route('staf.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Editare membru {{ $user->name }} </h4>
                    </div>
                    <div class="card-body">


                        {{-- === ROW 1 === --}}
                        <div class="row my-2">



                            <div class="col-md-4">
                                <label for="name">Nume membru<span class="text-danger">*</span></label>
                                <input name="name" value="{{ old('name') ? old('name') : $user->name }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                                    placeholder="Name of staff member" required />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="email">Adresa email</label>
                                <input name="email" value="{{ old('email') ? old('email') : $user->email }}"
                                    class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                                    placeholder="Email address of staff member" disabled />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="role">Rol membru site<span class="text-danger">*</span></label>
                                <select name="role" class="form-select" id="role">
                                    <option selected>Selectati Rolul</option>
                                    <option
                                        @if (old('role')) {{ old('role') == 'normal' ? 'selected' : '' }}
                            @else
                            {{ $user->role == 'normal' ? 'selected' : '' }} @endif
                                        value="normal"> Normal
                                    </option>
                                    <option
                                        @if (old('role')) {{ old('role') == 'silver' ? 'selected' : '' }}
                            @else
                            {{ $user->role == 'silver' ? 'selected' : '' }} @endif
                                        value="silver">Silver
                                    </option>
                                    <option
                                        @if (old('role')) {{ old('role') == 'gold' ? 'selected' : '' }}
                            @else
                            {{ $user->role == 'gold' ? 'selected' : '' }} @endif
                                        value="gold">
                                        Gold
                                    </option>
                                </select>
                            </div>


                        </div>

                        {{-- === ROW 2 === --}}
                        <div class="row my-2">

                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <label for="phone">Numere telefon contact</label>
                                <input name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}"
                                    class="form-control my-2 @error('phone') is-invalid @enderror" id="name" type="text"
                                    placeholder="Phone numbers for contact of staff member" required />
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 d-flex flex-column justify-content-center">

                                @if ($user->hasVerifiedEmail())
                                    <label class="text-success"><i class="fa-solid fa-envelope"></i> Checked</label>
                                @else
                                    <label class="text-danger"><i class="fa-solid fa-envelope"></i> Unverified</label>
                                @endif
                                <select name="verified" class="form-select" aria-label="Default select example">
                                    <option selected class="text-secondary">Email verification action</option>

                                    <option value="mark" class="text-success">Mark email as verified</option>
                                    <option value="send" class="text-primary">Send new notification</option>
                                    <option value="invalid" class="text-danger">Invalidate email</option>
                                </select>
                            </div>
                        </div>




                    </div>
                    <div class="card-footer py-3 bg-dark d-flex justify-content-between">
                        <a href="{{ session('users_url') ? session('users_url') : route('staf.users.list') }}"
                            class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                            Return</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pencil"></i> Update
                            {{ $user->name }}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection

@push('customJs')
    <script>
        const chooseFile = document.getElementById("photoFile");
        const imgPreview = document.getElementById("img-preview");
        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result + '"  style="max-width:200px;"/>';
                });
            }
        }
    </script>
@endpush
