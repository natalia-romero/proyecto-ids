@extends('adminlte::page')
@section('title', 'Listado de usuarios')
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
                    <h3 class="card-title">Listado de usuarios</h3>
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
                                            <a class="btn btn-sm btn-primary " href="{{ route('users.edit', $user) }}">
                                                <i class="fas fa-edit"></i>
                                                Editar
                                            </a>
                                            <form action="{{route('users.destroy',$user)}}" method="POST" style="display: inline;" class="delete">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-warning" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                    Deshabilitar usuario
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> No hay usuarios.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        @hasSection('options')
            <div class="col-12 order-first col-xl-3 order-xl-last">
                @yield('options')
            </div>
        @endif
    </div>
@stop
@section('js')
    @parent
    <script>
        $('.delete').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Si deshabilitas a este usuario no podrás seguir viendo su información y los tickets abiertos que estén asignados al él quedarán sin responsable.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar usuario.',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@stop
