<x-layouts.app title="Cuotas" meta-description="Cuotas meta description">

    <h1>Cuota excepcional</h1>
    
    <div class="card text-start">
        
        <div class="card-body px-5">
            <form action="{{ route('cuotas.guardarCuotaExcepcional', $cuota) }}" method="POST">
                @csrf
                @include('cuotas.form-fields')
            </form>
        </div>
    </div>
</x-layouts.app>