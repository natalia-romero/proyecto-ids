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
                    <div class="card">
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
                    <div class="card">
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
                                                <td>
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('files.show', $file) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('files.destroy', ['file' => $file, 'ticket' => $ticket]) }}"
                                                        method="POST" style="display: inline;" class="delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Comentarios</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            @if (!empty($comments) && $comments->count())
                                @foreach ($comments as $comment)
                                    <div class="post text-dark">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('vendor/adminlte/dist/img/default-user-icon.png') }}">
                                            <span class="username">
                                                {{ $comment->user->name }}
                                            </span>
                                            <span class="description">{{ $comment->created_at }}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{ $comment->description }}
                                        </p>
                                    </div>
                                @endforeach

                                <!-- /.tab-content -->
                            @else
                                <p> No hay comentarios.</p>
                            @endif
                        </div><!-- /.card-body -->
                        @if ($ticket->state_id != $close_state)
                            <div class="card-footer">
                                <form action="{{ route('comments.store') }}" class="form-horizontal" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group input-group-sm mb-0">
                                        <input type="hidden" value="{{ $ticket->id }}" name="ticket">
                                        <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" name="description"
                                            placeholder="Añadir comentario"></textarea>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        @endif
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
