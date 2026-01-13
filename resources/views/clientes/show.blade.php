@extends('layouts.app')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detalles del Cliente</h4>
    </div>
    <div class="card-body">
        @if($cliente)
            <table class="table">
                <tr>
                    <th width="30%">ID:</th>
                    <td>{{ $cliente->id }}</td>
                </tr>
                <tr>
                    <th>Usuario:</th>
                    <td>{{ $cliente->usuario }}</td>
                </tr>
                <tr>
                    <th>Fecha de Creación:</th>
                    <td>{{ date('d/m/Y H:i', strtotime($cliente->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Última Actualización:</th>
                    <td>{{ date('d/m/Y H:i', strtotime($cliente->updated_at)) }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2">
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @else
            <p>Cliente no encontrado</p>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
        @endif
    </div>
</div>
@endsection
