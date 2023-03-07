<x-layouts.app title="Cuotas" meta-description="Cuotas meta description">

    <h1>Editar cuota</h1>
    
    <div class="card text-start">
        
        <div class="card-body px-5">
            <form action="{{ route('cuotas.update', $cuota) }}" method="POST">
                @csrf
                @method('PATCH')
                @include('cuotas.form-fields')
            </form>
        </div>
    </div>
</x-layouts.app>