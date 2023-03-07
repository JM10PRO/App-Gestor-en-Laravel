<x-layouts.app title="Cuotas" meta-description="Cuotas meta description">

    <h1>Remesa mensual</h1>
    
    <div class="card text-start">
        
        <div class="card-body px-5">
            <form action="{{ route('cuotas.guardarCuotaMensual', $cuota) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto</label>
                        <input type="text" name="concepto" id="concepto" class="form-control" value="{{ old('concepto') }}">
                        @error('concepto')
                            <small class="feedback">{{ "Falta el concepto" }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col col-4">
                        <div class="mb-3">
                            <label for="fecha_emision" class="form-label">Fecha emision</label>
                            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="{{ old('fecha_emision') }}">
                            @error('fecha_emision')
                                <small class="feedback">{{ "Falta la fecha de emisión" }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="mb-3">
                            <label for="importe" class="form-label">Importe</label>
                            <input type="number" name="importe" id="importe" class="form-control" value="{{ old('importe') }}">
                            @error('importe')
                                <small class="feedback">{{ "Falta el importe" }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row text-start">
                    <div class="mb-3">
                        <label for="notas" class="form-label">Notas</label>
                        <textarea name="notas" id="notas" cols="30" rows="2" class="form-control">{{ old('notas') }}</textarea>
                        @error('notas')
                            <small class="feedback">{{ "Faltan las notas" }}</small>
                        @enderror
                    </div>
                </div>
                <input type="submit" class="btn btn-secondary" value="Enviar">
            </form>
        </div>
    </div>
</x-layouts.app>