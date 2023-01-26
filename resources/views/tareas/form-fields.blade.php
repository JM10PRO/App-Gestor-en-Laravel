<div class="row">
    <div class="col col-4">
        <fieldset>
            <legend>Datos persona de contacto:</legend>
            <div class="mb-3">
                <label for="nif" class="form-label">NIF / CIF:</label>
                <input type="text" id="nif" name="nif" placeholder="NIF / CIF" class="form-control" value="{{old('nif', $tarea->nif)}}">
                @error('nif')
                    <small class="feedback">{{ "Debe rellenar este campo" }}</small>
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
                <select id="provincia" name="provincia" class="form-control">
                    <option value="">Seleccionar provincia</option>
                    @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->nombre }}" @if($tarea->provincia == $provincia->nombre) selected @endif>{{ $provincia->nombre }}</option>
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
                <label for="fechacreacion" class="form-label">Fecha de creación de la tarea:</label>
                <input type="text" name="fechacreacion" id="fechacreacion" class="form-control" readonly value="{{ date('d-m-Y') }}">
                @error('fechacreacion')
                    <small class="feedback">{{ "Falta la fecha de realización" }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="operario" class="form-label">Operario encargado:</label>
                <input type="text" name="operario" id="operario" class="form-control" value="{{old('operario', $tarea->operario)}}">
                @error('operario')
                    <small class="feedback">{{ "Debe contener al menos 2 caracteres." }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecharealizacion" class="form-label">Fecha de realización:</label>
                <input type="date" name="fecharealizacion" id="fecharealizacion" class="form-control" value="{{old('fecharealizacion', $tarea->fecharealizacion)}}">
                @error('fecharealizacion')
                    <small class="feedback">{{ "Este campo es obligatorio" }}</small>
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

            <div class="mb-3">
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                <label for="ficheroresumen" class="form-label">Fichero resumen de tareas realizadas:</label>
                <input type="file" name="ficheroresumen" id="ficheroresumen" value="{{old('ficheroresumen', $tarea->ficheroresumen)}}" class="form-control">
                @error('ficheroresumen')
                    <small class="feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fotos" class="form-label">Fotos del trabajo realizado:</label>
                <input type="file" name="fotos" id="fotos" value="{{old('fotos', $tarea->fotos)}}" class="form-control">
                @error('fotos')
                    <small class="feedback">{{ $message }}</small>
                @enderror
            </div>
        </fieldset>
    </div>
</div>
<div class="row mt-4 mx-auto justify-content-between">
    <input type="submit" name="submit" class="btn btn-secondary" value="Guardar tarea">
</div>