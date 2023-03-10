<x-layouts.app title="Empleados" meta-description="Empleado meta description">

    <h1>Nuevo empleado</h1>

    <div class="container mb-5">
        <form id="formulario-empleados" action="{{ route('empleados.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @include('empleados.form-fields')
        </form>
    </div>

</x-layouts.app>