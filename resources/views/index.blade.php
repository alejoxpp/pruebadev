<h1>Contribuyentes</h1>

@if (auth()->user()->role === 'super_usuario')
    <a href="{{ route('contribuyentes.create') }}">Nuevo contribuyente</a>
@endif

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>

@if (session('success'))

    <p>{{ session('success') }}</p>
@endif


<form method="GET" action="{{ route('contribuyentes.index') }}">
    <input name="tipo_documento" placeholder="Tipo de documento"
        value="{{ request('tipo_documento') }}">
    <input name="documento" placeholder="Documento"
        value="{{ request('documento') }}">
    <input name="nombre" placeholder="Nombres"
        value="{{ request('nombre') }}">
    <input name="apellidos" placeholder="Apellidos"
        value="{{ request('apellidos') }}">
    <input name="telefono" placeholder="Teléfono"
        value="{{ request('telefono') }}">

    <button type="submit">Filtrar</button>
    <a href="{{ route('contribuyentes.index') }}">Limpiar</a>
</form>



<table>
    <thead>
        <tr>
            <th>Tipo de documento</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($contribuyentes as $contribuyente)
            <tr>
                <td>{{ $contribuyente->tipo_documento }}</td>
                <td>{{ $contribuyente->documento }}</td>
                <td>{{ $contribuyente->nombre }}</td>
                <td>{{ $contribuyente->apellidos }}</td>
                <td>{{ $contribuyente->telefono }}</td>

                <td>
                    <a href="{{ route('contribuyentes.show', $contribuyente) }}">Ver</a>
                    @if (auth()->user()->role === 'super_usuario')
                    <a href="{{ route('contribuyentes.edit', $contribuyente) }}">Editar</a>
                    <form action="{{ route('contribuyentes.destroy', $contribuyente) }}"
                        method="POST"
                        style="display: inline"
                        onsubmit="return confirm('¿Eliminar este contribuyente?')">
                    @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No hay contribuyentes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $contribuyentes->links() }}