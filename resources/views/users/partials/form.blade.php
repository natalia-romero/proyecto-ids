@csrf
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInput">Nombre</label>
                <input type="text" class="form-control   @error('name') is-invalid @enderror" id="exampleInput"
                    placeholder="Ingrese nombre"
                    value="{{ old('name') ?? (isset($user) ? $user->name : '') }}" name="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input type="email" class="form-control   @error('email') is-invalid @enderror"
                    id="exampleInputEmail1" placeholder="Ingrese correo electrónico"
                    value="{{ old('email') ?? (isset($user) ? $user->email : '') }}" name="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Rol</label>
                <select class="form-control role  @error('role') is-invalid @enderror" style="width: 100%;"
                    name="role">
                    <option></option>
                    @if (!empty($roles) && $roles->count())
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(isset($user) ? $user->role_id == $role->id : 0)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    @else
                        <option disabled>No hay roles.</option>
                    @endif
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- /.form-group -->
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInput">Rut</label>
                <input type="text" class="form-control   @error('rut') is-invalid @enderror" id="exampleInput"
                    placeholder="Ingrese rut (12345678-9)" value="{{ old('rut') ?? (isset($user) ? $user->rut : '') }}"
                    name="rut">
                @error('rut')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInput">Teléfono</label>
                <input type="text" class="form-control   @error('phone') is-invalid @enderror" id="exampleInput"
                    placeholder="Ingrese número de télefono"
                    value="{{ old('phone') ?? (isset($user) ? $user->phone : '') }}" name="phone">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="inputPassword3">Contraseña</label>
                <input type="password" class="form-control  @error('password') is-invalid @enderror" id="inputPassword3"
                    placeholder="Ingrese contraseña" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="password_confirmation">Repita contraseña</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="exampleInputEmail1" placeholder="Repita contraseña" name="password_confirmation">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    <a class="btn btn-secondary" href="{{route('users.index')}}"><i class="fas fa-ban"></i> Cancelar</a>
</div>
@section('js')
    @parent
    <script>
        $(document).ready(function() {
            $('.role').select2({
                placeholder: "Seleccione rol",
                allowClear: true
            });
        });
    </script>
@stop
