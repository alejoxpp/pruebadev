<h1>Información del contribuyente</h1>

<dl>
    <dt>Tipo de documento</dt>
    <dd>{{ $contribuyente->tipo_documento }}</dd>

    <dt>Documento</dt>
    <dd>{{ $contribuyente->documento }}</dd>

    <dt>Nombre completo</dt>
    <dd>{{ $contribuyente->nombre_completo }}</dd>

    <dt>Dirección</dt>
    <dd>{{ $contribuyente->direccion }}</dd>

    <dt>Teléfono</dt>
    <dd>{{ $contribuyente->telefono }}</dd>

    <dt>Celular</dt>
    <dd>{{ $contribuyente->celular }}</dd>

    <dt>Email</dt>
    <dd>{{ $contribuyente->email }}</dd>

    <dt>Usuario</dt>
    <dd>{{ $contribuyente->usuario }}</dd>

    <dt>Fecha del sistema</dt>
    <dd>{{ $contribuyente->fecha_sistema }}</dd>
</dl>

<a href="{{ route('contribuyentes.index') }}">Volver al listado</a>