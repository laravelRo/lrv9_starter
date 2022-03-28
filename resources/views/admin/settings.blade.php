@extends('admin.template')

@section('content')
    <h1>{{ Auth::user()->name }} - role <span class="text-info">{{ Auth::user()->role }}</span></h1>
@endsection
