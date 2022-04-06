@extends('staff.template')

@section('content')
    <h1 class="my-4"><i class="fa-solid fa-user"></i>
        Administrarea utilizatorilor - {{ $users->total() }}
    </h1>

    <ol class="breadcrumb mb-4 bg-light p-3">
        <li class="breadcrumb-item"><a href="{{ route('staf.cpanel') }}">Control panel</a></li>
        <li class="breadcrumb-item active">List users</a></li>
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
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('staf.users.edit', $user->id) }}" class="btn btn-success"><i
                                class="fa-solid fa-pencil"></i> Edit</a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-info">
                    <h4>Nu exista utilizatori inscrisi pe site</h4>
                </div>
            @endforelse
        </table>
        <div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
