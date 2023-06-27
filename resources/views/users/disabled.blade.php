@extends('adminlte::page')
@section('title', 'Listado de usuarios deshabilitados')
@section('css')
    @include('users.partials.options')
@stop

@section('content_header')
    <!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de usuarios deshabilitados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($users) && $users->count())
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->role->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->phone }} </td>
                                        <td>
                                            <form action="{{ route('users.restore', $user) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button class="btn btn-sm btn-success" type="submit">
                                                    <i class="fas fa-trash-restore"></i>
                                                    Restaurar usuario
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> No hay usuarios deshabilitados.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer pagination justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        @hasSection('options')
            <div class="col-12 order-first col-xl-3 order-xl-last">
                @yield('options')
            </div>
        @endif
    </div>
@stop
