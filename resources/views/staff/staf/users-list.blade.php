@extends('staff.template')

@section('content')
    <h1 class="my-4">
        @if (request('blocked'))
            <i class="fa-solid fa-user-lock"></i>
        @else
            <i class="fa-solid fa-user"></i>
        @endif
        Administrarea utilizatorilor externi
        @if (request('blocked'))
            blocati
        @endif
        - {{ $users->total() }}
    </h1>
    @if (isset($search))
        <div class="alert alert-info">
            Rezultatele cautarii dupa <b>{{ $search }}</b> - <a href="{{ route('staf.users.list') }}"
                class="link-danger">Lista completa</a>
        </div>
    @endif
    @if (isset($role))
        <div class="alert alert-info">
            Lista utilizatorilor cu rolul <b>{{ $role }}</b> - <a href="{{ route('staf.users.list') }}"
                class="link-danger">Lista completa</a>
        </div>
    @endif

    <ol class="breadcrumb mb-4 bg-light p-3">
        <li class="breadcrumb-item"><a href="{{ route('staf.cpanel') }}">Control panel</a></li>
        @if (request('blocked'))
            <li class="breadcrumb-item">
                <a href="{{ route('staf.users.list') }}">
                    <i class="fa-solid fa-user"></i> List users
                </a>
            </li>
            <li class="breadcrumb-item active"><i class="fa-solid fa-user-lock"></i> Blocked users</a></li>
        @else
            <li class="breadcrumb-item active"><i class="fa-solid fa-user"></i> List users</a></li>
            <li class="breadcrumb-item "><a href="{{ route('staf.users.list', ['blocked' => 1]) }}"><i
                        class="fa-solid fa-user-lock"></i> Blocked users</a></li>
        @endif
    </ol>

    <div>

        <h4>
            Listarea utilizatorilor inscrisi pe site
        </h4>
        <table class="table table-striped">
            <thead>
                <th>Nr </th>
                <th>Nume (id)</th>
                <th>Email / phone</th>
                <th class="text-center">Verified</th>
                <th>Role</th>
                <th>Actions</th>
            </thead>

            @forelse ($users as $user)
                <tr>
                    <td>
                        {{ $users->currentPage() > 1? ($users->currentPage() - 1) * $users->perPage() + $loop->iteration: $loop->iteration }}

                    </td>
                    <td>{{ $user->name }} <span class="text-secondary">({{ $user->id }})</span></td>
                    <td>{{ $user->email }} <br> {{ $user->phone }}</td>
                    <td class="text-center">
                        @if ($user->hasVerifiedEmail())
                            <button class="btn btn-success btn-circle btn-sm"><i
                                    class="fa-solid fa-2x fa-envelope"></i></button><br>
                            {{ $user->email_verified_at->format('Y M-D') }}
                        @else
                            <button class="btn btn-circle btn-md btn-danger"><i
                                    class="fa-solid fa-2x fa-envelope"></i></button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('staf.users.list', ['role' => $user->role]) }}">
                            {{ $user->role }}
                        </a>
                    </td>
                    <td>
                        @if (request('blocked'))
                            <form action="{{ route('staf.users.delete', $user->id) }}" id="delete-{{ $user->id }}"
                                class="d-none" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <form action="{{ route('staf.users.restore', $user->id) }}" id="restore-{{ $user->id }}"
                                class="d-none" method="POST">
                                @csrf

                            </form>
                            <button onclick="confirmRestore('restore-{{ $user->id }}','{{ $user->name }}')"
                                class="btn btn-primary">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                            <button onclick="confirmDelete('delete-{{ $user->id }}','{{ $user->name }}')"
                                class="btn btn-danger" id="delete-staf-{{ $user->id }}"><i
                                    class="fa-solid fa-trash"></i>
                                Delete</button>
                        @else
                            <form action="{{ route('staf.users.block', $user->id) }}" id="block-{{ $user->id }}"
                                class="d-none" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('staf.users.edit', $user->id) }}" class="btn btn-success"><i
                                    class="fa-solid fa-pencil"></i> Edit</a>
                            <button onclick="confirmBlock('block-{{ $user->id }}','{{ $user->name }}')"
                                class="btn btn-danger">
                                <i class="fa-solid fa-ban"></i> Block
                            </button>
                        @endif




                    </td>
                </tr>
            @empty
                <div class="alert alert-info">
                    @if (request('blocked'))
                        Nici un utilizator blocat pe site
                    @else
                        <h4>Nu exista utilizatori inscrisi pe site</h4>
                    @endif
                </div>
            @endforelse
        </table>
        <div>
            {{ $users->links() }}
        </div>
    </div>
@endsection

@push('customJs')
    <script>
        window.confirmBlock = function(formId, name) {
            Swal.fire({
                icon: 'question',
                'title': 'Blocare membru extern',
                text: 'Confirmati blocarea membrului extern ' + name + ' ?',
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
