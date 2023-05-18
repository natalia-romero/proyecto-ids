@csrf
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Razón</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese razón">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Funcionario</label>
                <select class="form-control functionary" style="width: 100%;">
                    <option></option>
                    @for ($i = 0; $i < 5; $i++)
                        <option>Funcionario {{ $i + 1 }}</option>
                    @endfor
                </select>
            </div>
            <!-- /.form-group -->
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Categoría</label>
                <select class="form-control category" style="width: 100%;">
                    <option></option>
                    @for ($i = 0; $i < 5; $i++)
                        <option>Categoría {{ $i + 1 }}</option>
                    @endfor
                </select>
            </div>
            <!-- /.form-group -->
        </div>
    </div>
    <!-- /.card-body -->
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
</div>
@section('js')
    @parent
    <script>
        $(document).ready(function() {
            $('.functionary').select2({
                placeholder: "Seleccione Funcionario",
                allowClear: true
            });
            $('.category').select2({
                placeholder: "Seleccione Categoría",
                allowClear: true
            });
        });
    </script>
@stop
