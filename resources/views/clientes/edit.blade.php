@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Editar Cliente</h4>
    </div>
    <div class="card-body">
        @if($cliente)
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control @error('usuario') is-invalid @enderror" id="usuario" name="usuario" value="{{ old('usuario', $cliente->usuario) }}" required>
                    @error('usuario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contrasena" class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" name="contrasena">
                    @error('contrasena')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        @else
            <p>Cliente no encontrado</p>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
        @endif
    </div>
</div>
@endsection
