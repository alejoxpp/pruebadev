@php($editando = isset($contribuyente))

<h1>{{ $editando ? 'Editar contribuyente' : 'Nuevo contribuyente' }}</h1>

@if ($errors->any())
    <div>
        <p>Error, por favor corrija:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST"
    action="{{ $editando
        ? route('contribuyentes.update', $contribuyente)
        : route('contribuyentes.store') }}">

    @csrf
    @if ($editando)
        @method('PUT')
    @endif

    <label>Tipo de documento</label>
    <input id="tipo_documento" name="tipo_documento"
        value="{{ old('tipo_documento', $contribuyente->tipo_documento ?? '') }}" required>

    <label>Documento</label>
    <input name="documento"
        value="{{ old('documento', $contribuyente->documento ?? '') }}" required>

    <div id="persona-fields">
        <label>Nombres</label>
        <input name="nombre" value="{{ old('nombre', $contribuyente->nombre ?? '') }}">

        <label>Apellidos</label>
        <input name="apellidos" value="{{ old('apellidos', $contribuyente->apellidos ?? '') }}">
    </div>

    <div id="nit-fields" hidden>
        <label>Razón social</label>
        <input id="razon_social" name="razon_social"
            value="{{ old('razon_social', trim(($contribuyente->nombre ?? '') . ' ' . ($contribuyente->apellidos ?? ''))) }}">
    </div>

    <label>Dirección</label>
    <input name="direccion" value="{{ old('direccion', $contribuyente->direccion ?? '') }}" required>

    <label>Teléfono</label>
    <input name="telefono" value="{{ old('telefono', $contribuyente->telefono ?? '') }}" required>

    <label>Celular</label>
    <input name="celular" value="{{ old('celular', $contribuyente->celular ?? '') }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $contribuyente->email ?? '') }}" required>

    <label>Usuario</label>
    <input name="usuario" value="{{ old('usuario', $contribuyente->usuario ?? '') }}" required>

    @if (! $editando)
    <label>Contraseña temporal</label>
    <input type="password" name="password"
        autocomplete="new-password" minlength="8" required>

    <label>Confirmar contraseña</label>
    <input type="password" name="password_confirmation"
        autocomplete="new-password" minlength="8" required>
    @endif

    <button type="submit">{{ $editando ? 'Actualizar' : 'Guardar' }}</button>
</form>

<script>
    const tipoDocumento = document.getElementById('tipo_documento');
    const personaFields = document.getElementById('persona-fields');
    const nitFields = document.getElementById('nit-fields');
    const razonSocial = document.getElementById('razon_social');

    function actualizarCampos() {
        const esNit = tipoDocumento.value.trim().toUpperCase() === 'NIT';

        personaFields.hidden = esNit;
        nitFields.hidden = !esNit;
        personaFields.querySelectorAll('input').forEach(input => input.disabled = esNit);
        razonSocial.disabled = !esNit;
    }

    tipoDocumento.addEventListener('input', actualizarCampos);
    actualizarCampos();
</script>