<x-layouts.app title="Empleado" meta-description="Empleado meta description">

    <h1>Editar empleado</h1>

    <div class="container">
        <div class="container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        <form action="{{ route('empleados.update', $empleado) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" id="name" name="name" placeholder="Nombre" class="form-control" value="{{old('name', $empleado->name)}}">
                @error('name')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nif" class="form-label">NIF:</label>
                <input type="text" id="nif" name="nif" placeholder="NIF" class="form-control" value="{{old('nif', $empleado->nif)}}">
                @error('nif')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" email="email" placeholder="email" class="form-control" value="{{old('email', $empleado->email)}}">
                @error('email')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="password" class="form-control" value="">
                @error('password')
                    <small class="feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Repite la contraseña:</label>
                <input type="password" id="password" name="password_confirmation" placeholder="password" class="form-control" value="">
                @error('password')
                    <small class="feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="telefono" id="telefono" name="telefono" placeholder="telefono" class="form-control" value="{{old('telefono', $empleado->telefono)}}">
                @error('telefono')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="direccion" id="direccion" name="direccion" placeholder="direccion" class="form-control" value="{{old('direccion', $empleado->direccion)}}">
                @error('direccion')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rol:</label>
                <input type="number" name="role" id="role" value="{{old('role', $empleado->role)}}" class="form-control"> 0-->Admin  |  1-->Operario 
                @error('role')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                @enderror
            </div>
            <input type="submit" value="Guardar" class="btn btn-secondary">
        </form>
    </div>

</x-layouts.app>
