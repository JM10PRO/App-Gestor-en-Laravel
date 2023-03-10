<div class="mb-3">
    <label for="name" class="form-label">Nombre:</label>
    <input type="text" id="name" name="name" placeholder="Nombre" class="form-control" value="{{old('name', $empleado->name)}}">
    @error('name')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="nif" class="form-label">NIF:</label>
    <input type="text" id="nif" name="nif" placeholder="NIF" class="form-control" value="{{old('nif', $empleado->nif)}}">
    @error('nif')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" id="email" name="email" email="email" placeholder="email" class="form-control" value="{{old('email', $empleado->email)}}">
    @error('email')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="password" class="form-control" value="{{old('password', $empleado->password)}}">
    @error('password')
        <small class="feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Repite la contraseña:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password" class="form-control" value="{{old('password', $empleado->password)}}">
    @error('password')
        <small class="feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono:</label>
    <input type="telefono" id="telefono" name="telefono" placeholder="telefono" class="form-control" value="{{old('telefono', $empleado->telefono)}}">
    @error('telefono')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="direccion" class="form-label">Dirección:</label>
    <input type="direccion" id="direccion" name="direccion" placeholder="direccion" class="form-control" value="{{old('direccion', $empleado->direccion)}}">
    @error('direccion')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="role" class="form-label">Rol:</label>
    <input type="number" name="role" id="role" value="{{old('role', $empleado->role)}}" class="form-control"> 0-->Admin  |  1-->Operario 
    @error('role')
        <small class="feedback">{{ "Debe rellenar este campo" }}</small>
    @enderror
</div>
<input type="submit" value="Guardar" class="btn btn-secondary">
<script>
    $(document).on('submit', '#formulario-empleados', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

    // Obtener los valores de los campos del formulario
    var _token = $("input[name='_token']").val();
    var name = $('#name').val();
    var nif = $('#nif').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();
    var telefono = $('#telefono').val();
    var direccion = $('#direccion').val();
    var role = $('#role').val();

    // Crear una solicitud AJAX utilizando jQuery
    $.ajax({
        url: '/empleados',
        method: 'POST',
        data: { 
            _token: _token,
            name: name,
            nif: nif,
            email: email,
            password: password,
            password_confirmation: password_confirmation,
            telefono: telefono,
            direccion: direccion,
            role: role
        },
        dataType: 'json',
        success: function(nuevoRegistro) {
            alert("funciona");
            console.log(nuevoRegistro);
            console.log("nuevo registro insertado");
        // Actualizar la interfaz de usuario con el nuevo registro creado
        // Código para actualizar la interfaz de usuario
        },
        error: function(xhr, textStatus, errorThrown) {
        // Manejar el error devuelto por el servidor
        // alert(xhr.responseJSON.message);
        window.location.href = <?php echo route('empleados.index'); ?>
        }
    });
});

function actualizarTablaUsuarios() {
  // Crear una solicitud AJAX utilizando jQuery
  $.ajax({
    url: '/usuarios',
    method: 'GET',
    dataType: 'json',
    success: function(usuarios) {
      // Limpiar la tabla
      $('#tabla-usuarios tbody').empty();

      // Agregar las filas a la tabla con los usuarios obtenidos del servidor
      usuarios.forEach(function(usuario) {
        var fila = '<tr>' +
          '<td>' + usuario.nombre + '</td>' +
          '<td>' + usuario.apellido + '</td>' +
          '<td>' +
            '<button class="boton-edicion" data-id="' + usuario.id + '">Editar</button>' +
            '<button class="boton-eliminacion" data-id="' + usuario.id + '">Eliminar</button>' +
          '</td>' +
        '</tr>';
        $('#tabla-usuarios tbody').append(fila);
      });
    },
    error: function(xhr, textStatus, errorThrown) {
      // Manejar el error devuelto por el servidor
      alert(xhr.responseJSON.message);
    }
  });
}
</script>