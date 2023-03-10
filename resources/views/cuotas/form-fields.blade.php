<div class="row">
    <div class="mb-3">
        <label for="concepto" class="form-label">Concepto</label>
        <input type="text" name="concepto" id="concepto" class="form-control" value="{{ old('concepto', $cuota->concepto) }}">
        @error('concepto')
            <small class="feedback">{{ "Falta el concepto" }}</small>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col col-3">
        <div class="mb-3">
            <label for="fecha_emision" class="form-label">Fecha de emisión</label>
            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="{{ old('fecha_emision', $cuota->fecha_emision) }}">
            @error('fecha_emision')
                <small class="feedback">{{ "Falta la fecha de emisión" }}</small>
            @enderror
        </div>
    </div>
    <div class="col col-3">
        <div class="mb-3">
            <label for="importe" class="form-label">Importe</label>
            <input type="number" name="importe" id="importe" class="form-control" value="{{ old('importe', $cuota->importe) }}">
            @error('importe')
                <small class="feedback">{{ "Falta el importe" }}</small>
            @enderror
        </div>
    </div>
    <div class="col col-3">
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" value="{{ old('cliente_id', $cuota->cliente_id) }}">
                <option value=""> -- Selecciona un cliente -- </option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" @if($cuota->cliente_id == $cliente->id || old('cliente_id') == $cliente->id) selected @endif>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id')
                <small class="feedback">{{ "Falta el cliente" }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="mb-3">
        <label for="notas" class="form-label">Notas</label>
        <textarea name="notas" id="notas" cols="30" rows="2" class="form-control">{{ old('notas', $cuota->notas) }}</textarea>
        @error('notas')
            <small class="feedback">{{ "Faltan las notas" }}</small>
        @enderror
    </div>
</div>
<input type="submit" class="btn btn-secondary" value="Enviar">