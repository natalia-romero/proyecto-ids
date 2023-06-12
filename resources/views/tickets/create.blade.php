@extends('adminlte::page')
@section('title', 'Crear Ticket')
@section('css')
@include('tickets.partials.options')
<link href="{{ asset('vendor/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/js/app.js') }}"></script>
@stop

@section('content_header')
    <!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-xl">
            <div class="card card-closeup-dark">
                <div class="card-header">
                    <h3 class="card-title">Crear Ticket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('tickets.store') }}" method="post" enctype="multipart/form-data" id="ticketForm">
                    @include('tickets.partials.form')
                </form>
            </div>
        </div>
        {{-- @hasSection('options')
            <div class="col-12 order-first col-xl-3 order-xl-last">
                @yield('options')
            </div>
        @endif --}}
    </div>
@stop
