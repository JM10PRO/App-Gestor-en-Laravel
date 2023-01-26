<x-layouts.app title="Tareas" meta-description="Tareas meta description">

    <h1>Nueva tarea</h1>

    <div class="container">
        <form action="{{ route('tareas.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
            @include('tareas.form-fields')
        </form>
    </div>

</x-layouts.app>
