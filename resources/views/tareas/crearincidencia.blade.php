<x-layouts.app title="Tareas" meta-description="Tareas meta description">
    <h1>Registrar incidencia</h1>

    <div class="container">
        <form action="{{ route('guardarincidencia') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @include('tareas.form-fields')
        </form>
    </div>
</x-layouts.app>