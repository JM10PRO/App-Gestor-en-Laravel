<x-layouts.app title="Tareas" meta-description="Tareas meta description">
    <h1>Registrar incidencia</h1>

    <div class="container">
        <form action="{{ route('guardarincidencia') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col col-4">
                    <fieldset>
                        <legend>Datos persona de contacto:</legend>
                        <div class="mb-3">
                            <label for="cif" class="form-label">NIF / CIF:</label>
                            <input type="text" id="cif" name="cif" placeholder="NIF / CIF" class="form-control" value="{{old('cif', $tarea->cif)}}">
                            @error('cif')
                                <small class="feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="personacontacto" class="form-label">Persona de contacto:</label>
                            <input type="text" id="personacontacto" name="personacontacto" placeholder="Contacto" class="form-control" value="{{old('personacontacto', $tarea->personacontacto)}}">
                            @error('personacontacto')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" placeholder="Escriba los números sin espacios" class="form-control" value="{{old('telefono', $tarea->telefono)}}">
                            @error('telefono')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico:</label>
                            <input type="text" id="correo" name="correo" placeholder="example@email.com" class="form-control" value="{{old('correo', $tarea->correo)}}">
                            @error('correo')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poblacion" class="form-label">Población:</label>
                            <input type="text" id="poblacion" name="poblacion" placeholder="" class="form-control" value="{{old('poblacion', $tarea->poblacion )}}">
                            @error('poblacion')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="codpostal" class="form-label">Código postal:</label>
                            <input type="text" id="codpostal" name="codpostal" placeholder="" class="form-control" value="{{old('codpostal', $tarea->codpostal)}}">
                            @error('codpostal')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <select id="provincia" name="provincia" class="form-control" value="{{ old('provincia', $tarea->provincia) }}">
                                <option value="">Seleccionar provincia</option>
                                @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->nombre }}" @if($tarea->provincia == $provincia->nombre || old('provincia') == $provincia->nombre) selected @endif>{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                            @error('codpostal')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>
                    </fieldset>
                </div>

                <div class="col col-4">
                    <fieldset>
                        <legend>Datos de la tarea</legend>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion', $tarea->direccion)}}">
                            @error('direccion')
                                <small class="feedback">{{ "Debe rellenar este campo" }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="anotacionanterior" class="form-label">Anotaciones anteriores:</label>
                            <input type="text" name="anotacionanterior" id="anotacionanterior" class="form-control" value="{{old('anotacionanterior', $tarea->anotacionanterior)}}">
                            @error('anotacionanterior')
                                <small class="feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="anotacionposterior" class="form-label">Anotaciones posteriores:</label>
                            <input type="text" name="anotacionposterior" id="anotacionposterior" class="form-control" value="{{old('anotacionposterior', $tarea->anotacionposterior)}}">
                            @error('anotacionposterior')
                                <small class="feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </fieldset>
                </div>

                <div class="col col-4">
                    <fieldset>
                        <legend>Detalles de la tarea</legend>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado de la tarea:</label> <br>
                            &nbsp; <input type="radio" name="estado" id="" @if($tarea->estado == "B")checked @endif value="B"> B --> Esperando a ser aprobada <br>
                            &nbsp; <input type="radio" name="estado" id="" @if($tarea->estado == "P")checked @endif value="P"> P --> Pendiente <br>
                            &nbsp; <input type="radio" name="estado" id="" @if($tarea->estado == "R")checked @endif value="R"> R --> Realizada <br>
                            &nbsp; <input type="radio" name="estado" id="" @if($tarea->estado == "C")checked @endif value="C"> C --> Cancelada <br>
                            @error('estado')
                                <small class="feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion">Descripción de la tarea:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" placeholder="Añade una descripción de la tarea...">{{old('descripcion', $tarea->descripcion)}}</textarea>
                            @error('descripcion')
                                <small class="feedback">{{ "Debe escribir la descripción de la tarea" }}</small>
                            @enderror
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row mt-4 mx-auto justify-content-between">
                <input type="submit" name="submit" class="btn btn-secondary" value="Guardar tarea">
            </div>
        </form>
    </div>
</x-layouts.app>