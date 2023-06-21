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
                                @if (Auth::user()->is_coordinator)
                                    <th>Responsable</th>
                                @endif
                                <th>SLA</th>
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
                                        @if (Auth::user()->is_coordinator)
                                            <td> {{ $ticket->user == null ? 'Sin asignar' : $ticket->user->name }} </td>
                                        @endif
                                        @if ($ticket->sla->id == 1)
                                            <td> <span class="badge badge-success">{{ $ticket->sla->name }}</span> </td>
                                        @elseif ($ticket->sla->id == 2)
                                            <td> <span class="badge badge-warning">{{ $ticket->sla->name }}</span> </td>
                                        @elseif ($ticket->sla->id == 3)
                                            <td> <span class="badge badge-danger">{{ $ticket->sla->name }}</span> </td>
                                        @endif
                                        <td> {{ $ticket->state->name }} </td>
                                        <td>
                                            <a class="btn btn-sm bg-purple " href="{{ route('tickets.show',$ticket) }}">
                                                <i class="fas fa-eye"></i>
                                                Ver
                                            </a>
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
        <div class="col-12 order-first col-xl-3 order-xl-last">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <form action="{{ route('tickets.index') }}" enctype="multipart/form-data" id="ticketFilter">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Filtrar</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label">Estado</label>
                                                <select class="form-control state" style="width: 100%;" name="state">
                                                    <option></option>
                                                    @if (!empty($states) && $states->count())
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">
                                                                {{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option disabled>No hay estados.</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label">SLA</label>
                                                <select class="form-control sla" style="width: 100%;" name="sla">
                                                    <option></option>
                                                    @if (!empty($slas) && $slas->count())
                                                        @foreach ($slas as $sla)
                                                            <option value="{{ $sla->id }}">
                                                                {{ $sla->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option disabled>No hay SLAs.</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        @if (Auth::user()->is_coordinator)
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1"
                                                        class="form-label">Responsable</label>
                                                    <select class="form-control user" style="width: 100%;" name="user">
                                                        <option></option>
                                                        @if (!empty($users) && $users->count())
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option disabled>No hay responsables.</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <center>
                                            <button type="submit" class="btn btn-info "><i class="fas fa-filter"></i>
                                                Aplicar filtros
                                            </button>
                                            <a class="btn btn-default" href="{{ route('tickets.index') }}">
                                                <i class="fas fa-broom"></i>
                                                Limpiar filtros
                                            </a>
                                        </center>
                                    </div>
                                    <!-- /.card-footer-->
                                </div>

                            </form>
                            <!-- /.card -->
                        </div>
                        <div class="col-12">
                            <!-- Default box -->
                            <form action="{{ route('tickets.index') }}" enctype="multipart/form-data" id="ticketFilter">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Opciones</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">
                                                    <i class="fas fa-file-csv"></i>

                                                    Exportar a CSV
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger btn-block">
                                                    <i class="fas fa-file-pdf"></i>

                                                    Exportar a PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </form>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@stop
@section('js')
    @parent
    <script>
        $(document).ready(function() {
            $('.state').select2({
                placeholder: "Seleccione estado",
                allowClear: true
            });
            $('.sla').select2({
                placeholder: "Seleccione SLA",
                allowClear: true
            });
            $('.user').select2({
                placeholder: "Seleccione responsable",
                allowClear: true
            });
        });
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
