@extends('staff.template')

@section('content')
    <h1 class="my-4"><i class="fa-solid fa-user-tie"></i> Adaugare membru Staff</h1>
    <ol class="breadcrumb mb-4 bg-light p-3">
        <li class="breadcrumb-item"><a href="{{ route('staf.cpanel') }}">Control panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('staf.list.staf') }}"><i class="fa-solid fa-user-tie"></i> Staff
                members</a></li>
        <li class="breadcrumb-item active"><i class="fa-solid fa-user-plus"></i> Add Staff Member</li>
    </ol>

    <div class="card my-4 p-3">
        <form action="{{ route('staf.add.staf') }}" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <h4>Adaugare membru nou staff</h4>
            </div>
            <div class="card-body">
                @csrf

                {{-- === ROW 1 === --}}
                <div class="row my-2">
                    <div class="col-md-4">
                        <label for="name">Nume membru staff<span class="text-danger">*</span></label>
                        <input name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                            placeholder="Name of staff member" required />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="email">Adresa email<span class="text-danger">*</span></label>
                        <input name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                            placeholder="Email address of staff member" required />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="role">Rol membru staff<span class="text-danger">*</span></label>
                        <select name="role" class="form-select" id="role">
                            <option selected>Selectati Rolul</option>
                            <option {{ old('role') == 'assistent' ? 'selected' : '' }} value="assistent">Assistent
                            </option>
                            <option {{ old('role') == 'manager' ? 'selected' : '' }} value="manager">Manager</option>
                            <option {{ old('supervisor') == 'assistent' ? 'selected' : '' }} value="supervisor">Supervisor
                            </option>
                        </select>
                    </div>

                </div>

                {{-- === ROW 2 === --}}
                <div class="row my-2">
                    <div class="col-md-4">
                        <div id="img-preview">
                            <img class="img-form" src="/images/staff/user.png" alt="">
                        </div>

                        <div class="custom-file">

                            <label class="custom-file-label" for="photoFile"> Select foto </label>
                            <input name="photo" value={{ old('photo') }} accept="image/*" class="form-control my-2"
                                type="file" id="photoFile">

                        </div>

                    </div>
                    <div class="col-md-4 d-flex flex-column justify-content-end">
                        <label for="phone">Numere telefon contact</label>
                        <input name="phone" value="{{ old('phone') }}"
                            class="form-control my-2 @error('phone') is-invalid @enderror" id="name" type="text"
                            placeholder="Phone numbers for contact of staff member" required />
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <div class="form-check">
                            <input name="verified" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                                @if (empty(old('verified'))) checked @endif {{ old('verified') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                Email verified?
                            </label>
                        </div>
                    </div>
                </div>

                {{-- === ROW 3 === --}}
                <div class="row my-4 bg-light py-3 border border-warning">
                    <div class="col-md-4">

                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            type="password" placeholder="Password for staff member" required />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="col-md-4">

                        <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                        <input name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" type="password" placeholder="Password for staff member" required />
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>

            </div>
            <div class="card-footer py-3 bg-dark d-flex justify-content-between">
                <a href="{{ route('staf.list.staf') }}" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                    Return</a>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Create Staff
                    Member</button>
            </div>
        </form>
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
