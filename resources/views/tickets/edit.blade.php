@extends('adminlte::page')
@section('title', 'Editar Ticket')
@section('css')
@include('tickets.partials.options')

@stop

@section('content_header')
<!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-12 col-xl">
        <div class="card card-closeup-dark">
            <div class="card-header">
                <h3 class="card-title">Editar Ticket</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('tickets.update', $ticket) }}" method="post">
                @include('tickets.partials.form', ['ticket' => $ticket])
                @method('PATCH')
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
