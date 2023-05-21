@extends('adminlte::page')
@section('title', 'Listado de tickets')
@section('css')
    @include('tickets.partials.options')

@stop

@section('content_header')
    <!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de tickets</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Funcionario</th>
                                <th>Responsable</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($tickets) && $tickets->count())
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td> {{ $ticket->id }} </td>
                                        <td> {{ $ticket->category->name }} </td>
                                        <td> {{ $ticket->functionary->name }} </td>
                                        <td> {{ $ticket->user->name }} </td>
                                        <td> {{ $ticket->state->name }} </td>
                                        <td>
                                            @if ($ticket->state_id != $close_state)
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('tickets.edit', $ticket) }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </a>
                                            @endif

                                            @if (Auth::user()->is_coordinator && $ticket->state_id == $close_state)
                                                <form action="{{ route('tickets.open', $ticket) }}" method="POST"
                                                    style="display: inline;" class="open-ticket">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        <i class="fas fa-check-double"></i>
                                                        Abrir ticket
                                                    </button>
                                                </form>
                                            @elseif ($ticket->state_id != $close_state)
                                                <form action="{{ route('tickets.close', $ticket) }}" method="POST"
                                                    style="display: inline;" class="close-ticket"
                                                    data-*="{{ Auth::user()->is_coordinator }}">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm btn-warning" type="submit">
                                                        <i class="fas fa-check-double"></i>
                                                        Cerrar ticket
                                                    </button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> No hay tickets.</td>
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
        {{-- @hasSection('options')
            <div class="col-12 order-first col-xl-3 order-xl-last">
                @yield('options')
            </div>
        @endif --}}
    </div>
@stop
@section('js')
    @parent
    <script>
        $('.close-ticket').submit(function(e) {
            var isCoordinator = this.getAttribute('data-*');
            var textInfo = 'Al cerrar el ticket estás confirmando que el proceso se ha terminado.'
            if (!isCoordinator) {
                textInfo = textInfo + ' Esta acción no se puede revertir.';
            }
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: textInfo,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar ticket',
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
