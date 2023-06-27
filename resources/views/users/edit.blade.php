@extends('adminlte::page')
@section('title', 'Editar usuario')
@section('css')

@stop

@section('content_header')
<!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-12 col-xl">
        <div class="card card-closeup-dark">
            <div class="card-header">
                <h3 class="card-title">Editar usuario</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('users.update', $user) }}" method="post">
                @include('users.partials.form', ['user' => $user])
                @method('PATCH')
            </form>
        </div>
    </div>
</div>
@stop
