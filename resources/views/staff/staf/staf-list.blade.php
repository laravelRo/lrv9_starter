@extends('staff.template')

@section('content')
    <h1 class="my-4"><i class="fa-solid fa-user-tie"></i>
        @if (request('blocked'))
            <span class="text-danger"> Administrarea membrilor Staff blocati - {{ $staf->total() }}</span>
        @else
            Administrarea membrilor Staff - {{ $staf->total() }}
        @endif
    </h1>
    <ol class="breadcrumb mb-4 bg-light p-3">
        <li class="breadcrumb-item"><a href="{{ route('staf.cpanel') }}">Control panel</a></li>
        @if (request('blocked'))
            <li class="breadcrumb-item "> <a href="{{ route('staf.list.staf') }}"> <i class="fa-solid fa-user-tie"></i>
                    Staff
                    members</a>
            </li>
            <li class="breadcrumb-item active"> <i class="fa-solid fa-ban"></i> Blocked staff members
            </li>
        @else
            <li class="breadcrumb-item active"><i class="fa-solid fa-user-tie"></i> Staff members</li>
            <li class="breadcrumb-item "> <a class="link-danger"
                    href="{{ route('staf.list.staf', ['blocked' => 1]) }}"><i class="fa-solid fa-ban"></i> Blocked staff
                    members</a></li>
        @endif
    </ol>
    <div>
        @if (!request('blocked'))
            <a href="{{ route('staf.new.staf') }}" class="btn btn-primary float-end"><i class="fa-solid fa-user-plus"></i>
                Add
                Staff Member</a>
        @endif
        <h4>
            @if (request('blocked'))
                Membrii Staff blocati
            @else
                Listarea membrilor din staff-ul de administrare
            @endif
        </h4>
    </div>

    <table class="table table-striped">
        <thead>
            <th>Nume</th>
            <th>Email / phone</th>
            <th>Image</th>
            <th>Role</th>
            <th>Actions</th>
        </thead>
        @forelse($staf as $key => $user)
            <tr class="align-middle">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }} <br> <span class="text-info">{{ $user->phone }}</span></td>
                <td><img src="{{ $user->photoUrl() }}" alt="" style="max-width: 100px;"></td>
                <td>{{ $user->role }}</td>
                <td>


                    <form action="{{ route('staf.block.staf', $user->id) }}" id="block-{{ $user->id }}"
                        class="d-none" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <form action="{{ route('staf.delete.staf', $user->id) }}" id="delete-{{ $user->id }}"
                        class="d-none" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <form action="{{ route('staf.restore.staf', $user->id) }}" id="restore-{{ $user->id }}"
                        class="d-none" method="POST">
                        @csrf

                    </form>


                    @if (request('blocked'))
                        <button onclick="confirmRestore('restore-{{ $user->id }}','{{ $user->name }}')"
                            class="btn btn-primary">
                            <i class="fa-solid fa-rotate-left"></i> Restore
                        </button>
                        <button onclick="confirmDelete('delete-{{ $user->id }}','{{ $user->name }}')"
                            class="btn btn-danger" id="delete-staf-{{ $user->id }}"><i class="fa-solid fa-trash"></i>
                            Delete</button>
                    @else
                        <a href="{{ route('staf.edit.staf', $user->id) }}" class="btn btn-success"><i
                                class="fa-solid fa-pencil"></i> Edit</a>
                        <button onclick="confirmBlock('block-{{ $user->id }}','{{ $user->name }}')"
                            class="btn btn-danger" id="block-staf-{{ $user->id }}"><i class="fa-solid fa-ban"></i>
                            Block</button>
                    @endif
                </td>
            </tr>
        @empty
            <br>

            <h4 class="text-info">
                @if (request('blocked'))
                    Nici un membru blocat!
                @else
                    Nici un membru inregistrat!
                @endif
            </h4>
        @endforelse
    </table>
    <div class="bg-light">
        {{ $staf->links() }}
    </div>
@endsection

@push('customJs')
    <script>
        window.confirmBlock = function(formId, name) {
            Swal.fire({
                icon: 'question',
                'title': 'Blocare membru Staff',
                text: 'Confirmati blocarea membrului staff ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Block',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });

        }
        window.confirmDelete = function(formId, name) {
            Swal.fire({
                icon: 'question',
                'title': 'Stergere definitiva membru Staff',
                text: 'Confirmati stergerea membrului staff ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });

        }

        window.confirmRestore = function(formId, name) {
            Swal.fire({
                icon: 'question',
                'title': 'Re-activare membru Staff',
                text: 'Confirmati re-activarea membrului staff ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Restore',
                confirmButtonColor: '#2e55c9',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });

        }
    </script>
@endpush
