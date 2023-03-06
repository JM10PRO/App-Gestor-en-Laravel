<x-layouts.app title="Clientes" meta-description="Clientes meta description">

    <h1>Nuevo cliente</h1>

    <div class="container">
        <form action="{{ route('clientes.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col col-3">
                    <div class="mb-3">
                        <label for="cif" class="form-label">Cif:</label>
                        <input type="text" class="form-control" name="cif" id="cif" value="{{old('cif', $cliente->cif)}}">
                        @error('cif')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre', $cliente->nombre)}}">
                        @error('nombre')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" class="form-control" name="telefono" id="telefono" value="{{old('telefono', $cliente->telefono)}}">
                        @error('telefono')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col col-3">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" class="form-control" name="correo" id="correo" value="{{old('correo', $cliente->correo)}}">
                        @error('correo')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cuota_mensual" class="form-label">Cuota mensual:</label>
                        <input type="text" class="form-control" name="cuota_mensual" id="cuota_mensual" value="{{old('cuota_mensual', $cliente->cuota_mensual)}}">
                        @error('cuota_mensual')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col col-3">
                    <div class="mb-3">
                        <label for="cuenta_corriente" class="form-label">Cuenta corriente:</label>
                        <input type="text" class="form-control" name="cuenta_corriente" id="cuenta_corriente" value="{{old('cuenta_corriente', $cliente->cuenta_corriente)}}">
                        @error('cuenta_corriente')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pais_id" class="form-label">País:</label>
                        <select id="pais_id" name="pais_id" class="form-control">
                            <option value="">Seleccionar país</option>
                            @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                        @error('pais_id')
                            <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-4 mx-auto justify-content-between">
                <input type="submit" name="submit" class="btn btn-secondary" value="Guardar">
            </div>
        </form>
    </div>

</x-layouts.app>