<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Starter Kit</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}


    {{-- stilul sablonului html --}}
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" />
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> --}}

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="{{ asset('faw6/css/all.min.css') }}">
    @stack('customCss')
</head>
