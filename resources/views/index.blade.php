<h1>Contribuyentes</h1>
<a href="{{ route('contribuyentes.create') }}">Nuevo contribuyente</a>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo de documento</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($contribuyentes as $contribuyente)
            <tr>
                <td>{{ $contribuyente->id }}</td>
                <td>{{ $contribuyente->tipo_documento }}</td>
                <td>{{ $contribuyente->documento }}</td>
                <td>{{ $contribuyente->nombre }}</td>
                <td>{{ $contribuyente->apellidos }}</td>
                <td>{{ $contribuyente->email }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No hay contribuyentes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $contribuyentes->links() }}