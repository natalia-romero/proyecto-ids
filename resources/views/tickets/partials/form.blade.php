@csrf
<div class="card-body">
    <div class="row">
        @if (Auth::user()->is_coordinator)
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Responsable</label>
                    <select class="form-control user  @error('user') is-invalid @enderror" style="width: 100%;"
                        name="user">
                        <option></option>
                        @if (!empty($users) && $users->count())
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(isset($ticket) ? $ticket->user_id == $user->id : 0)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        @else
                            <option disabled>No hay usuarios para asignar.</option>
                        @endif
                    </select>
                    @error('user')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- /.form-group -->
            </div>
        @endif
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Funcionario</label>
                <select class="form-control functionary  @error('functionary') is-invalid @enderror"
                    style="width: 100%;" name="functionary"
                    value="{{ old('functionary') ?? (isset($ticket) ? $ticket->functionary_id : '') }}">
                    <option></option>
                    @if (!empty($functionaries) && $functionaries->count())
                        @foreach ($functionaries as $functionary)
                            <option value="{{ $functionary->id }}" @selected(isset($ticket) ? $ticket->functionary_id == $functionary->id : 0)>
                                {{ $functionary->name }}
                            </option>
                        @endforeach
                    @else
                        <option disabled>No hay funcionarios.</option>
                    @endif
                </select>
                @error('functionary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Categoría</label>
                <select class="form-control category  @error('category') is-invalid @enderror" style="width: 100%;"
                    name="category">
                    <option></option>
                    @if (!empty($categories) && $categories->count())
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(isset($ticket) ? $ticket->category_id == $category->id : 0)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @else
                        <option disabled>No hay categorias.</option>
                    @endif
                </select>
                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- /.form-group -->
        </div>
        @if (Route::currentRouteName() == 'tickets.edit')
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Estado</label>
                    <select class="form-control state  @error('state') is-invalid @enderror" style="width: 100%;"
                        name="state">
                        <option></option>
                        @if (!empty($states) && $states->count())
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @selected(isset($ticket) ? $ticket->state_id == $state->id : 0)>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        @else
                            <option disabled>No hay estados.</option>
                        @endif
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endif
        <!-- /.form-group -->
        <div class="col-6">
            <div class="form-group">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror" id="exampleFormControlTextarea1"
                        rows="2" name="description" placeholder="Ingrese descripción">{{ old('description') ?? (isset($ticket) ? $ticket->description : '') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col">
            <div class="form-group">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Subir archivos</label>
                    <input id="file-1" type="file" name="files[]" multiple class="file"
                        data-overwrite-initial="false">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    <a class="btn btn-secondary" href="{{ route('tickets.index') }}"><i class="fas fa-ban"></i> Cancelar</a>
</div>
@section('js')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"
        type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>


    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            language: 'es',
            allowedFileExtensions: ['png','jpeg','jpg','txt', 'ods', 'pdf', 'doc', 'docx', 'xlx', 'xlxs'],
            overwriteInitial: false,
            maxFileSize: 20000,
            maxFilesNum: 10,
            showUpload: false,
            initialCaption: "Selecciona archivos",
            slugCallback: function(filename) {
                return filename.replace('(', '_').replace(']', '_');
            }

        });
        $(".btn-primary").on("click", function() {
            $("#file-1").fileinput('upload');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.functionary').select2({
                placeholder: "Seleccione funcionario",
                allowClear: true
            });
            $('.state').select2({
                placeholder: "Seleccione estado",
                allowClear: true
            });
            $('.category').select2({
                placeholder: "Seleccione categoría",
                allowClear: true
            });
            $('.user').select2({
                placeholder: "Seleccione usuario responsable",
                allowClear: true
            });
        });
    </script>
@stop
