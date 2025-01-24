@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="Armas cortas" {{ $product->type == 'Armas cortas' ? 'selected' : '' }}>Armas cortas</option>
                    <option value="Cuchillos" {{ $product->type == 'Cuchillos' ? 'selected' : '' }}>Cuchillos</option>
                    <option value="Armas largas" {{ $product->type == 'Armas largas' ? 'selected' : '' }}>Armas largas</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{ $product->stock }}" required>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Peso (opcional)</label>
                <input type="number" step="0.01" name="weight" id="weight" class="form-control" value="{{ $product->weight }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagen (opcional)</label>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                @endif
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
