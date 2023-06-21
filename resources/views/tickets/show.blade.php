@extends('adminlte::page')
@section('title', 'Detalle ticket')
@section('css')

@stop

@section('content_header')
    <!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle Ticket #{{ $ticket->id }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-dark">
                            <strong><i class="fas fa-paperclip"></i> Categoría</strong>
                            <p class="text">
                                {{ $ticket->category->name }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-user"></i> Responsable</strong>
                            <p class="text">
                                {{ $ticket->user == null ? 'Sin asignar' : $ticket->user->name }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-user"></i> Funcionario</strong>
                            <p class="text">
                                {{ $ticket->functionary->name }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-calendar"></i> Fecha</strong>
                            <p class="text">
                                {{ $ticket->created_at }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-clock"></i> SLA</strong>
                            <p class="text">
                                @if ($ticket->sla->id == 1)
                                    <td> <span class="badge badge-success">{{ $ticket->sla->name }}</span> </td>
                                @elseif ($ticket->sla->id == 2)
                                    <td> <span class="badge badge-warning">{{ $ticket->sla->name }}</span> </td>
                                @elseif ($ticket->sla->id == 3)
                                    <td> <span class="badge badge-danger">{{ $ticket->sla->name }}</span> </td>
                                @endif
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Descripción</strong>
                            <p class="text">
                                {{ $ticket->description }}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Archivos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tamaño</th>
                                        <th>Tipo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($files) && $files->count())
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>{{ $file->name }}</td>
                                                <td>{{ round(Storage::disk('local')->size($file->path) / 1000, 1) }} KB
                                                </td>
                                                <td> {{ strtoupper(pathinfo($file->path, PATHINFO_EXTENSION)) }} </td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('files.show', $file) }}" class="btn btn-info">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger"><i
                                                                class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6"> No hay archivos.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Comentarios</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="post text-dark">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="">
                                    <span class="username">
                                        Jonathan Burke Jr.
                                    </span>
                                    <span class="description">7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <form class="form-horizontal">
                                <div class="input-group input-group-sm mb-0">
                                    <textarea class="form-control form-control-sm" placeholder="Añadir comentario"></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('js')
    @parent
    <script></script>
@stop
