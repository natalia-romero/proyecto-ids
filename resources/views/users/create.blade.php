@extends('adminlte::page')
@section('title', 'Crear usuario')
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
                    <h3 class="card-title">Crear usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="userForm">
                    @include('users.partials.form')
                </form>
            </div>
        </div>
    </div>
@stop
